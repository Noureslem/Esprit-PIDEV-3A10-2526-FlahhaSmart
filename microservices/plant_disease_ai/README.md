# Plant Disease AI (FastAPI)

Microservice FastAPI responsable **uniquement** du diagnostic IA des maladies végétales à partir d'une image.

- Endpoint principal: `POST /predict-disease`
- Healthcheck: `GET /health`
- Chargement du modèle: 1 seule fois au démarrage (lifespan FastAPI)
- Logs: structurés (JSON) via `structlog`

## Contrat HTTP

### `POST /predict-disease`

- Content-Type: `multipart/form-data`
- Champ fichier: `image`
- Réponse: JSON avec `top_prediction` + `predictions` (top-k)

### `GET /health`

Retourne l'état et si le modèle est prêt.

## Variables d'environnement

- `MODEL_PATH` (default: `app/resources/model.pt`) — modèle TorchScript.
- `LABELS_PATH` (default: `app/resources/labels.json`) — liste des classes.
- `RECOMMENDATIONS_PATH` (default: `app/resources/recommendations.json`) — recommandations.
- `DEVICE` (default: `cpu`) — `cpu` ou `cuda`.
- `TOP_K` (default: `3`) — nombre de maladies retournées.
- `MAX_IMAGE_MB` (default: `8`) — taille max d'upload.
- `REQUIRE_MODEL` (default: `false`) — si `true`, le service refuse de démarrer sans modèle.
- `ENABLE_FALLBACK_MODEL` (default: `true`) — si `true` et `MODEL_PATH` absent, charge un petit modèle interne (dev).
- `JSON_LOGS` (default: `true`) — logs JSON.

## Lancer en local

```bash
python -m venv .venv
. .venv/bin/activate
pip install -r requirements.txt
uvicorn app.main:app --reload --host 0.0.0.0 --port 8000
```

## Docker

```bash
docker build -t plant-disease-ai .
docker run --rm -p 8000:8000 \
  -e MODEL_PATH=app/resources/model.pt \
  plant-disease-ai
```

## Intégration Docker Compose (exemple)

Ajoute un service pointant vers ce dossier, et expose-le uniquement sur le réseau interne.

```yaml
plant-disease-ai:
  build:
    context: ./microservices/plant_disease_ai
  environment:
    MODEL_PATH: /models/model.pt
    LABELS_PATH: /models/labels.json
    RECOMMENDATIONS_PATH: /models/recommendations.json
    TOP_K: 3
  volumes:
    - ./microservices/plant_disease_ai/models:/models:ro
  ports:
    - "8010:8000"
```

> En prod, préfère ne **pas** exposer le port (utiliser uniquement le réseau Docker / reverse proxy / mTLS).
