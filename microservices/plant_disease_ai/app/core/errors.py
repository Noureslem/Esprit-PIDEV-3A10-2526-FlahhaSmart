from __future__ import annotations

from dataclasses import dataclass
from typing import Any, Dict, Optional

from fastapi.responses import JSONResponse


@dataclass(frozen=True)
class ApiError(Exception):
    status_code: int
    code: str
    message: str
    details: Optional[Dict[str, Any]] = None

    def to_response(self, request_id: str | None = None) -> JSONResponse:
        payload: Dict[str, Any] = {
            "success": False,
            "error": {
                "code": self.code,
                "message": self.message,
            },
        }

        if request_id:
            payload["request_id"] = request_id

        if self.details is not None:
            payload["error"]["details"] = self.details

        return JSONResponse(status_code=self.status_code, content=payload)

    @staticmethod
    def bad_request(message: str, details: Optional[Dict[str, Any]] = None) -> "ApiError":
        return ApiError(status_code=400, code="bad_request", message=message, details=details)

    @staticmethod
    def payload_too_large(message: str, details: Optional[Dict[str, Any]] = None) -> "ApiError":
        return ApiError(status_code=413, code="payload_too_large", message=message, details=details)

    @staticmethod
    def unsupported_media_type(message: str, details: Optional[Dict[str, Any]] = None) -> "ApiError":
        return ApiError(status_code=415, code="unsupported_media_type", message=message, details=details)

    @staticmethod
    def service_unavailable(message: str, details: Optional[Dict[str, Any]] = None) -> "ApiError":
        return ApiError(status_code=503, code="service_unavailable", message=message, details=details)

    @staticmethod
    def internal_error(message: str, details: Optional[Dict[str, Any]] = None) -> "ApiError":
        return ApiError(status_code=500, code="internal_error", message=message, details=details)
