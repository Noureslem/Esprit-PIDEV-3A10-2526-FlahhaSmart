from __future__ import annotations

"""FastAPI entrypoint.

This microservice is intentionally narrow in scope:
- accept an uploaded plant image
- run a PyTorch model for disease diagnosis
- return a structured JSON response

The model is loaded once at startup (FastAPI lifespan) and reused for all requests.
"""

from contextlib import asynccontextmanager
from typing import AsyncIterator

from fastapi import FastAPI, Request
from fastapi.exceptions import RequestValidationError
from fastapi.responses import JSONResponse

from app.api.routes.health import router as health_router
from app.api.routes.predict import router as predict_router
from app.core.config import get_settings
from app.core.errors import ApiError
from app.core.logging import configure_logging, get_logger
from app.services.model_runtime import ModelRuntime
from app.utils.request_context import RequestContextMiddleware, get_request_id


@asynccontextmanager
async def lifespan(app: FastAPI) -> AsyncIterator[None]:
    settings = get_settings()
    configure_logging(settings)
    log = get_logger(__name__)

    runtime = ModelRuntime(settings=settings)
    runtime.load()

    app.state.settings = settings
    app.state.runtime = runtime

    log.info(
        "service_started",
        service=settings.service_name,
        version=settings.version,
        model_ready=runtime.is_ready,
        device=settings.device,
    )

    yield

    log.info("service_stopped")


def create_app() -> FastAPI:
    settings = get_settings()

    app = FastAPI(
        title=settings.service_name,
        version=settings.version,
        lifespan=lifespan,
    )

    app.add_middleware(RequestContextMiddleware)

    app.include_router(health_router)
    app.include_router(predict_router)

    @app.exception_handler(RequestValidationError)
    async def validation_error_handler(request: Request, exc: RequestValidationError):
        request_id = get_request_id(request)
        return JSONResponse(
            status_code=422,
            content={
                "success": False,
                "request_id": request_id,
                "error": {
                    "code": "validation_error",
                    "message": "Invalid request.",
                    "details": exc.errors(),
                },
            },
        )

    @app.exception_handler(ApiError)
    async def api_error_handler(request, exc: ApiError):  # type: ignore[no-untyped-def]
        request_id = get_request_id(request)
        return exc.to_response(request_id=request_id)

    @app.exception_handler(Exception)
    async def unhandled_error_handler(request: Request, exc: Exception):
        request_id = get_request_id(request)
        get_logger(__name__).error("unhandled_exception", request_id=request_id, error=str(exc))
        return ApiError.internal_error("Unexpected error.").to_response(request_id=request_id)

    return app


app = create_app()
