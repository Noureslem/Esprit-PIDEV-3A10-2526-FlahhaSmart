from __future__ import annotations

from fastapi import APIRouter, Request

from app.core.logging import get_logger
from app.schemas.predict import HealthResponse

router = APIRouter(tags=["health"])
log = get_logger(__name__)


@router.get("/health", response_model=HealthResponse)
def health(request: Request) -> HealthResponse:
    runtime = request.app.state.runtime
    settings = request.app.state.settings

    return HealthResponse(
        status="ok" if runtime.is_ready else "degraded",
        model_ready=runtime.is_ready,
        service=settings.service_name,
        version=settings.version,
        device=settings.device,
    )
