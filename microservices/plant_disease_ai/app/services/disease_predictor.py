from __future__ import annotations

"""Inference service.

Assumption: the PyTorch model is a classifier returning logits with shape [N, C]
(or a compatible structure containing logits). The service runs softmax + top-k.
"""

from dataclasses import dataclass
from typing import Any, Dict, List, Tuple

import torch

from app.core.config import Settings
from app.core.errors import ApiError
from app.core.logging import get_logger
from app.schemas.predict import DiseasePrediction, PredictResponse
from app.services.model_runtime import ModelRuntime
from app.utils.images import decode_image, preprocess_image

log = get_logger(__name__)


@dataclass(frozen=True)
class DiseasePredictor:
    runtime: ModelRuntime
    settings: Settings

    def predict(self, image_bytes: bytes, filename: str, request_id: str) -> PredictResponse:
        try:
            image = decode_image(image_bytes)
        except Exception as exc:  # noqa: BLE001
            raise ApiError.bad_request("Invalid image.") from exc

        if self.runtime.model is None:
            raise ApiError.service_unavailable("Model not ready.")

        tensor = preprocess_image(image)

        device = torch.device(self.settings.device)
        tensor = tensor.to(device)

        with torch.no_grad():
            outputs = self.runtime.model(tensor)

        logits = self._to_logits(outputs)
        probs = torch.softmax(logits, dim=1)
        top_probs, top_indices = torch.topk(probs, k=min(self.settings.top_k, probs.shape[1]))

        predictions: List[DiseasePrediction] = []
        for confidence, index in zip(top_probs[0].tolist(), top_indices[0].tolist()):
            disease = self._label_for_index(index)
            severity = self._severity_for(confidence)
            recommendations = self._recommendations_for(disease)
            predictions.append(
                DiseasePrediction(
                    disease=disease,
                    confidence=float(confidence),
                    severity=severity,
                    recommendations=recommendations,
                )
            )

        if not predictions:
            raise ApiError.internal_error("No predictions produced.")

        log.info(
            "prediction_done",
            request_id=request_id,
            filename=filename,
            top_disease=predictions[0].disease,
            top_confidence=predictions[0].confidence,
        )

        return PredictResponse(
            request_id=request_id,
            top_prediction=predictions[0],
            predictions=predictions,
            model=self.runtime.metadata(),
        )

    def _label_for_index(self, index: int) -> str:
        labels = self.runtime.labels or []
        if 0 <= index < len(labels):
            return str(labels[index])
        return f"class_{index}"

    def _recommendations_for(self, disease: str) -> List[str]:
        data = self.runtime.recommendations or {}
        item = data.get(disease)
        if isinstance(item, dict):
            recs = item.get("recommendations")
            if isinstance(recs, list):
                return [str(v) for v in recs if str(v).strip()]
        return []

    @staticmethod
    def _severity_for(confidence: float) -> str:
        if confidence >= 0.85:
            return "high"
        if confidence >= 0.6:
            return "medium"
        return "low"

    @staticmethod
    def _to_logits(outputs: Any) -> torch.Tensor:
        if isinstance(outputs, torch.Tensor):
            logits = outputs
        elif isinstance(outputs, (list, tuple)) and outputs and isinstance(outputs[0], torch.Tensor):
            logits = outputs[0]
        elif hasattr(outputs, "logits") and isinstance(outputs.logits, torch.Tensor):
            logits = outputs.logits
        else:
            raise ApiError.internal_error("Unexpected model output.")

        if logits.dim() == 1:
            logits = logits.unsqueeze(0)
        if logits.dim() != 2:
            raise ApiError.internal_error("Invalid logits shape.", {"shape": list(logits.shape)})
        return logits
