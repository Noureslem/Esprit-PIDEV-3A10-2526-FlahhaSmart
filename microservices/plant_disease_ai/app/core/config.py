from __future__ import annotations

from functools import lru_cache
from typing import List

from pydantic import Field
from pydantic_settings import BaseSettings, SettingsConfigDict


class Settings(BaseSettings):
    model_config = SettingsConfigDict(env_file=None)

    service_name: str = Field(default="plant-disease-ai")
    version: str = Field(default="1.0.0")

    log_level: str = Field(default="INFO")
    json_logs: bool = Field(default=True)

    model_path: str = Field(default="app/resources/model.pt")
    labels_path: str = Field(default="app/resources/labels.json")
    recommendations_path: str = Field(default="app/resources/recommendations.json")
    require_model: bool = Field(default=False)
    enable_fallback_model: bool = Field(default=True)

    device: str = Field(default="cpu")
    top_k: int = Field(default=3, ge=1, le=10)

    max_image_mb: int = Field(default=8, ge=1, le=50)
    allowed_mime_types: List[str] = Field(default_factory=lambda: [
        "image/jpeg",
        "image/png",
        "image/webp",
    ])


@lru_cache
def get_settings() -> Settings:
    return Settings()
