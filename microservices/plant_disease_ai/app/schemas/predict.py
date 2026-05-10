from __future__ import annotations

from typing import List, Literal, Optional

from pydantic import BaseModel, Field


class HealthResponse(BaseModel):
    status: Literal["ok", "degraded"]
    model_ready: bool
    service: str
    version: str
    device: str


class DiseasePrediction(BaseModel):
    disease: str = Field(..., description="Nom de la maladie")
    confidence: float = Field(..., ge=0.0, le=1.0)
    severity: Optional[Literal["low", "medium", "high"]] = None
    recommendations: List[str] = Field(default_factory=list)


class PredictResponse(BaseModel):
    success: bool = True
    request_id: str
    top_prediction: DiseasePrediction
    predictions: List[DiseasePrediction]
    model: dict
