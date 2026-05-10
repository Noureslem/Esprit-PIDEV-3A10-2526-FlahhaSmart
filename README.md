# 🌾 FlahaSmart

> **Intelligent Agricultural Management Platform**  
> A modern, full-stack Symfony application combining smart irrigation planning, crop rotation optimization, plant disease detection, and AI-powered agricultural assistance.

<div align="center">

[![Symfony](https://img.shields.io/badge/Symfony-6.4-000000?style=flat-square&logo=symfony&logoColor=white)](https://symfony.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat-square&logo=php&logoColor=white)](https://www.php.net)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-16-336791?style=flat-square&logo=postgresql&logoColor=white)](https://www.postgresql.org)
[![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?style=flat-square&logo=docker&logoColor=white)](https://www.docker.com)
[![API Platform](https://img.shields.io/badge/API_Platform-3.3-00CDF6?style=flat-square&logo=api&logoColor=white)](https://api-platform.com)
[![License](https://img.shields.io/badge/License-Proprietary-red?style=flat-square)](LICENSE)

</div>

---

## 📖 Table of Contents

- [Overview](#overview)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Architecture](#-architecture)
- [Project Structure](#-project-structure)
- [Requirements](#-requirements)
- [Installation](#-installation)
- [Environment Variables](#-environment-variables)
- [Database](#-database)
- [Running the Project](#-running-the-project)
- [API Documentation](#-api-documentation)
- [Security](#-security)
- [AI & Microservices](#-ai--microservices)
- [Feature Guide](#-feature-guide)
- [Testing](#-testing)
- [Docker & DevOps](#-docker--devops)
- [Troubleshooting](#-troubleshooting)
- [Contributing](#-contributing)
- [License](#-license)

---

## Overview

FlahaSmart is a comprehensive agricultural management platform designed to empower farmers with intelligent decision-making tools. Built with Symfony 6.4 and a modern PHP stack, it integrates real-time weather data, AI-powered diagnostics, and scientific crop rotation planning to optimize farm operations and resource management.

### Business Value

- **Smart Irrigation**: Reduce water consumption by 20-30% with AI-driven irrigation planning
- **Crop Health**: Early disease detection using computer vision and plant analysis
- **Soil Science**: Evidence-based crop rotation planning for sustainable farming
- **Operational Management**: Centralized equipment tracking and operation scheduling
- **Community**: Forum and knowledge-sharing platform for farmers

### Use Cases

1. **Precision Agriculture**: Farmers optimize water usage and nutrient management
2. **Farm Operations**: Equipment lifecycle and maintenance tracking
3. **Crop Planning**: Multi-year rotation strategies based on soil science
4. **Market Management**: Product catalog and order management system
5. **Knowledge Exchange**: Community forum with AI moderation and reputation system

---

## 🎯 Features

### Core Agricultural Features

| Feature | Description | Status |
|---------|-------------|--------|
| 🚜 **Equipment Management** | CRUD operations for agricultural equipment with status tracking | ✅ Production |
| 📅 **Operation Scheduling** | Plan and track agricultural operations with date validation | ✅ Production |
| 💧 **Smart Irrigation** | AI-powered water requirement calculation based on weather, soil, crop type | ✅ Production |
| 🔄 **Crop Rotation Planning** | Multi-year rotation strategy based on soil nutrients, crop history, sustainability | ✅ Production |
| 🌦️ **Weather Integration** | Real-time weather data with WeatherStack API (fallback: Open-Meteo) | ✅ Production |
| 🤖 **AI Chatbot** | Agricultural expertise assistant powered by Google Gemini 2.5 Flash | ✅ Production |

### AI & Advanced Features

| Feature | Description | Status |
|---------|-------------|--------|
| 🔬 **Plant Disease Detection** | FastAPI microservice with PyTorch for disease classification from plant images | ✅ Production |
| 🌿 **Plant Identification** | PlantNet API integration for accurate plant species identification | ✅ Production |
| 🧠 **AI Moderation** | Automatic content moderation using HuggingFace models | ✅ Production |
| 🗣️ **Multi-language Translation** | Azure Translator for multilingual support (AR, EN, FR) | ✅ Production |
| 📊 **Sentiment Analysis** | AI-powered sentiment detection in forum discussions | ✅ Production |

### Commerce & Community

| Feature | Description | Status |
|---------|-------------|--------|
| 📦 **Product Catalog** | Agricultural products with pricing, stock management, QR codes | ✅ Production |
| 🛒 **Order Management** | Complete order lifecycle with payment and delivery tracking | ✅ Production |
| 💬 **Community Forum** | Threaded discussions with voting, likes, reputation system | ✅ Production |
| 👤 **User Profiles** | Role-based access control (Admin, Farmer, Client) | ✅ Production |
| 🔔 **Notifications** | Real-time notifications for orders, comments, system events | ✅ Production |
| ⭐ **Reputation System** | Gamified reputation with badges for community engagement | ✅ Production |

---

## 🛠 Tech Stack

### Backend

```
✓ Symfony 6.4.*              - Full-stack web framework
✓ PHP 8.1+                   - Server-side language
✓ Doctrine ORM 3.6.*         - Object-relational mapping
✓ API Platform 3.3.*         - RESTful API framework
✓ Symfony Security Bundle    - Authentication & authorization
✓ Symfony Serializer         - Data serialization
✓ Symfony Validator          - Data validation
✓ Symfony Console            - CLI commands
✓ Symfony Messenger          - Message queue (async tasks)
```

### Database & Persistence

```
✓ PostgreSQL 16              - Primary database
✓ Doctrine Migrations        - Database versioning
✓ MySQL 8.0+ Support         - Alternative database engine
```

### Frontend & Assets

```
✓ Twig 3.*                   - Template engine
✓ Bootstrap 5                - CSS framework
✓ Vanilla JavaScript         - Client-side logic
✓ Axios/Fetch API            - HTTP client
✓ Chart.js                   - Data visualization (if used)
```

### External Integrations

```
✓ Google Gemini 2.5 Flash    - LLM for chatbot
✓ WeatherStack API           - Weather data (real-time)
✓ Open-Meteo API             - Weather fallback provider
✓ PlantNet API               - Plant species identification
✓ Azure Translator           - Machine translation
✓ HuggingFace Models         - NLP tasks (moderation, sentiment)
✓ Google Mailer              - Email delivery
```

### DevOps & Infrastructure

```
✓ Docker                     - Container runtime
✓ Docker Compose             - Multi-container orchestration
✓ Gunicorn                   - WSGI application server (microservice)
✓ Symfony CLI                - Local development server
```

### Microservices

```
✓ FastAPI                    - Modern async Python framework
✓ PyTorch                    - Deep learning for disease detection
✓ Structlog                  - Structured logging
```

---

## 🏗 Architecture

### System Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                     Frontend (Twig/JS)                       │
│            Web Interface + API Client-side Logic             │
└────────────────────┬────────────────────────────────────────┘
                     │ HTTP/HTTPS
┌────────────────────▼────────────────────────────────────────┐
│              Symfony 6.4 Application (Port 8000)             │
├─────────────────────────────────────────────────────────────┤
│  API Platform (RESTful JSON:API)                             │
│  ├─ Controllers (Request Handling)                           │
│  ├─ Services (Business Logic)                               │
│  ├─ Repositories (Data Access)                              │
│  └─ Events/Subscribers (Event Handling)                     │
├─────────────────────────────────────────────────────────────┤
│  Doctrine ORM (Entity Mapping)                              │
│  ├─ Users, Equipment, Operations                            │
│  ├─ Articles, Orders, OrderLines                            │
│  ├─ Threads, Comments, Votes                                │
│  └─ Notifications, Reputation                               │
└────────────┬──────────────────────────┬─────────────────────┘
             │                          │
    ┌────────▼────────┐      ┌──────────▼──────────┐
    │   PostgreSQL    │      │  Microservices     │
    │   Database      │      ├────────────────────┤
    │                 │      │ FastAPI Disease AI │
    │ • 12 Tables     │      │ (Port 8010)        │
    │ • Relations     │      │ • PyTorch Model    │
    │ • Indices       │      │ • Disease Predict  │
    └─────────────────┘      └────────────────────┘
             ▲                      ▲
             │                      │
             └──────────┬───────────┘
                        │
           ┌────────────▼────────────┐
           │  External APIs          │
           ├────────────────────────┤
           │ • Google Gemini        │
           │ • WeatherStack API     │
           │ • PlantNet API         │
           │ • Azure Translator     │
           │ • HuggingFace Models   │
           │ • Google Mail          │
           └────────────────────────┘
```

### Design Patterns

**1. Service Layer Pattern**
```
Controller → Service → Repository → Database
```
Services encapsulate business logic:
- `IrrigationService` - Water requirement calculations
- `WeatherService` - Weather data aggregation
- `GeminiChatService` - AI chatbot orchestration
- `PlantNetService` - Plant identification
- `DiseaseAiClient` - Disease detection client

**2. Repository Pattern**
```
Repository → Entity → ORM → Database
```
Centralized data access through Doctrine repositories

**3. Dependency Injection**
```yaml
# services.yaml configuration
autowire: true        # Auto wire dependencies
autoconfigure: true   # Auto register services
bind:                 # Bind parameters
  string $apiKey: '%env(GEMINI_API_KEY)%'
```

**4. Event Subscriber Pattern**
```
Entity Events → Subscribers → Side Effects
```

**5. Microservice Architecture**
```
Symfony → HTTP Client → FastAPI Microservice
```
Decoupled disease detection service with independent scaling

---

## 📁 Project Structure

```
FlahaSmart/
├── bin/
│   ├── console                          # Symfony CLI
│   ├── ensure-disease-ai.ps1            # AI microservice setup (Windows)
│   ├── start-dev.ps1                    # Development bootstrap (Windows)
│   ├── start-disease-ai.ps1             # AI microservice startup (Windows)
│   └── phpunit                          # Test runner
│
├── config/
│   ├── bundles.php                      # Bundle registration
│   ├── services.yaml                    # Dependency injection configuration
│   ├── routes.yaml                      # Main routing
│   ├── packages/
│   │   ├── api_platform.yaml            # API Platform config
│   │   ├── doctrine.yaml                # Doctrine ORM config
│   │   ├── security.yaml                # Security & authentication
│   │   ├── framework.yaml               # Symfony framework
│   │   ├── twig.yaml                    # Twig template engine
│   │   ├── translation.yaml             # Internationalization
│   │   ├── mailer.yaml                  # Email configuration
│   │   ├── notifier.yaml                # Notification channels
│   │   └── [other configs]
│   └── routes/
│       ├── api_platform.yaml            # API routes (prefix: /api)
│       ├── security.yaml                # Auth routes
│       └── framework.yaml               # Framework routes
│
├── migrations/
│   └── Version20260510131059.php        # Database schema (12 tables)
│
├── public/
│   ├── index.php                        # Application entry point
│   ├── bundles/                         # Asset bundles
│   ├── css/                             # Stylesheets
│   │   ├── style.css
│   │   ├── admin.css
│   │   ├── landing.css
│   │   └── auth.css
│   ├── js/                              # Client scripts
│   └── uploads/                         # User uploaded files
│
├── src/
│   ├── Kernel.php                       # Symfony Kernel
│   │
│   ├── Entity/                          # Doctrine Entities
│   │   ├── Users.php                    # User entity (UserInterface)
│   │   ├── Equipment.php                # Farm equipment
│   │   ├── Operation.php                # Scheduled operations
│   │   ├── Thread.php                   # Forum threads
│   │   ├── Commentaire.php              # Comments
│   │   ├── Vote.php                     # Thread votes
│   │   ├── Jaime.php                    # Likes
│   │   ├── Notification.php             # User notifications
│   │   ├── Reputation.php               # Reputation points/badges
│   │   ├── article/
│   │   │   ├── Article.php              # Product articles
│   │   │   ├── Order.php                # Order aggregate
│   │   │   └── OrderLine.php            # Order line items
│   │   └── [other entities]
│   │
│   ├── Repository/                      # Data access layer
│   │   ├── EquipementRepository.php
│   │   ├── OperationRepository.php
│   │   ├── article/
│   │   │   ├── ArticleRepository.php
│   │   │   └── OrderRepository.php
│   │   └── [other repositories]
│   │
│   ├── Controller/                      # Request handlers
│   │   ├── AdminController.php          # Admin operations
│   │   ├── AuthController.php           # Authentication
│   │   ├── DashboardController.php      # User dashboard
│   │   ├── ChatbotController.php        # Chatbot endpoints
│   │   ├── WeatherController.php        # Weather API routes
│   │   ├── IrrigationController.php     # Irrigation planning
│   │   ├── RotationController.php       # Crop rotation
│   │   ├── EquipementController.php     # Equipment CRUD
│   │   ├── OperationController.php      # Operations CRUD
│   │   ├── article/
│   │   │   ├── ArticleController.php
│   │   │   └── OrderController.php
│   │   ├── Front/
│   │   │   └── ClientController.php
│   │   ├── BackAdmin/
│   │   ├── BackAgriculteur/
│   │   └── [other controllers]
│   │
│   ├── Service/                         # Business logic layer
│   │   ├── GeminiChatService.php        # AI chatbot orchestration
│   │   ├── WeatherService.php           # Weather aggregation + fallback
│   │   ├── IrrigationService.php        # Water calculations
│   │   ├── RotationCultureService.php   # Crop rotation algorithm
│   │   ├── PlantNetService.php          # Plant identification
│   │   ├── PlantNetResponseMapper.php   # API mapping
│   │   ├── DiseaseAiClient.php          # Disease detection client
│   │   ├── AiTranslationService.php     # HuggingFace translation
│   │   ├── AiModerationService.php      # Content moderation
│   │   ├── TranslatorService.php        # Azure Translator
│   │   ├── QrCodeService.php            # QR code generation
│   │   ├── NotificationService.php      # Notification dispatch
│   │   ├── ReputationService.php        # Reputation scoring
│   │   ├── OperationPdfExporter.php     # PDF export
│   │   ├── EmailService.php             # Email notifications
│   │   ├── ModerationService.php        # Content moderation logic
│   │   ├── ApiNinjasClient.php          # Third-party API client
│   │   └── [other services]
│   │
│   ├── DTO/                             # Data Transfer Objects
│   │   └── [DTOs for API requests/responses]
│   │
│   ├── ApiResource/                     # API Platform resources
│   │   └── [API endpoint definitions]
│   │
│   ├── Model/                           # Value objects & models
│   │   ├── IrrigationInput.php          # Irrigation calculation input
│   │   ├── IrrigationPlan.php           # Irrigation calculation output
│   │   └── [other models]
│   │
│   ├── EventSubscriber/                 # Event handling
│   │   └── [Event subscribers]
│   │
│   ├── Command/                         # Console commands
│   │   └── [CLI commands]
│   │
│   ├── Form/                            # Form types
│   │   └── [Form definitions]
│   │
│   ├── Twig/                            # Twig extensions
│   │   └── [Custom Twig functions/filters]
│   │
│   └── templates/                       # View layer
│       ├── base.html.twig               # Base template
│       ├── backend/                     # Admin templates
│       └── [other templates]
│
├── templates/                           # Root templates
│   └── [Additional templates]
│
├── assets/
│   ├── js/
│   │   ├── chatbot_controller.js        # Chatbot widget
│   │   ├── azure_translate_controller.js
│   │   ├── irrigation.js                # Irrigation UI
│   │   └── weather.js                   # Weather UI
│   ├── css/
│   │   └── [Stylesheets]
│   └── controllers/
│       └── [Stimulus controllers]
│
├── translations/
│   ├── messages.en.yaml                 # English messages
│   ├── messages.fr.yaml                 # French messages
│   ├── messages.ar.yaml                 # Arabic messages
│   ├── validators.en.yaml               # Validation messages
│   ├── validators.fr.yaml
│   └── validators.ar.yaml
│
├── tests/
│   ├── bootstrap.php                    # Test configuration
│   ├── OperationTest.php                # Validation tests
│   └── [Functional/Unit tests]
│
├── microservices/
│   └── plant_disease_ai/                # FastAPI microservice
│       ├── Dockerfile                   # Container definition
│       ├── requirements.txt             # Python dependencies
│       ├── gunicorn_conf.py             # WSGI config
│       ├── README.md                    # Microservice docs
│       └── app/
│           ├── main.py                  # FastAPI application
│           ├── resources/
│           │   ├── model.pt             # PyTorch model
│           │   ├── labels.json          # Disease classes
│           │   └── recommendations.json # Treatment advice
│           └── [other Python modules]
│
├── var/
│   ├── cache/                           # Symfony cache (gitignored)
│   └── log/                             # Application logs (gitignored)
│
├── vendor/                              # Composer dependencies (gitignored)
│
├── compose.yaml                         # Docker Compose production config
├── compose.override.yaml                # Docker Compose development overrides
│
├── composer.json                        # PHP dependencies
├── composer.lock                        # Dependency lock file
│
├── phpunit.dist.xml                     # PHPUnit configuration
├── phpstan.neon                         # PHPStan configuration
│
├── .env                                 # Environment template (versioned)
├── .env.local                           # Local overrides (gitignored)
├── .env.test                            # Test environment
│
├── README.md                            # This file
├── CHATBOT_SETUP.md                     # Chatbot configuration guide
├── CHATBOT_EXAMPLES.md                  # Chatbot integration examples
├── ROTATION_QUICKSTART.md               # Crop rotation guide
├── ROTATION_SUMMARY.txt                 # Rotation algorithm documentation
├── ROTATION_TESTS.md                    # Rotation testing guide
│
└── .gitignore                           # Git exclusions

```

---

## 📋 Requirements

### System Requirements

| Component | Minimum | Recommended |
|-----------|---------|-------------|
| **PHP** | 8.1 | 8.3+ |
| **Composer** | 2.4 | 2.6+ |
| **Node.js** | 18.0 | 20.0+ |
| **Docker** | 20.10 | 25.0+ |
| **PostgreSQL** | 13 | 16 |
| **RAM** | 2 GB | 4+ GB |
| **Disk** | 2 GB | 5+ GB |

### Local Development Tools

```bash
# Required
- PHP 8.1+ with extensions: ctype, iconv, pdo_mysql, pdo_pgsql
- Composer 2.4+
- Symfony CLI 5.4+
- Docker & Docker Compose
- Git

# Optional but recommended
- Node.js 20+ (for frontend tooling)
- Redis (for caching/sessions)
- Postman/Insomnia (for API testing)
```

### PHP Extensions

```
ext-ctype              # Character type checking
ext-iconv              # Character encoding conversion
ext-pdo_mysql          # MySQL driver (for dev)
ext-pdo_pgsql          # PostgreSQL driver (production)
ext-intl                # Internationalization
ext-json               # JSON support
ext-curl               # HTTP client
ext-mbstring           # Multibyte string handling
```

---

## 💾 Installation

### 1. Clone Repository

```bash
git clone https://github.com/yourusername/FlahaSmart.git
cd FlahaSmart
```

### 2. Install PHP Dependencies

```bash
composer install
```

This will:
- Install all PHP packages from `composer.json`
- Execute Symfony Flex recipes
- Clear caches
- Install assets

### 3. Configure Environment

```bash
# Create local environment file
cp .env .env.local

# Edit .env.local with your settings
nano .env.local
# or
code .env.local
```

**Minimum required variables:**
```env
APP_ENV=dev
APP_DEBUG=1
APP_SECRET=ChangeMe!SomeRandomString

DATABASE_URL="postgresql://app:!ChangeMe!@database:5432/app?serverVersion=16&charset=utf8"

# Optional: External APIs
GEMINI_API_KEY=your_gemini_key
WEATHERSTACK_API_KEY=your_weatherstack_key
PLANTNET_API_KEY=your_plantnet_key
AZURE_TRANSLATOR_ENDPOINT=your_azure_endpoint
DISEASE_AI_BASE_URL=http://localhost:8010
```

### 4. Setup Database

```bash
# Create database
symfony console doctrine:database:create

# Run migrations
symfony console doctrine:migrations:migrate

# Load fixtures (optional - for sample data)
symfony console doctrine:fixtures:load
```

### 5. Create First User (Optional)

```bash
symfony console make:user
# Follow interactive prompts to create a test user
```

### 6. Start Development Server

**Option A: Using Symfony CLI (Recommended)**
```bash
symfony server:start
# Opens: http://127.0.0.1:8000
```

**Option B: Using Docker Compose**
```bash
docker-compose up -d
# Access: http://localhost:8000
```

**Option C: Using PHP Built-in Server**
```bash
php -S localhost:8000 -t public/
```

---

## 🔐 Environment Variables

### Core Application

```env
APP_ENV=dev                           # Environment: dev, test, prod
APP_DEBUG=1                           # Debug mode: 0 or 1
APP_SECRET=ChangeMe!RandomString     # Encryption key (min 32 chars)
DOMAIN=localhost                      # Domain name
```

### Database

```env
# PostgreSQL (Production)
DATABASE_URL="postgresql://user:password@localhost:5432/flaha_smart?serverVersion=16"

# MySQL (Alternative)
DATABASE_URL="mysql://user:password@localhost:3306/flaha_smart?serverVersion=8.0"
```

### Security & Authentication

```env
# JWT/OAuth (if implemented)
JWT_SECRET_KEY=your_secret_key
JWT_PUBLIC_KEY=your_public_key
JWT_PASSPHRASE=your_passphrase

# reCAPTCHA (optional)
RECAPTCHA_SITE_KEY=your_site_key
RECAPTCHA_SECRET_KEY=your_secret_key
```

### External APIs

```env
# Google Gemini (AI Chatbot)
GEMINI_API_ENDPOINT=https://generativelanguage.googleapis.com/v1beta/models
GEMINI_MODEL_NAME=gemini-2.5-flash
GEMINI_API_KEY=AIzaSy...YourKeyHere
GEMINI_API_TIMEOUT=30000
GEMINI_CHATBOT_ENABLED=true

# Weather Services
WEATHERSTACK_API_KEY=your_weatherstack_key
WEATHERSTACK_ENDPOINT=http://api.weatherstack.com/current
WEATHERSTACK_TIMEOUT=5000

# Plant Identification
PLANTNET_API_KEY=your_plantnet_key
PLANTNET_API_BASE_URL=https://my-api.plantnet.org/v2
PLANTNET_API_TIMEOUT=10000
PLANTNET_PROJECT=all

# Azure Translator
AZURE_TRANSLATOR_ENDPOINT=https://[resource-name].cognitiveservices.azure.com/
AZURE_TRANSLATOR_REGION=eastus
AZURE_TRANSLATOR_KEY_PRIMARY=your_primary_key
AZURE_TRANSLATOR_KEY_SECONDARY=your_secondary_key
AZURE_TRANSLATOR_CACHE_TTL_SECONDS=3600

# HuggingFace (AI Moderation & Translation)
HF_API_KEY=hf_your_huggingface_key
```

### Microservices

```env
# Plant Disease AI (FastAPI)
DISEASE_AI_BASE_URL=http://localhost:8010
DISEASE_AI_TIMEOUT=30000
```

### Email & Notifications

```env
# Mailer (Google Gmail example)
MAILER_DSN=gmail://user%40gmail.com:app_password@default

# SMS (optional)
SMS_API_KEY=your_sms_key
SMS_SENDER_ID=FlahaSmart

# Notification Channels
TELEGRAM_BOT_TOKEN=your_telegram_token
DISCORD_WEBHOOK_URL=your_discord_webhook
```

### Cache & Performance

```env
# Redis Cache (optional)
REDIS_URL=redis://localhost:6379
CACHE_ADAPTER=redis://localhost:6379/0

# Sessions
SESSION_STORAGE_DSN=handler_id
```

### Translation & Localization

```env
LOCALE=en
FALLBACK_LOCALES=en,fr,ar
```

---

## 🗄 Database

### Database Engine

**Production**: PostgreSQL 16
```bash
docker run -d \
  -e POSTGRES_DB=app \
  -e POSTGRES_USER=app \
  -e POSTGRES_PASSWORD=secure_password \
  -p 5432:5432 \
  postgres:16-alpine
```

**Development**: MySQL 8.0 (via Docker Compose)
```bash
docker-compose up database
```

### Schema Overview

**Users & Authentication**
```
users (id_user, email, password, role, nom, prenom, created_at, ...)
```

**Agricultural Core**
```
equipement (id, nom, type, etat)
operation (id, id_user, type_operation, date_debut, date_fin, statut, equipement_id)
```

**Commerce**
```
articles (id_article, nom, prix, stock, categorie, image_url, qr_code_filename, ...)
commandes (id_commande, reference, date_commande, statut, montant_total, id_user, ...)
commande_lignes (id, order_id, article_id, quantity, price_at_order)
```

**Community & Forum**
```
threads (id_thread, titre, contenu, date_creation, id_user, sentiment, statut, tags, ...)
commentaires (id_commentaire, contenu, date_creation, id_thread, id_user, sentiment, modere_ia, ...)
votes (id_vote, type_vote, id_thread, id_user, date_vote)
jaime (id_jaime, id_thread, id_user, date_jaime)
```

**Engagement**
```
notifications (id_notif, message, type, lu, date_notif, id_user)
reputation (id_rep, points, badge, id_user)
```

### Migrations

```bash
# Create new migration (after entity changes)
symfony console make:migration

# Review migration
cat migrations/Version*.php

# Execute migrations
symfony console doctrine:migrations:migrate

# Rollback last migration
symfony console doctrine:migrations:migrate prev

# See migration status
symfony console doctrine:migrations:status
```

### Fixtures (Sample Data)

```bash
# Load test data
symfony console doctrine:fixtures:load

# Specific fixture
symfony console doctrine:fixtures:load --fixture=src/DataFixtures/UserFixtures.php
```

### Backup & Restore

```bash
# Backup PostgreSQL
pg_dump -U app -h localhost app > backup.sql

# Restore PostgreSQL
psql -U app -h localhost app < backup.sql

# Export data to CSV
symfony console doctrine:query:sql "SELECT * FROM users" > users_export.csv
```

---

## 🚀 Running the Project

### Development Mode

**Method 1: Symfony CLI (Recommended)**
```bash
# Start development server
symfony server:start --allow-http

# Server runs at: http://127.0.0.1:8000
# Press Ctrl+C to stop
```

**Method 2: Docker Compose**
```bash
# Start all services
docker-compose up -d

# View logs
docker-compose logs -f app

# Access application
# http://localhost:8000

# Stop services
docker-compose down
```

**Method 3: PHP Built-in Server**
```bash
php -S localhost:8000 -t public/
```

### Essential Commands

```bash
# Clear cache
symfony console cache:clear

# Warm cache
symfony console cache:warmup

# Check dependencies
composer validate
composer update --dry-run

# Run tests
symfony console phpunit
# or
./vendor/bin/phpunit

# Database operations
symfony console doctrine:database:create
symfony console doctrine:migrations:migrate
symfony console doctrine:fixtures:load

# Code quality
symfony console lint:twig
symfony console lint:yaml
symfony console lint:xliff

# Static analysis
./vendor/bin/phpstan analyse src/

# Create new controller
symfony console make:controller ControllerName

# Create new entity
symfony console make:entity EntityName

# Create new form
symfony console make:form FormName
```

### Asset Management

```bash
# Install assets
symfony console assets:install public/

# Build assets (if using Webpack/Vite)
npm install
npm run build        # Production build
npm run dev          # Development watch mode
```

### Microservice (Plant Disease AI)

```bash
# Start microservice (automatic with start-dev.ps1 on Windows)
cd microservices/plant_disease_ai

# Create Python environment
python -m venv .venv
source .venv/bin/activate  # or .venv\Scripts\activate on Windows

# Install dependencies
pip install -r requirements.txt

# Run development server
uvicorn app.main:app --reload --host 0.0.0.0 --port 8010

# Or with Docker
docker build -t plant-disease-ai .
docker run -p 8010:8000 plant-disease-ai
```

### Production Deployment

```bash
# 1. Set environment to production
export APP_ENV=prod
export APP_DEBUG=0

# 2. Install dependencies (no dev dependencies)
composer install --no-dev --optimize-autoloader

# 3. Build cache
symfony console cache:clear
symfony console cache:warmup

# 4. Run migrations
symfony console doctrine:migrations:migrate --no-interaction

# 5. Build assets
npm run build

# 6. Set proper permissions
setfacl -R -m u:www-data:rwX -m u:`whoami`:rwX var/cache var/log
setfacl -dR -m u:www-data:rwX -m u:`whoami`:rwX var/cache var/log

# 7. Start application server
symfony console server:start --env=prod
```

---

## 🔌 API Documentation

### API Platform Base URL
```
http://localhost:8000/api
```

### Core Endpoints

#### Authentication
```
POST   /api/login              - User login (form_login)
POST   /api/logout             - User logout
GET    /api/me                 - Current user info
```

#### Equipment (CRUD)
```
GET    /api/equipements        - List all equipment
POST   /api/equipements        - Create equipment
GET    /api/equipements/{id}   - Get equipment details
PUT    /api/equipements/{id}   - Update equipment
DELETE /api/equipements/{id}   - Delete equipment
```

#### Operations
```
GET    /api/operations         - List operations
POST   /api/operations         - Create operation
GET    /api/operations/{id}    - Get operation
PUT    /api/operations/{id}    - Update operation
DELETE /api/operations/{id}    - Delete operation
```

#### Smart Irrigation
```
POST   /irrigation/plan        - Generate irrigation plan
GET    /irrigation/cultures    - List supported crops
POST   /irrigation/export-pdf  - Export plan as PDF
```

Request:
```json
{
  "surface": 2.5,
  "culture": "tomate",
  "location": "Tunis",
  "soil_moisture": 45,
  "last_irrigation_date": "2025-01-10",
  "last_water_amount": 50
}
```

Response:
```json
{
  "waterAmount": 75.5,
  "duration": 45,
  "irrigationTime": "06:00",
  "irrigationDate": "2025-01-12",
  "urgencyLevel": "HIGH",
  "justification": "..."
}
```

#### Crop Rotation Planning
```
POST   /rotation/analyser      - Analyze crop rotation
```

Request:
```json
{
  "surface": 3,
  "type_sol": "limoneux",
  "azote": 6,
  "phosphore": 5,
  "potassium": 7,
  "ph": 6.5,
  "derniere_culture": "ble",
  "avant_derniere_culture": "tomate",
  "annees_jachaire": 1,
  "duree_plan": 5
}
```

Response:
```json
{
  "success": true,
  "recommendations": [
    {
      "culture": "tomate",
      "score": 92,
      "raison": "Culture exigeante, sol suffisamment riche",
      "benefices": ["Diversité", "Rendement élevé"]
    },
    {
      "culture": "lentille",
      "score": 78,
      "raison": "Légumineuse enrichissante en azote",
      "benefices": ["Régénération azotée"]
    }
  ],
  "plan": {
    "annee_1": "tomate",
    "annee_2": "lentille",
    "score_global": 85,
    "diversite": 5
  }
}
```

#### AI Chatbot
```
POST   /chatbot/ask            - Ask agricultural question
GET    /chatbot/health         - Health check
```

Request:
```json
{
  "message": "How to prevent tomato leaf diseases?"
}
```

Response:
```json
{
  "response": "For tomato leaf diseases, apply proper crop rotation, ensure good air circulation, avoid overhead watering, and use disease-resistant varieties..."
}
```

#### Plant Disease Detection
```
POST   /disease/predict        - Predict disease from image
```

Multipart Form Data:
```
image: <file>  (JPG, PNG - max 8MB)
```

Response:
```json
{
  "top_prediction": {
    "disease": "Early Blight",
    "confidence": 0.92,
    "recommendation": "Apply fungicide spray, remove affected leaves"
  },
  "predictions": [
    {"disease": "Early Blight", "confidence": 0.92},
    {"disease": "Late Blight", "confidence": 0.06},
    {"disease": "Healthy", "confidence": 0.02}
  ]
}
```

#### Products & Orders
```
GET    /api/articles           - List products
POST   /api/articles           - Create product
POST   /api/commandes          - Create order
GET    /api/commandes/{id}     - Get order details
```

#### Forum & Community
```
GET    /api/threads            - List forum threads
POST   /api/threads            - Create thread
GET    /api/threads/{id}/comments - Get comments
POST   /api/threads/{id}/comments - Add comment
POST   /api/threads/{id}/vote  - Vote on thread
```

#### Notifications
```
GET    /api/notifications      - Get user notifications
PATCH  /api/notifications/{id} - Mark notification as read
DELETE /api/notifications/{id} - Delete notification
```

### API Response Format

All API responses follow JSON:API specification:

**Success Response**
```json
{
  "status": "success",
  "data": {
    "id": 1,
    "type": "equipment",
    "attributes": {
      "name": "Tractor John Deere",
      "type": "Tractor",
      "state": "active"
    }
  }
}
```

**Error Response**
```json
{
  "status": "error",
  "error": {
    "code": "VALIDATION_ERROR",
    "message": "Validation failed",
    "details": [
      {
        "field": "email",
        "message": "This email is already used"
      }
    ]
  }
}
```

### API Authentication

```bash
# Login to get session/token
curl -X POST http://localhost:8000/login \
  -H "Content-Type: application/json" \
  -d '{"email":"user@example.com","password":"password"}'

# Include in subsequent requests
curl -X GET http://localhost:8000/api/equipements \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json"
```

### Rate Limiting

```
X-RateLimit-Limit: 100
X-RateLimit-Remaining: 99
X-RateLimit-Reset: 1703001600
```

### Pagination

```
GET /api/equipements?page=1&itemsPerPage=20
```

Response:
```json
{
  "hydra:member": [...],
  "hydra:totalItems": 150,
  "hydra:itemsPerPage": 20,
  "hydra:firstPage": "/api/equipements?page=1",
  "hydra:lastPage": "/api/equipements?page=8"
}
```

---

## 🔒 Security

### Authentication

**Method**: Form-based login with email/password

```yaml
# config/packages/security.yaml
firewalls:
  main:
    lazy: true
    provider: app_user_provider
    form_login:
      login_path: app_login
      check_path: app_login
      username_parameter: email
      password_parameter: password
      csrf_token_id: authenticate
      enable_csrf: true
    logout:
      path: app_logout
      target: app_login
```

**Login Flow**:
1. User submits email + password via form
2. Password hashed with Symfony's password encoder (auto algorithm)
3. Session created on successful authentication
4. CSRF token required for form submission

**Password Hashing**:
```php
// Uses PHP's password_hash() with auto detection
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
```

### Authorization & Access Control

**Role-Based Access Control (RBAC)**

```yaml
access_control:
  - { path: ^/login, roles: PUBLIC_ACCESS }
  - { path: ^/register, roles: PUBLIC_ACCESS }
  - { path: ^/dashboard, roles: ROLE_USER }
  - { path: ^/admin, roles: ROLE_ADMIN }
  - { path: ^/api, roles: ROLE_USER }
```

**User Roles**:
```php
enum Role {
    ADMIN        // Full system access
    AGRICULTEUR  // Farmer - agricultural features
    CLIENT       // Customer - commerce/forum
    USER         // Generic authenticated user
}
```

**Checking Roles in Code**:
```php
// In controller
if ($this->isGranted('ROLE_ADMIN')) {
    // Admin-only code
}

// In Twig template
{% if is_granted('ROLE_ADMIN') %}
    <a href="/admin">Admin Panel</a>
{% endif %}
```

### CSRF Protection

```php
// Form CSRF token
<form method="POST" action="/login">
    <input type="hidden" name="_csrf_token" value="{{ csrf_token('authenticate') }}">
</form>

// Verified automatically by Symfony
```

### Data Validation

**Entity-level constraints**:
```php
class Operation {
    #[Assert\NotBlank(message: 'validators.operation.type_operation.not_blank')]
    #[Assert\Length(min: 5, minMessage: 'validators.operation.type_operation.min_length')]
    #[Assert\Regex(
        pattern: '/^[\p{L}0-9 ]+$/u',
        message: 'validators.operation.type_operation.invalid_chars'
    )]
    private ?string $type_operation = null;
    
    #[Assert\GreaterThanOrEqual(
        value: 'today',
        message: 'validators.operation.date_debut.not_in_past'
    )]
    private ?\DateTimeInterface $date_debut = null;
}
```

**Custom validation messages in multiple languages**:
```yaml
# translations/validators.en.yaml
validators:
  operation:
    type_operation:
      not_blank: 'Operation type is required'
      min_length: 'Operation type must be at least 5 characters'
    date_debut:
      not_in_past: 'Start date cannot be in the past'
```

### SQL Injection Prevention

```php
// ✅ SAFE: Uses prepared statements via ORM
$equipment = $this->equipmentRepository->findOneBy(['nom' => $userInput]);

// ✅ SAFE: Query builder with parameters
$operations = $this->operationRepository
    ->createQueryBuilder('o')
    ->where('o.type_operation = :type')
    ->setParameter('type', $userInput)
    ->getQuery()
    ->getResult();

// ❌ DANGEROUS: String concatenation
$query = "SELECT * FROM equipment WHERE nom = '$userInput'"; // NEVER DO THIS
```

### XSS (Cross-Site Scripting) Prevention

```php
// Twig auto-escapes by default
{{ userInput }}  <!-- Automatically escaped -->

// Manual escaping if needed
{{ userInput|escape('html') }}
{{ userInput|escape('js') }}
{{ userInput|escape('url') }}
```

### Secure Password Policies

```
- Minimum 8 characters (configurable)
- No plain text storage (hashed)
- Auto-logout after 30 minutes of inactivity
- Password reset via email verification
```

### API Security

```php
// Authentication required for all /api routes
#[IsGranted('ROLE_USER')]
#[Route('/api/equipements', methods: ['GET'])]
public function listEquipment(): Response {}

// Rate limiting
#[RateLimit(limit: 100, interval: 60)]
#[Route('/api/chatbot/ask', methods: ['POST'])]
public function askChatbot(Request $request): Response {}
```

### Security Headers

```
Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'
X-Frame-Options: SAMEORIGIN
X-Content-Type-Options: nosniff
X-XSS-Protection: 1; mode=block
Referrer-Policy: strict-origin-when-cross-origin
```

### Environment Security

```bash
# Never commit secrets
.env.local          # LOCAL ONLY - ignored by git
.env.*.local        # Environment-specific - ignored by git
secrets/            # Sensitive configuration

# Use Docker secrets for production
docker secret create db_password -
docker service create --secret db_password \
  -e DATABASE_PASSWORD_FILE=/run/secrets/db_password \
  app-service
```

### Regular Security Audits

```bash
# Check for vulnerable dependencies
composer audit

# Run security linter
symfony console lint:security

# Check for known vulnerabilities
symfony check:security
```

---

## 🤖 AI & Microservices

### Google Gemini Chatbot

**Purpose**: Agricultural expert assistant providing farming advice

**Capabilities**:
- Crop disease identification
- Irrigation recommendations
- Pest management strategies
- Sustainable farming practices
- Multilingual support

**System Prompt**:
```
You are an expert agricultural assistant helping farmers with crops,
irrigation, soil, pests, equipment maintenance, and sustainable farming.
Respond ONLY to agriculture-related questions.
Provide practical, actionable advice based on best practices.
```

**Integration**:
```php
// src/Service/GeminiChatService.php
$response = $geminiChatService->ask("How to prevent blight in tomatoes?");
```

**Configuration**:
```env
GEMINI_API_ENDPOINT=https://generativelanguage.googleapis.com/v1beta/models
GEMINI_MODEL_NAME=gemini-2.5-flash
GEMINI_API_KEY=AIzaSy...
GEMINI_API_TIMEOUT=30000
GEMINI_CHATBOT_ENABLED=true
```

### Plant Disease AI (FastAPI Microservice)

**Purpose**: Detect plant diseases from uploaded images using deep learning

**Architecture**:
```
Image Upload → FastAPI Endpoint → PyTorch Model → Disease Classification
```

**Model Details**:
- Framework: PyTorch
- Model Format: TorchScript (.pt)
- Input: Plant leaf image (JPG, PNG)
- Output: Top-3 disease predictions with confidence scores

**Endpoints**:
```
POST /predict-disease          - Classify disease
GET  /health                   - Health check
```

**Docker Setup**:
```dockerfile
FROM python:3.11-slim

# Install dependencies
COPY requirements.txt /app/
RUN pip install -r requirements.txt

# Copy model & app
COPY app /app/app
COPY gunicorn_conf.py /app/

# Run with Gunicorn
CMD ["gunicorn", "-c", "gunicorn_conf.py", "app.main:app"]
```

**Starting Microservice**:
```bash
# Automatic (Windows)
.\bin\ensure-disease-ai.ps1

# Manual (Linux/Mac)
cd microservices/plant_disease_ai
python -m venv .venv
source .venv/bin/activate
pip install -r requirements.txt
uvicorn app.main:app --host 0.0.0.0 --port 8010

# Docker
docker-compose up disease-ai
```

**Integration with Symfony**:
```php
// src/Service/DiseaseAiClient.php
$prediction = $diseaseAiClient->predictDisease($uploadedImage);
// Returns: top_prediction, predictions array, recommendations
```

### PlantNet API Integration

**Purpose**: Plant species identification using computer vision

**Features**:
- 600,000+ plant species database
- Multi-image identification
- Geographic reasoning
- Taxonomy information

**Service**:
```php
$plantIdentification = $plantNetService->identifyPlant($image, $location);
```

**Response**:
```json
{
  "species": "Solanum lycopersicum",
  "common_name": "Tomato",
  "confidence": 0.85,
  "taxonomy": {...}
}
```

### WeatherStack API

**Purpose**: Real-time weather data integration

**Fallback Strategy**:
1. Try WeatherStack API
2. On failure → Fall back to Open-Meteo (free alternative)

```php
$weather = $weatherService->getCurrentWeather("Tunis");
// Returns: temperature, humidity, wind_speed, weather_descriptions, etc.
```

### Azure Translator

**Purpose**: Multi-language translation service

**Supported Languages**: Arabic (AR), English (EN), French (FR)

```php
$translated = $translatorService->translate(
    "How to water tomatoes?",
    "en",
    "ar"  // Translate to Arabic
);
```

### HuggingFace Models

**Use Cases**:
- Content moderation
- Sentiment analysis
- AI translation fallback

```php
// Moderation
$moderation = $aiModerationService->moderate($userComment);

// Sentiment
$sentiment = $translationService->detectSentiment("Great harvest this year!");
```

---

## 📚 Feature Guide

### Smart Irrigation System

**Algorithm Overview**:
```
Base Water Need (by crop type)
  ↓
× Temperature Factor (hot days = more water)
  ↓
× Humidity Factor (dry air = more water)
  ↓
× Weather Factor (rain forecast = less water)
  ↓
× Soil Factor (dry soil = more water)
  ↓
× History Factor (previous irrigation amount)
  ↓
= Final Water Recommendation
```

**Supported Crops**:
```
Ble (Wheat)          - 5.0 L/m²
Mais (Corn)          - 7.0 L/m²
Tomate (Tomato)      - 6.0 L/m²
Riz (Rice)           - 8.0 L/m²
Lentille (Lentil)    - 4.0 L/m²
Pois (Peas)          - 4.5 L/m²
Patate (Potato)      - 5.5 L/m²
Betterave (Beet)     - 5.0 L/m²
Oignon (Onion)       - 4.8 L/m²
Carotte (Carrot)     - 4.6 L/m²
```

**Example Usage**:
```bash
curl -X POST http://localhost:8000/irrigation/plan \
  -H "Content-Type: application/json" \
  -d '{
    "surface": 2.5,
    "culture": "tomate",
    "location": "Tunis",
    "soil_moisture": 45,
    "last_irrigation_date": "2025-01-10",
    "last_water_amount": 50
  }'
```

### Crop Rotation Planning

**Algorithm**:
1. Analyze soil nutrients (N, P, K)
2. Check crop history (prevent repetition)
3. Score each crop based on compatibility
4. Generate multi-year rotation plan
5. Calculate plan quality metrics

**Scoring Factors**:
- Crop nutrient demands vs. soil availability
- Disease cycle prevention
- Soil enrichment from legumes
- Crop rotation best practices
- Historical data

**Urgency Levels**:
```
CRITICAL  - Water immediately
HIGH      - Within 24 hours
MEDIUM    - Within 2-3 days
LOW       - Within a week
NONE      - No irrigation needed (high soil moisture or rain)
```

### Community Forum

**Features**:
- Threaded discussions with hierarchical comments
- Voting system (upvote/downvote)
- Likes/Favorites
- User reputation & badges
- AI-powered moderation
- Sentiment analysis of posts
- Multi-language support

**Thread Lifecycle**:
```
Created → Active → Closed/Resolved → Archived
```

**Reputation System**:
```
+10 points   - Thread creation
+5 points    - Comment posted
+2 points    - Upvote received
-1 point     - Downvote
0 badge      - < 50 points
Bronze badge - 50-150 points
Silver badge - 150-500 points
Gold badge   - 500+ points
```

---

## 🧪 Testing

### Unit Tests

```bash
# Run all tests
symfony console phpunit

# Run specific test file
./vendor/bin/phpunit tests/OperationTest.php

# Run specific test method
./vendor/bin/phpunit tests/OperationTest.php --filter=testOperationValideSansErreur

# Generate coverage report
./vendor/bin/phpunit --coverage-html=coverage/
```

### Test Example

```php
// tests/OperationTest.php
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class OperationTest extends TestCase
{
    public function testOperationValideSansErreur(): void
    {
        $operation = new Operation();
        $operation->setTypeOperation('Labour');
        $operation->setDateDebut(new \DateTimeImmutable('today'));
        $operation->setDateFin(new \DateTimeImmutable('today'));
        
        $violations = $this->getValidator()->validate($operation);
        
        $this->assertCount(0, $violations);
    }
    
    public function testTypeOperationInvalideSiTropCourt(): void
    {
        $operation = new Operation();
        $operation->setTypeOperation('Test');  // Too short (min 5)
        
        $violations = $this->getValidator()->validate($operation);
        
        $this->assertGreaterThan(0, $violations->count());
    }
}
```

### Functional Tests

```php
// tests/Controller/EquipmentControllerTest.php
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EquipmentControllerTest extends WebTestCase
{
    public function testEquipmentListPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/equipements');
        
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Equipment List');
    }
}
```

### API Tests

```php
// Test API endpoint
$client = static::createClient();
$client->request('GET', '/api/equipements', [], [], [
    'HTTP_AUTHORIZATION' => 'Bearer ' . $token,
]);

$this->assertJsonStringEqualsJsonString(
    json_encode(['status' => 'success']),
    $client->getResponse()->getContent()
);
```

### Performance Testing

```bash
# Load testing with Apache Bench
ab -n 1000 -c 10 http://localhost:8000/

# With authentication
ab -n 1000 -c 10 -H "Authorization: Bearer $TOKEN" http://localhost:8000/api/equipements

# Profiling with Blackfire
blackfire run php bin/console doctrine:query:sql "SELECT * FROM equipement"
```

---

## 🐳 Docker & DevOps

### Docker Compose

**Production Configuration** (`compose.yaml`):
```yaml
version: '3.8'

services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    environment:
      APP_ENV: prod
      DATABASE_URL: postgresql://app:password@database:5432/app
    ports:
      - "8000:8000"
    depends_on:
      - database
      - disease-ai

  database:
    image: postgres:16-alpine
    environment:
      POSTGRES_DB: app
      POSTGRES_PASSWORD: secure_password
    volumes:
      - database_data:/var/lib/postgresql/data
    healthcheck:
      test: ["CMD-SHELL", "pg_isready -U app"]
      interval: 10s
      timeout: 5s
      retries: 5

  disease-ai:
    build:
      context: ./microservices/plant_disease_ai
    ports:
      - "8010:8000"
    environment:
      MODEL_PATH: app/resources/model.pt
      DEVICE: cpu
    healthcheck:
      test: ["CMD", "curl", "-f", "http://localhost:8000/health"]
      interval: 30s
      timeout: 3s
      retries: 3

volumes:
  database_data:
```

**Development Override** (`compose.override.yaml`):
```yaml
version: '3.8'

services:
  app:
    build:
      context: .
      target: app_dev  # Use development Dockerfile stage
    environment:
      APP_ENV: dev
      APP_DEBUG: "1"
      PHP_IDE_CONFIG: serverName=app
    ports:
      - "8000:8000"
      - "9003:9003"  # XDebug port
    volumes:
      - .:/app
      - /app/var
    command: symfony server:start --allow-http
```

### Dockerfile

**Production-optimized Dockerfile**:
```dockerfile
FROM php:8.3-fpm-alpine AS app

# Install system packages
RUN apk add --no-cache \
    postgresql-dev \
    git \
    curl

# Install PHP extensions
RUN docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_pgsql \
    pdo_mysql \
    intl \
    mbstring

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Copy application
COPY . .

# Create necessary directories
RUN mkdir -p var/cache var/log public/uploads
RUN chmod -R 777 var public/uploads

# Expose port
EXPOSE 9000

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
  CMD curl -f http://localhost:9000/health || exit 1

# Start PHP-FPM
CMD ["php-fpm"]
```

### Kubernetes (Future)

```yaml
apiVersion: v1
kind: Pod
metadata:
  name: flaha-smart
  labels:
    app: flaha-smart
spec:
  containers:
  - name: app
    image: flaha-smart:latest
    ports:
    - containerPort: 8000
    env:
    - name: APP_ENV
      value: prod
    - name: DATABASE_URL
      valueFrom:
        secretKeyRef:
          name: db-secret
          key: url
```

### CI/CD Pipeline

**GitHub Actions Example** (`.github/workflows/deploy.yml`):
```yaml
name: Deploy

on:
  push:
    branches: [main]

jobs:
  deploy:
    runs-on: ubuntu-latest
    
    steps:
    - uses: actions/checkout@v3
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.3'
        extensions: pdo_pgsql, intl, mbstring
    
    - name: Install dependencies
      run: |
        composer install --no-dev --optimize-autoloader
        npm install && npm run build
    
    - name: Run tests
      run: ./vendor/bin/phpunit
    
    - name: Run linters
      run: |
        ./vendor/bin/phpstan analyse src/
        symfony console lint:twig
    
    - name: Build Docker image
      run: docker build -t flaha-smart:${{ github.sha }} .
    
    - name: Push to registry
      run: |
        echo ${{ secrets.REGISTRY_PASSWORD }} | docker login -u ${{ secrets.REGISTRY_USER }} --password-stdin
        docker push flaha-smart:${{ github.sha }}
    
    - name: Deploy
      run: |
        # Your deployment commands here
```

---

## 🔧 Troubleshooting

### Common Issues

#### 1. Database Connection Error
```
Error: SQLSTATE[HY000]: General error: unable to connect

Solution:
✓ Check DATABASE_URL in .env.local
✓ Ensure PostgreSQL is running: docker-compose up database
✓ Verify credentials: POSTGRES_USER, POSTGRES_PASSWORD
✓ Test connection: symfony console doctrine:database:create
```

#### 2. Cache Issues
```
Error: Cache corrupted / stale data

Solution:
symfony console cache:clear
symfony console cache:clear --env=prod
rm -rf var/cache/*
```

#### 3. Migrations Pending
```
Error: Database is not migrated

Solution:
symfony console doctrine:migrations:status
symfony console doctrine:migrations:migrate
symfony console doctrine:migrations:migrate --dry-run  # Preview
```

#### 4. Permission Denied Errors
```
Error: Failed to write cache / log files

Solution (Linux/Mac):
setfacl -R -m u:www-data:rwX -m u:`whoami`:rwX var/cache var/log
setfacl -dR -m u:www-data:rwX -m u:`whoami`:rwX var/cache var/log

Solution (Windows):
icacls var /grant "%USERNAME%:F" /T
```

#### 5. Asset Loading Issues
```
Error: CSS/JS files not loading (404)

Solution:
symfony console assets:install public/
symfony console asset-map:compile
npm run build
```

#### 6. API Returns 401 Unauthorized
```
Error: No credentials provided / invalid token

Solution:
✓ Login first: POST /login
✓ Check session cookie is present
✓ Verify Authorization header: Bearer <token>
✓ Check user roles: ROLE_USER required for /api/*
```

#### 7. Gemini Chatbot Not Working
```
Error: Chatbot returns error message

Solution:
✓ Check GEMINI_API_KEY is set in .env.local
✓ Verify API key is valid on Google Cloud
✓ Check GEMINI_CHATBOT_ENABLED=true
symfony console cache:clear
```

#### 8. Disease AI Microservice Not Found
```
Error: "Microservice unavailable"

Solution:
✓ Start microservice: cd microservices/plant_disease_ai && uvicorn app.main:app --port 8010
✓ Check DISEASE_AI_BASE_URL=http://localhost:8010
✓ Verify model files exist: app/resources/model.pt
✓ Check firewall allows port 8010
```

#### 9. Email Not Sending
```
Error: Emails don't arrive

Solution:
✓ Check MAILER_DSN is configured in .env.local
✓ Test: symfony console mailer:test user@example.com
✓ For Gmail: Use app-specific password, not main password
✓ Check PHP mail configuration: php -i | grep mail
```

#### 10. Docker Container Won't Start
```
Error: docker-compose up fails

Solution:
✓ Check logs: docker-compose logs app
✓ Ensure port 8000 isn't in use: lsof -i :8000
✓ Rebuild images: docker-compose build --no-cache
✓ Clean volumes: docker-compose down -v
```

### Debug Tools

```bash
# Enable debug mode
export APP_DEBUG=1

# View Symfony logs
tail -f var/log/dev.log
tail -f var/log/prod.log

# Database debugging
VERBOSE=1 symfony console doctrine:query:sql "SELECT * FROM equipement LIMIT 1"

# Console command debugging
symfony console command:name -vvv

# Web Profiler
# Access: /_profiler (only in dev mode)

# Check service status
symfony console debug:autowiring

# Container debugging
docker-compose logs -f app
docker-compose exec app bash
```

### Health Checks

```bash
# Application health
curl http://localhost:8000/

# API endpoint health
curl http://localhost:8000/api/

# Database connection
symfony console doctrine:query:sql "SELECT 1"

# Microservice health
curl http://localhost:8010/health

# Cache status
symfony console cache:pool:list
```

---

## 🤝 Contributing

### Code Standards

We follow PSR-12 PHP coding standards and Symfony best practices.

```bash
# Code style checking
./vendor/bin/phpcs --standard=PSR12 src/

# Auto-fix code style
./vendor/bin/phpcbf --standard=PSR12 src/

# Static analysis
./vendor/bin/phpstan analyse src/ --level=8

# Code quality
./vendor/bin/phpmetrics --report-html=metrics/ src/
```

### Pull Request Process

1. **Fork the repository**
```bash
git clone https://github.com/yourusername/FlahaSmart.git
cd FlahaSmart
```

2. **Create a feature branch**
```bash
git checkout -b feature/amazing-feature
```

3. **Make changes and commit**
```bash
git add .
git commit -m "feat: Add amazing feature"
```

4. **Push to your fork**
```bash
git push origin feature/amazing-feature
```

5. **Create Pull Request**
   - Describe your changes clearly
   - Reference any related issues
   - Ensure CI/CD passes
   - Request review from maintainers

### Commit Message Convention

```
<type>(<scope>): <subject>

<body>

<footer>
```

**Types**: `feat`, `fix`, `docs`, `style`, `refactor`, `perf`, `test`, `chore`

**Examples**:
```
feat(chatbot): Add streaming responses
fix(irrigation): Correct water calculation for clay soil
docs(readme): Add troubleshooting section
test(disease-ai): Add integration tests
```

### Code Review Checklist

- [ ] Code follows PSR-12 standards
- [ ] No hardcoded values/credentials
- [ ] Tests pass locally
- [ ] Documentation updated
- [ ] No SQL injection vulnerabilities
- [ ] No XSS vulnerabilities
- [ ] Performance optimizations considered
- [ ] Backward compatibility maintained

---

## 📄 License

This project is proprietary software developed for ESPRIT (Ecole Supérieure Privée d'Ingénierie et de Technologie).

**License Type**: Proprietary
**© 2024-2025 ESPRIT**

Unauthorized copying, modification, or redistribution of this software is prohibited.

---

## 👥 Authors & Contributors

### Project Owner
- **ESPRIT 3A10 2024-2025** - Practical Internship (PIDEV) Project

### Development Team
- **Integration Lead**: Bachar (Final Integration)
- **Architecture & Backend**: Symfony/PHP
- **AI Services**: Google Gemini, PlantNet, Disease Detection
- **DevOps**: Docker, PostgreSQL

### Acknowledgments
- Symfony Community & Documentation
- API Platform for REST/JSON:API Framework
- FastAPI for Microservice Framework
- Open-source contributors

---

## 📞 Support & Contact

### Getting Help

- **Documentation**: See README.md sections above
- **Issues**: Report bugs via GitHub Issues
- **Discussions**: GitHub Discussions for feature requests
- **Email**: Project maintained through ESPRIT

### Additional Resources

- [Symfony Documentation](https://symfony.com/doc/current/index.html)
- [API Platform Guide](https://api-platform.com/docs/)
- [Doctrine ORM Manual](https://www.doctrine-project.org/projects/doctrine-orm/en/3.6/index.html)
- [Docker Documentation](https://docs.docker.com/)

---

## 🗺️ Project Roadmap

### Current Status: Production Ready ✅
- Core features implemented
- API fully functional
- Microservices operational
- Documentation complete

### Planned Enhancements
- [ ] Mobile app (React Native/Flutter)
- [ ] Real-time notifications (WebSockets)
- [ ] Advanced analytics dashboard
- [ ] Drone integration for field imaging
- [ ] IoT sensor integration
- [ ] Machine learning for yield prediction
- [ ] Blockchain for supply chain transparency
- [ ] Multi-tenant SaaS architecture

### Version History

| Version | Date | Features |
|---------|------|----------|
| 1.0.0 | 2025-05-11 | Initial release |
| - | - | - |

---

<div align="center">

### ⭐ If you found this project helpful, please consider giving it a star!

[Report Bug](../../issues) · [Request Feature](../../issues) · [Documentation](../../wiki)

**Built with ❤️ by ESPRIT Students**

</div>
