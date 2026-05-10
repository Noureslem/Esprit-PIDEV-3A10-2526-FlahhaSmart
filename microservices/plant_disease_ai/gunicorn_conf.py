import os

bind = os.getenv("BIND", "0.0.0.0:8000")
workers = int(os.getenv("WORKERS", "2"))
threads = int(os.getenv("THREADS", "2"))
timeout = int(os.getenv("TIMEOUT", "60"))
keepalive = int(os.getenv("KEEPALIVE", "5"))

worker_class = "uvicorn.workers.UvicornWorker"

accesslog = "-"
errorlog = "-"
loglevel = os.getenv("LOG_LEVEL", "info").lower()
