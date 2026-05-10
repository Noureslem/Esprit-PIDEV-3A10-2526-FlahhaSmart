from __future__ import annotations

from fastapi import APIRouter, File, Request, UploadFile

from app.core.errors import ApiError
from app.schemas.predict import PredictResponse
from app.services.disease_predictor import DiseasePredictor
from app.utils.request_context import get_request_id

router = APIRouter(tags=["predict"])


@router.post("/predict-disease", response_model=PredictResponse)
async def predict_disease(
    request: Request,
    image: UploadFile = File(...),
) -> PredictResponse:
    runtime = request.app.state.runtime
    settings = request.app.state.settings
    request_id = get_request_id(request)

    if not runtime.is_ready:
        raise ApiError.service_unavailable(
            message="Model not ready. Mount MODEL_PATH and restart the service.",
        )

    content_type = (image.content_type or "").lower().strip()
    if content_type not in settings.allowed_mime_types:
        raise ApiError.unsupported_media_type(
            message="Unsupported image type.",
            details={"allowed": settings.allowed_mime_types, "received": content_type},
        )

    raw = await image.read()
    if len(raw) == 0:
        raise ApiError.bad_request("Empty upload.")

    max_bytes = int(settings.max_image_mb * 1024 * 1024)
    if len(raw) > max_bytes:
        raise ApiError.payload_too_large(
            message="Image too large.",
            details={"max_mb": settings.max_image_mb},
        )

    predictor = DiseasePredictor(runtime=runtime, settings=settings)
    result = predictor.predict(image_bytes=raw, filename=image.filename or "image", request_id=request_id)

    return result
