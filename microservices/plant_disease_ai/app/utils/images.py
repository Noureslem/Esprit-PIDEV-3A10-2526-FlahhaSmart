from __future__ import annotations

"""Image decoding + preprocessing.

Defaults here (224x224 + ImageNet normalization) are common for many vision backbones.
Adapt this module to match the exact preprocessing used during your model training.
"""

from io import BytesIO

import torch
from PIL import Image
from torchvision import transforms


def decode_image(image_bytes: bytes) -> Image.Image:
    image = Image.open(BytesIO(image_bytes))
    image = image.convert("RGB")
    return image


_TRANSFORM = transforms.Compose(
    [
        transforms.Resize((224, 224)),
        transforms.ToTensor(),
        transforms.Normalize(mean=[0.485, 0.456, 0.406], std=[0.229, 0.224, 0.225]),
    ]
)


def preprocess_image(image: Image.Image) -> torch.Tensor:
    tensor = _TRANSFORM(image)
    return tensor.unsqueeze(0)
