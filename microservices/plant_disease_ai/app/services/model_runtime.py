from __future__ import annotations

"""Model runtime container.

Responsibilities:
- load labels/recommendations from JSON
- load the TorchScript model once at startup
- expose `is_ready` + lightweight metadata for responses/health
"""

import json
import os
from dataclasses import dataclass
from typing import Any, Dict, List, Optional

import torch
from torch import nn

from app.core.config import Settings
from app.core.logging import get_logger

log = get_logger(__name__)


@dataclass
class ModelRuntime:
    settings: Settings
    is_ready: bool = False
    model: Optional[nn.Module] = None
    labels: List[str] = None  # type: ignore[assignment]
    recommendations: Dict[str, Any] = None  # type: ignore[assignment]

    def load(self) -> None:
        self.labels = self._load_labels(self.settings.labels_path)
        self.recommendations = self._load_recommendations(self.settings.recommendations_path)

        if not self.labels:
            self.labels = [
                "healthy",
                "powdery_mildew",
                "leaf_rust",
                "leaf_spot",
            ]

        if not os.path.exists(self.settings.model_path):
            log.warning(
                "model_missing",
                model_path=self.settings.model_path,
                require_model=self.settings.require_model,
                enable_fallback_model=self.settings.enable_fallback_model,
            )
            if self.settings.require_model:
                raise RuntimeError("MODEL_PATH not found: " + self.settings.model_path)

            if self.settings.enable_fallback_model:
                self.model = self._build_fallback_model(num_classes=len(self.labels))
                self.model.eval()
                self.is_ready = True
                log.warning(
                    "fallback_model_loaded",
                    device=self.settings.device,
                    num_labels=len(self.labels),
                )
                return

            self.is_ready = False
            return

        device = torch.device(self.settings.device)
        try:
            self.model = torch.jit.load(self.settings.model_path, map_location=device)
            self.model.eval()
            self.is_ready = True
            log.info(
                "model_loaded",
                model_path=self.settings.model_path,
                device=str(device),
                num_labels=len(self.labels),
            )
        except Exception as exc:  # noqa: BLE001
            log.error("model_load_failed", error=str(exc))
            if self.settings.require_model:
                raise
            self.is_ready = False

    def metadata(self) -> Dict[str, Any]:
        return {
            "path": self.settings.model_path,
            "device": self.settings.device,
            "num_labels": len(self.labels or []),
            "top_k": self.settings.top_k,
        }

    @staticmethod
    def _build_fallback_model(num_classes: int) -> nn.Module:
        class FallbackModel(nn.Module):
            def __init__(self, classes: int):
                super().__init__()
                torch.manual_seed(0)
                self.fc = nn.Linear(3, classes)

            def forward(self, x: torch.Tensor) -> torch.Tensor:  # type: ignore[override]
                x = x.mean(dim=(2, 3))
                return self.fc(x)

        return FallbackModel(max(int(num_classes), 2))

    @staticmethod
    def _load_labels(path: str) -> List[str]:
        if not os.path.exists(path):
            return []
        with open(path, "r", encoding="utf-8") as handle:
            data = json.load(handle)
        if isinstance(data, list):
            return [str(item) for item in data]
        return []

    @staticmethod
    def _load_recommendations(path: str) -> Dict[str, Any]:
        if not os.path.exists(path):
            return {}
        with open(path, "r", encoding="utf-8") as handle:
            data = json.load(handle)
        return data if isinstance(data, dict) else {}
