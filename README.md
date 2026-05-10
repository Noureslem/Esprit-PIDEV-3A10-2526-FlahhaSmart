<p align="center">
  <img src="https://img.shields.io/badge/Symfony-6.x-black?style=for-the-badge&logo=symfony&logoColor=white" alt="Symfony"/>
  <img src="https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP"/>
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL"/>
  <img src="https://img.shields.io/badge/Google_Gemini-AI-4285F4?style=for-the-badge&logo=google&logoColor=white" alt="Gemini AI"/>
  <img src="https://img.shields.io/badge/License-Academic-green?style=for-the-badge" alt="License"/>
</p>

<h1 align="center">🌾 FlahaSmart</h1>

<p align="center">
  <strong>Plateforme intelligente de gestion agricole avec IA et APIs intégrées</strong>
</p>

<p align="center">
  Application Symfony moderne combinant gestion d'opérations agricoles, système d'irrigation intelligent,
  rotation optimisée des cultures, chatbot IA propulsé par Google Gemini,
  et un module Articles & Commandes avec estimation de prix par vision IA.
</p>

---

## 📋 Table des matières

- [Présentation](#-présentation)
- [Fonctionnalités](#-fonctionnalités)
- [Module Articles & Commandes](#-module-articles--commandes)
- [Architecture](#-architecture)
- [Technologies](#-technologies)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Structure du projet](#-structure-du-projet)
- [APIs Intégrées](#-apis-intégrées)
- [Auteur](#-auteur)

---

## 🎯 Présentation

**FlahaSmart** est une solution complète de gestion agricole intelligente qui combine :

| Module | Description |
|--------|-------------|
| 🚜 **Gestion CRUD** | Équipements et opérations agricoles |
| 🌡️ **Météo temps réel** | API WeatherStack avec conseils dynamiques |
| 💧 **Irrigation intelligente** | Calcul automatique des besoins en eau |
| 🔄 **Rotation des cultures** | Planification optimisée pluriannuelle |
| 🤖 **AgriBot IA** | Chatbot propulsé par Google Gemini 2.5 Flash |
| 🛒 **Articles & Commandes** | Todo list + estimateur de prix par image IA |

### ✨ Points forts

```
✅ Interface moderne avec design glassmorphism et dégradés verts
✅ APIs externes intégrées (WeatherStack, Gemini Vision...)
✅ Système d'irrigation basé sur 7 critères météo et agronomiques
✅ Estimation automatique de prix via analyse d'image par IA
✅ Todo list intelligente intégrée à la gestion des commandes
✅ Architecture MVC professionnelle Symfony avec services dédiés
✅ Génération de prix en temps réel depuis une photo produit
```

---

## 🌟 Fonctionnalités

### 1. 🚜 Gestion des Équipements

| Fonction | Description |
|----------|-------------|
| Ajouter | Créer un équipement (nom, type) |
| Modifier | Mettre à jour les informations |
| Supprimer | Suppression avec confirmation |
| Lister | Affichage en tableau moderne |
| Rechercher | Recherche dynamique par nom |
| Trier | Tri alphabétique |

**Statuts** : `Libre` | `Réservé`

---

### 2. 🔧 Gestion des Opérations

| Fonction | Description |
|----------|-------------|
| Créer | Nouvelle opération avec équipement associé |
| Modifier | Mise à jour complète |
| Terminer | Changement de statut en un clic |
| Supprimer | Avec confirmation |
| Filtrer | Par statut (en cours / terminé) |

---

### 3. 📊 Dashboard Intelligent

- **Statistiques opérations** : Total, En cours, Terminées avec compteurs animés
- **Statistiques équipements** : Répartition par type, Libres vs Réservés
- **Navigation intelligente** : Clic sur une carte → Redirection directe

---

### 4. 🌤️ Météo & Conseils Agricoles Dynamiques

#### Widget Météo (API WeatherStack)
```
🌡️ Température actuelle et ressentie
💧 Humidité (%)
💨 Vitesse du vent (km/h)
☁️ Description des conditions
🕐 Heure locale
```

#### Conseils Agricoles Intelligents

| Critère | Analyse |
|---------|---------|
| **Température** | Alertes canicule/gel, conditions optimales |
| **Humidité** | Risques maladies fongiques, arrosage |
| **Vent** | Conditions de pulvérisation, protection |
| **Conditions** | Pluie, nuages, ensoleillement |

**Code couleur** : 🔴 Critique | 🟡 Attention | 🟢 Optimal | 🔵 Information

---

### 5. 💧 Système Intelligent d'Irrigation

Calcul automatique des besoins en eau selon 7 critères :

| Critère | Rôle |
|---------|------|
| 🌡️ Température actuelle | Évapotranspiration |
| 💧 Humidité du sol | Rétention hydrique |
| 🌧️ Précipitations prévues | Report irrigation |
| 🌱 Type de culture | Besoins spécifiques |
| 📅 Dernière irrigation | Fréquence optimale |
| 💦 Quantité précédente | Ajustement progressif |
| 🌍 Type de sol | Capacité de rétention |

**Priorités** : `Critique` | `Haute` | `Moyenne` | `Faible`

---

### 6. 🔄 Système de Rotation des Cultures

Plan pluriannuel (1 à 10 ans) basé sur :
- Type de sol (Argileux, Limoneux, Sableux...)
- Historique des cultures
- Niveaux de nutriments (N, P, K)
- pH du sol (4.0 – 9.0)
- Années depuis jachère

---

### 7. 🤖 AgriBot — Chatbot IA (Google Gemini 2.5 Flash)

Chatbot intelligent pour :
- Conseils de culture personnalisés
- Diagnostic de problèmes agronomiques
- Recommandations saisonnières
- Bonnes pratiques agricoles

---

## 🛒 Module Articles & Commandes

Le module Articles & Commandes est enrichi de deux fonctionnalités IA avancées :

---

### 📝 Todo List intégrée

Système de gestion de tâches directement lié aux commandes agricoles :

| Fonctionnalité | Description |
|----------------|-------------|
| ➕ Ajouter une tâche | Créer une tâche associée à une commande |
| ✅ Marquer comme faite | Suivi de l'avancement en temps réel |
| 🗑️ Supprimer | Supprimer une tâche terminée |
| 📋 Lister | Vue complète des tâches par commande |
| 🔢 Priorité | Organisation par niveau d'urgence |

**Statuts de tâche** : `À faire` | `En cours` | `Terminée`

---

### 🤖 Estimateur de Prix par Image IA

Fonctionnalité phare du module : **estimer automatiquement le prix d'un produit agricole à partir d'une photo**, grâce à la vision par IA de Google Gemini.

#### Comment ça fonctionne

```
1. 📸  L'utilisateur upload une image du produit (légume, fruit, équipement...)
2. 🤖  L'image est envoyée à l'API Google Gemini Vision
3. 🧠  L'IA analyse : type de produit, état, qualité visuelle, contexte marché
4. 💰  Un prix estimé est retourné automatiquement avec une explication
5. 📝  Le prix peut être appliqué directement à l'article ou à la commande
```

#### Données analysées par l'IA

| Critère visuel | Ce que l'IA détecte |
|----------------|---------------------|
| 🌿 **Type de produit** | Légume, fruit, céréale, équipement... |
| ⭐ **Qualité** | État du produit, fraîcheur, maturité |
| 📦 **Quantité estimée** | Masse ou volume apparent |
| 🏷️ **Contexte marché** | Estimation basée sur données agricoles |
| 📊 **Fourchette de prix** | Prix min / prix max / prix recommandé |

#### Interface utilisateur

```
┌─────────────────────────────────────────────────┐
│           🤖 Estimateur de Prix IA              │
├─────────────────────────────────────────────────┤
│  📸 Uploader une image produit                  │
│  ┌───────────────────────────────────────────┐  │
│  │                                           │  │
│  │    [Glisser-déposer ou choisir fichier]   │  │
│  │                                           │  │
│  └───────────────────────────────────────────┘  │
│                                                 │
│  [🔍 Analyser l'image]                         │
│                                                 │
│  ✅ Résultat IA :                              │
│  Produit détecté : Tomates fraîches             │
│  Qualité estimée : Bonne (Grade A)              │
│  💰 Prix estimé : 2.50 TND/kg                  │
│  Fourchette : 2.00 – 3.00 TND/kg               │
│                                                 │
│  [✔ Appliquer ce prix à l'article]             │
└─────────────────────────────────────────────────┘
```

#### Exemple de réponse IA

```json
{
  "produit": "Tomates fraîches",
  "qualite": "Grade A - Bonne fraîcheur",
  "prix_estime": 2.50,
  "unite": "TND/kg",
  "fourchette_min": 2.00,
  "fourchette_max": 3.00,
  "explication": "Tomates matures, couleur homogène, sans défauts visibles. Prix conforme au marché local de saison."
}
```

---

### Workflow Articles & Commandes

```
📦 Articles
├── Créer un article     → Saisir manuellement ou estimer le prix par image IA
├── Modifier             → Mettre à jour les informations
├── Supprimer            → Avec confirmation
└── Lister               → Vue tableau avec prix et disponibilité

🛒 Commandes
├── Créer une commande   → Sélection d'articles, quantité, total calculé
├── Gérer les tâches     → Todo list associée à chaque commande
├── Suivre le statut     → En attente / Confirmée / Livrée
└── Historique           → Consultation des commandes passées
```

---

## 🏗️ Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                      PRÉSENTATION                           │
│  ┌─────────────┐ ┌─────────────┐ ┌─────────────────────┐   │
│  │    Twig     │ │    CSS/JS   │ │    Controllers      │   │
│  │  (Templates)│ │  (Styles)   │ │   (Symfony)         │   │
│  └─────────────┘ └─────────────┘ └─────────────────────┘   │
├─────────────────────────────────────────────────────────────┤
│                      MÉTIER                                 │
│  ┌─────────────────────────────────────────────────────┐   │
│  │                    Services                          │   │
│  │  • ArticleService        • CommandeService          │   │
│  │  • TodoService           • PriceEstimatorService    │   │
│  │  • WeatherService        • IrrigationService        │   │
│  │  • RotationCultureService • AgriChatbotService      │   │
│  └─────────────────────────────────────────────────────┘   │
├─────────────────────────────────────────────────────────────┤
│                      DONNÉES                                │
│  ┌─────────────┐ ┌─────────────┐ ┌─────────────────────┐   │
│  │   Entities  │ │  Doctrine   │ │    APIs Externes    │   │
│  │  (POJOs)    │ │    ORM      │ │  Gemini Vision      │   │
│  └─────────────┘ └─────────────┘ └─────────────────────┘   │
└─────────────────────────────────────────────────────────────┘
```

### Design Patterns

| Pattern | Utilisation |
|---------|-------------|
| **MVC** | Séparation Templates / Controllers / Entities |
| **Service Layer** | Logique métier isolée et réutilisable |
| **Repository** | Accès données via Doctrine ORM |
| **Dependency Injection** | Services injectés via le container Symfony |

---

## 💻 Technologies

### Core

| Technologie | Version | Usage |
|-------------|---------|-------|
| PHP | 8.1+ | Langage principal |
| Symfony | 6.x | Framework MVC |
| Doctrine ORM | 2.x | Accès base de données |
| Twig | 3.x | Templates |
| MySQL | 8.0+ | Base de données |

### APIs & Libraries

| API / Library | Usage |
|---------------|-------|
| Google Gemini 2.5 Flash | Chatbot IA agricole |
| Google Gemini Vision | Estimation de prix par image |
| WeatherStack | Météo temps réel |
| Symfony HttpClient | Appels HTTP vers APIs externes |

---

## 📦 Installation

### Prérequis

```bash
# PHP 8.1+
php -v

# Composer
composer -V

# Symfony CLI (optionnel mais recommandé)
symfony check:requirements

# MySQL Server actif
```

### Étapes

```bash
# 1. Cloner le repository
git clone https://github.com/votre-username/FlahaSmart.git
cd FlahaSmart

# 2. Installer les dépendances PHP
composer install

# 3. Configurer l'environnement
cp .env .env.local
# Éditer .env.local avec vos paramètres

# 4. Créer la base de données
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

# 5. Lancer le serveur
symfony server:start
# ou
php -S localhost:8000 -t public/
```

---

## ⚙️ Configuration

### Base de données (`.env.local`)

```env
DATABASE_URL="mysql://user:password@127.0.0.1:3306/flahasmart"
```

### APIs

```env
WEATHERSTACK_API_KEY=your_weatherstack_key
GEMINI_API_KEY=your_google_gemini_key
```

| API | Variable | Documentation |
|-----|----------|---------------|
| WeatherStack | `WEATHERSTACK_API_KEY` | [weatherstack.com](https://weatherstack.com) |
| Google Gemini | `GEMINI_API_KEY` | [ai.google.dev](https://ai.google.dev) |

---

## 📁 Structure du projet

```
FlahaSmart/
├── src/
│   ├── Controller/
│   │   ├── DashboardController.php
│   │   ├── ArticleController.php
│   │   ├── CommandeController.php
│   │   ├── TodoController.php
│   │   ├── PriceEstimatorController.php
│   │   ├── WeatherController.php
│   │   ├── ChatbotController.php
│   │   ├── IrrigationController.php
│   │   ├── RotationController.php
│   │   ├── EquipementController.php
│   │   └── OperationController.php
│   ├── Entity/
│   │   ├── Article.php
│   │   ├── Commande.php
│   │   ├── TodoItem.php
│   │   ├── Equipement.php
│   │   ├── Operation.php
│   │   ├── Parcelle.php
│   │   └── IrrigationPlan.php
│   ├── Repository/
│   │   ├── ArticleRepository.php
│   │   ├── CommandeRepository.php
│   │   └── TodoItemRepository.php
│   └── Service/
│       ├── ArticleService.php
│       ├── CommandeService.php
│       ├── TodoService.php
│       ├── PriceEstimatorService.php   ← IA Vision
│       ├── WeatherService.php
│       ├── AgriChatbotService.php
│       ├── IrrigationService.php
│       └── RotationCultureService.php
├── templates/
│   ├── article/
│   ├── commande/
│   ├── todo/
│   ├── price_estimator/
│   ├── dashboard/
│   └── base.html.twig
├── public/
│   └── uploads/                         ← Images produits uploadées
├── migrations/
├── .env
├── .env.local
├── composer.json
└── README.md
```

---

## 🔌 APIs Intégrées

### WeatherStack API
```
Endpoint : http://api.weatherstack.com/current
Données  : Température, humidité, vent, conditions
Limite   : 100 requêtes/mois (gratuit)
```

### Google Gemini — Chatbot
```
Modèle   : gemini-2.5-flash
Usage    : Réponses agricoles en langage naturel
Endpoint : https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent
```

### Google Gemini Vision — Estimateur de Prix
```
Modèle   : gemini-2.5-flash (multimodal)
Usage    : Analyse d'image produit → estimation de prix
Input    : Image base64 (JPEG / PNG)
Output   : JSON structuré avec prix, qualité, explication
```

---

## 🔒 Sécurité & Bonnes pratiques

| Pratique | Implémentation |
|----------|----------------|
| SQL Injection | Doctrine ORM avec requêtes paramétrées |
| Validation | Symfony Validator + contraintes sur les entités |
| Upload sécurisé | Vérification MIME type des images uploadées |
| Variables sensibles | `.env.local` (non versionné) |
| Error Handling | Try-catch + logs Symfony Monolog |

---

## 📈 Améliorations futures

- [ ] 📱 Version mobile progressive (PWA)
- [ ] 📊 Export PDF des commandes et rapports
- [ ] 📅 Calendrier visuel des opérations et commandes
- [ ] 🔔 Notifications (email, push) sur statut commande
- [ ] 👥 Multi-utilisateurs avec rôles (Admin / Agriculteur / Client)
- [ ] 📈 Graphiques statistiques avancés (Chart.js)
- [ ] 🌐 Internationalisation (fr / ar / en)
- [ ] 🧾 Historique des estimations IA par produit
- [ ] 📷 Comparaison de prix multi-images

---

## 👨‍💻 Auteur

**[Votre Nom]**

| Contact | Lien |
|---------|------|
| 📧 Email | votre.email@esprit.tn |
| 🔗 GitHub | [@votre-username](https://github.com/votre-username) |
| 💼 LinkedIn | [Votre Profil](https://linkedin.com/in/votre-profil) |

---

## 📄 Licence

Ce projet est réalisé dans un cadre académique — **ESPRIT, 2025-2026**.

```
Libre d'utilisation avec attribution
```

---

<p align="center">
  <strong>Développé avec ❤️ et ☕</strong><br>
  <em>ESPRIT — Projet PIDEV 3A — 2025/2026</em>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Version-2.0-success?style=flat-square" alt="Version"/>
  <img src="https://img.shields.io/badge/Status-Stable-brightgreen?style=flat-square" alt="Status"/>
  <img src="https://img.shields.io/badge/Build-Passing-success?style=flat-square" alt="Build"/>
</p>
