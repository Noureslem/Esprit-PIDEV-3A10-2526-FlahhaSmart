# Intégration Chatbot Gemini - Guide Complet

## 📋 Vue d'ensemble

Intégration d'un chatbot intelligent alimenté par **Google Gemini 2.5 Flash** dans votre application Symfony. Le chatbot est spécialisé dans les questions agricoles et utilise une architecture propre séparant les responsabilités.

## 🎯 Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                    Frontend (Stimulus)                      │
│  templates/components/chatbot.html.twig                    │
│  assets/controllers/chatbot_controller.js                  │
└────────────────────────┬────────────────────────────────────┘
                         │ fetch POST /api/chatbot/ask
                         ▼
┌─────────────────────────────────────────────────────────────┐
│                 API Controller (Symfony)                    │
│  src/Controller/ChatbotController.php                      │
│  - Route: POST /api/chatbot/ask                            │
│  - Validation input                                        │
│  - Gestion erreurs                                         │
└────────────────────────┬────────────────────────────────────┘
                         │ appel service
                         ▼
┌─────────────────────────────────────────────────────────────┐
│                Application Service Layer                    │
│  src/Service/GeminiChatService.php                         │
│  - HttpClientInterface                                     │
│  - LoggerInterface                                         │
│  - Gestion timeout/erreurs API                             │
│  - System prompt agriculture                               │
└────────────────────────┬────────────────────────────────────┘
                         │ requête HTTP
                         ▼
┌─────────────────────────────────────────────────────────────┐
│              Google Gemini API (Cloud)                      │
│  https://generativelanguage.googleapis.com/v1beta/models.. │
└─────────────────────────────────────────────────────────────┘
```

## 📦 Fichiers créés

### Backend
- **`src/Service/GeminiChatService.php`** - Service principal
  - `ask(string $message): string` - Méthode publique
  - Gestion des erreurs/timeouts
  - System prompt agriculture configurable
  - DI: HttpClientInterface, LoggerInterface

- **`src/Controller/ChatbotController.php`** - Endpoint API
  - `POST /api/chatbot/ask` - Endpoint principal
  - `GET /api/chatbot/health` - Health check
  - Validation et sanitisation input
  - Réponse JSON structurée

### Frontend
- **`assets/controllers/chatbot_controller.js`** - Stimulus Controller
  - Gestion UI widget
  - Envoi messages fetch
  - Historique localStorage
  - Animations fluides
  - Support multilingue

- **`templates/components/chatbot.html.twig`** - Template UI
  - Design moderne moderne avec TailwindCSS-style CSS
  - Bouton flottant animated
  - Messages style ChatGPT/WhatsApp
  - Responsive mobile
  - Support RTL (arabe)
  - Styles CSS complètement intégrés

### Configuration
- **`.env`** - Variables d'environnement
- **`config/services.yaml`** - Binding DI
- **`templates/base.html.twig`** - Inclusion du composant (modifié)

## 🚀 Installation et Setup

### Étape 1 : Configuration `.env.local`

**IMPORTANT** : Ajoutez la clé API dans `.env.local` (jamais dans `.env`) :

```bash
# .env.local
GEMINI_API_KEY="AIzaSyBUNkR3-qmg4o77qB6j-RliYsMBsvyOtoQ"
```

### Étape 2 : Vérifier la configuration

Les variables suivantes sont disponibles (déjà configurées dans `.env`) :

```yaml
# .env
GEMINI_API_ENDPOINT=https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent
GEMINI_MODEL_NAME=gemini-2.5-flash
GEMINI_API_TIMEOUT=30000  # millisecondes
GEMINI_CHATBOT_ENABLED=true
```

### Étape 3 : Vérifier les bindings services.yaml

Les bindings sont déjà configurés dans `config/services.yaml` :

```yaml
bind:
    # Gemini API Configuration
    string $geminiApiEndpoint: '%env(string:GEMINI_API_ENDPOINT)%'
    string $geminiModelName: '%env(string:GEMINI_MODEL_NAME)%'
    string $geminiApiKey: '%env(string:GEMINI_API_KEY)%'
    int $geminiApiTimeout: '%env(int:GEMINI_API_TIMEOUT)%'
    bool $geminiChatbotEnabled: '%env(bool:GEMINI_CHATBOT_ENABLED)%'
```

### Étape 4 : Vérifier l'inclusion dans base.html.twig

Le chatbot est déjà inclus dans `templates/base.html.twig` :

```twig
<!-- Chatbot Widget -->
{% include 'components/chatbot.html.twig' %}
```

## 🧪 Tests

### Test du Health Check

```bash
curl -X GET http://localhost:8000/api/chatbot/health
```

Réponse attendue :
```json
{"status":"ok","service":"gemini-chatbot"}
```

### Test de l'Endpoint

```bash
curl -X POST http://localhost:8000/api/chatbot/ask \
  -H "Content-Type: application/json" \
  -d '{"message":"Comment irriguer mes cultures en été?"}' \
  -H "X-CSRF-TOKEN: your_token_here"
```

Réponse attendue :
```json
{
  "success": true,
  "response": "Pour l'irrigation estivale...",
  "timestamp": "2026-03-24 14:30:45"
}
```

### Test dans Postman/Insomnia

1. Créer une requête POST sur `http://localhost:8000/api/chatbot/ask`
2. Headers:
   - `Content-Type: application/json`
   - `X-CSRF-TOKEN: (récupérer depuis une page de l'app)`
3. Body (raw JSON):
   ```json
   {
     "message": "Comment traiter les ravageurs des cultures?"
   }
   ```

## 🎨 Customization

### Modifier le System Prompt

Éditer `src/Service/GeminiChatService.php`, constante `SYSTEM_PROMPT` :

```php
private const SYSTEM_PROMPT = <<<'PROMPT'
You are an expert agricultural assistant...
PROMPT;
```

### Modifier les Couleurs du Widget

Éditer `templates/components/chatbot.html.twig`, section CSS variables :

```css
:root {
    --chatbot-primary: #10b981;      /* Couleur principale */
    --chatbot-primary-dark: #059669; /* Couleur au survol */
    --chatbot-secondary: #064e3b;
    --chatbot-user-bg: #e8f5e9;      /* Couleur messages utilisateur */
    --chatbot-bot-bg: #f0f9ff;       /* Couleur messages bot */
}
```

### Modifier le Timeout API

Éditer `.env` :

```env
GEMINI_API_TIMEOUT=60000  # 60 secondes
```

### Modifier la Langue du Welcome Message

Éditer `assets/controllers/chatbot_controller.js`, méthode `getInitialMessages()` :

```javascript
getInitialMessages() {
  return [
    {
      type: 'bot',
      content: 'Bonjour! 👋 Je suis votre assistant agricole...',
      timestamp: new Date().toISOString(),
    },
  ];
}
```

## 🔒 Sécurité

### Points d'attention

1. **Validation input** ✅
   - Taille max 2000 caractères
   - Validation côté contrôleur et service
   - Échappement HTML côté JS

2. **Gestion clé API** ✅
   - Storing en `.env.local` (non commité)
   - Jamais dans le code

3. **CSRF Protection** ✅
   - Token CSRF obligatoire via `data-chatbot-csrf-token-value`
   - Vérifié par Symfony

4. **Logging** ✅
   - Erreurs loggées via PSR-3 LoggerInterface
   - Vérifier dans `var/log/dev.log`

### Recommandations additionnelles

- Implémenter **rate limiting** (par utilisateur/IP)
- Ajouter **authentification** si besoin
- Utiliser **HTTPS en production**
- Monitorer **quota API Gemini**
- Ajouter **sanitization** complémentaire si utile

## 🌍 Support Multilingue

Le chatbot supporte automatiquement :
- ✅ français (code utilisateur: `fr`)
- ✅ anglais (code utilisateur: `en`)
- ✅ arabe (code utilisateur: `ar` + RTL)

L'IA répondra dans la langue de la question détectée.

### Adapter le message de bienvenue

La message initiale peut être contextualisée par locale. Éditer dans le Stimulus controller ou la template.

## 📊 Logging et Monitoring

### Log Location

```
var/log/dev.log  (dev)
var/log/prod.log (prod)
```

### Événements loggés

- ✅ Requêtes API réussies (debug)
- ⚠️ Erreurs API (error)
- ⚠️ Timeouts (error)
- ℹ️ Chatbot désactivé (warning)

### Vérifier les logs

```bash
# Suivi en temps réel
tail -f var/log/dev.log | grep -i chatbot

# Chercher les erreurs
grep -i "error" var/log/dev.log | grep chatbot
```

## 🔧 Dépannage

### ❌ Le chatbot n'apparaît pas

**Vérification :**
1. Vérifier que `GEMINI_CHATBOT_ENABLED=true` dans `.env`
2. Vérifier l'inclusion dans `base.html.twig`
3. Vérifier la console navigateur (F12) pour les erreurs JS
4. Clear le cache : `symfony console cache:clear`

### ❌ Le bouton flottant s'affiche mais le widget ne s'ouvre pas

**Vérification :**
1. Vérifier que Stimulus est chargé
2. Vérifier la console du navigateur pour les erreurs JS
3. Vérifier que `data-controller="chatbot"` est présent
4. Vérifier les targets Stimulus : `data-chatbot-target="widget"`

### ❌ Les messages n'arrivent pas

**Vérification :**
1. Vérifier que `GEMINI_API_KEY` est configurée en `.env.local`
2. Tester l'endpoint API directement :
   ```bash
   curl -X GET http://localhost:8000/api/chatbot/health
   ```
3. Vérifier les logs : `var/log/dev.log`
4. Vérifier le token CSRF (voir F12 Network)
5. Vérifier la limite de quota Google Gemini

### ❌ Erreur 400 "Message is too long"

Message limité à 2000 caractères. À augmenter dans :
- `src/Service/GeminiChatService.php` (ligne `if (strlen($message) > 2000)`)
- `src/Controller/ChatbotController.php` (même vérification)
- `assets/controllers/chatbot_controller.js` (validation UI)

### ❌ Erreur 500 API Gemini

Vérifier :
1. La clé API est valide
2. Le quota API n'est pas dépassé
3. Le modèle `gemini-2.5-flash` est disponible
4. La connexion internet est stable

## 📝 Paramètres API Gemini

Configuration par défaut dans `GeminiChatService.php` :

```php
'generationConfig' => [
    'temperature' => 0.7,      // Créativité (0-1)
    'topP' => 0.95,            // Diversité
    'topK' => 64,              // Candidats
    'maxOutputTokens' => 1024, // Longueur réponse max
]
```

Modifier pour ajuster le comportement de l'IA.

## 🚀 Optimisations Possibles

1. **Streaming** - Implémenter Server-Sent Events (SSE) pour les réponses en streaming
2. **Caching** - Mettre en cache les réponses fréquentes
3. **Historique DB** - Sauvegarder les conversations en BDD
4. **Analytics** - Tracker l'utilisation
5. **Rate Limiting** - Limiter les requêtes par utilisateur
6. **Multi-agent** - Ajouter d'autres assistants spécialisés

## 📚 Ressources

- [Google Gemini API Docs](https://ai.google.dev/api)
- [Symfony HTTP Client](https://symfony.com/doc/current/http_client.html)
- [Stimulus Documentation](https://stimulus.hotwired.dev/)
- [Symfony Logging](https://symfony.com/doc/current/logging.html)

## ✅ Checklist Déploiement

Avant production :
- [ ] Clé API en `.env.local` (jamais en `.env`)
- [ ] Tests de charge API
- [ ] Monitoring logs configuré
- [ ] HTTPS activé
- [ ] Rate limiting implémenté
- [ ] Backup logging
- [ ] Documentation équipe mise à jour
- [ ] Tests end-to-end validés

## 📞 Support

En cas de problème, vérifier :
1. Les logs : `var/log/dev.log`
2. La console navigateur (F12)
3. L'onglet Network (requêtes API)
4. La configuration `.env.local`
5. La validité de la clé API Gemini

---

**Créé le** : 24 Mar 2026  
**Version Symfony** : Recente (7.x)  
**Version Gemini API** : v1beta  
**Status** : ✅ Production-Ready
