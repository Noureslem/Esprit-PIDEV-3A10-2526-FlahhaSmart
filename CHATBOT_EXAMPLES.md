# Chatbot Gemini - Exemples d'Integration

## 1️⃣ Inclusion dans d'autres templates

Le chatbot est inclus automatiquement dans `base.html.twig`, donc disponible sur **toutes les pages**.

Si vous voulez l'inclure sélectivement :

### Inclure uniquement sur certaines pages

```twig
{# templates/dashboard/index.html.twig #}
{% extends 'base.html.twig' %}

{% block body %}
    <div class="dashboard">
        ...
    </div>
    
    {# Inclure le chatbot spécifiquement #}
    {% include 'components/chatbot.html.twig' %}
{% endblock %}
```

### Inclure avec variables personnalisées

Vous pouvez passer des variables au composant :

```twig
{% include 'components/chatbot.html.twig' with {
    'title': 'Assistant Culturo-Tech',
    'subtitle': 'Powered by AI'
} %}
```

**Note** : Le composant actuel n'accepte pas de variables dynamiques, mais vous pouvez les ajouter facilement.

## 2️⃣ Customisation du bouton flottant

### Modifier la position

Dans `templates/components/chatbot.html.twig`, style CSS :

```css
.chatbot-container {
    position: fixed;
    bottom: 20px;
    right: 20px;    /* Nouveau : left: 20px; pour gauche */
    z-index: 9999;
}
```

### Modifier la taille

```css
.chatbot-toggle {
    width: 56px;     /* Largeur du bouton */
    height: 56px;    /* Hauteur du bouton */
}

.chatbot-widget {
    width: 380px;    /* Largeur du widget */
    height: 600px;   /* Hauteur du widget */
}
```

### Modifier l'icône

Remplacer l'SVG dans le bouton toggle :

```twig
<svg class="chatbot-icon" viewBox="0 0 24 24" fill="currentColor">
    {# Votre SVG personnalisé #}
    <path d="..."></path>
</svg>
```

## 3️⃣ Intégration avancée avec Stimulus

### Accès programmatique

```javascript
// Obtenir reference au controller Stimulus
const controller = application.getControllerForElementAndIdentifier(element, 'chatbot');

// Ouvrir le widget
controller.toggleWidget();

// Fermer le widget
controller.closeWidget();

// Envoyer un message programmatiquement
controller.messageTarget.value = "Quelle est la meilleure période pour semer?";
controller.sendMessage();

// Accéder l'historique
console.log(controller.messages);

// Vider l'historique
controller.clearHistory();
```

### Écouter les événements

```javascript
// Event listener pour les messages envoyés
document.addEventListener('chatbot:message:sent', (event) => {
    console.log('Message envoyé:', event.detail.message);
});

// Event listener pour les réponses reçues
document.addEventListener('chatbot:response:received', (event) => {
    console.log('Réponse reçue:', event.detail.response);
});
```

**Note** : Les événements ne sont pas implémentés par défaut, mais vous pouvez les ajouter facilement au controller.

## 4️⃣ Intégration avec autres services Symfony

### Sauvegarder les conversations en BDD

Créer une entité `ChatMessage` :

```bash
php bin/console make:entity ChatMessage
```

Puis modifier `ChatbotController` :

```php
use App\Entity\ChatMessage;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/api/chatbot/ask', name: 'app_chatbot_ask', methods: ['POST'])]
public function ask(
    Request $request,
    GeminiChatService $chatService,
    EntityManagerInterface $em,
    LoggerInterface $logger
): JsonResponse {
    // ... validation ...
    
    $response = $chatService->ask($message);
    
    // Sauvegarder en BDD
    $chatMessage = new ChatMessage();
    $chatMessage->setUserMessage($message)
        ->setBotResponse($response)
        ->setUser($this->getUser())
        ->setCreatedAt(new \DateTime());
    
    $em->persist($chatMessage);
    $em->flush();
    
    return $this->json([
        'success' => true,
        'response' => $response,
    ]);
}
```

### Ajouter l'authentification

```php
#[Route('/api/chatbot/ask', name: 'app_chatbot_ask', methods: ['POST'])]
#[IsGranted('ROLE_USER')]  // Requiert l'authentification
public function ask(
    Request $request,
    GeminiChatService $chatService,
    LoggerInterface $logger
): JsonResponse {
    // ... le reste du code ...
}
```

### Implémenter un rate limiter

Utiliser le bundle `RateLimiter` de Symfony :

```php
use Symfony\Component\RateLimiter\RateLimiterFactory;

public function ask(
    Request $request,
    GeminiChatService $chatService,
    RateLimiterFactory $chatbotLimiter,
): JsonResponse {
    // Limiter à 10 requêtes par minute par utilisateur
    $limiter = $chatbotLimiter->create($this->getUser()?->getId() ?? $request->getClientIp());
    
    if (!$limiter->consume(1)->isAccepted()) {
        return $this->json([
            'success' => false,
            'error' => 'Too many requests. Try again in a moment.',
        ], Response::HTTP_TOO_MANY_REQUESTS);
    }
    
    // ... suite du code ...
}
```

## 5️⃣ Support d'autres langues

### Configurer les traductions Symfony

```yaml
# translations/messages.fr.yaml
chatbot:
  title: 'Assistant Agricole'
  placeholder: 'Posez votre question...'
  welcome: 'Bonjour! Je suis votre assistant agricole...'
  error: 'Une erreur est survenue. Veuillez réessayer.'

# translations/messages.en.yaml
chatbot:
  title: 'Agricultural Assistant'
  placeholder: 'Ask your question...'
  welcome: 'Hello! I am your agricultural assistant...'
  error: 'An error occurred. Please try again.'

# translations/messages.ar.yaml
chatbot:
  title: 'مساعد زراعي'
  placeholder: 'اطرح سؤالك...'
  welcome: 'مرحباً! أنا مساعدك الزراعي...'
  error: 'حدث خطأ. حاول مجدداً.'
```

Modifier `templates/components/chatbot.html.twig` pour utiliser les traductions :

```twig
<p class="chatbot-subtitle">{{ 'chatbot.subtitle'|trans }}</p>
<input placeholder="{{ 'chatbot.placeholder'|trans }}" />
```

## 6️⃣ Intégration avec Azure Translator

```javascript
// assets/controllers/chatbot_controller.js
// Ajouter une traduction du message avant envoi

async sendMessage(event) {
    const message = this.messageTarget.value.trim();
    
    // Optionnel : traduire avant envoi
    const translatedMessage = await this.translateIfNeeded(message);
    
    // Envoyer le message traduit
    const response = await fetch(this.endpointValue, {
        method: 'POST',
        body: JSON.stringify({ message: translatedMessage }),
    });
}

async translateIfNeeded(text) {
    // Implémenter selon vos besoins
    // Utiliser le service Azure Translator existant
    return text;
}
```

## 7️⃣ Streaming de réponses (optionnel)

Pour obtenir les réponses en streaming :

### Côté Symfony

```php
#[Route('/api/chatbot/ask-stream', name: 'app_chatbot_ask_stream', methods: ['POST'])]
public function askStream(
    Request $request,
    GeminiChatService $chatService,
): StreamedResponse {
    $data = json_decode($request->getContent(), true);
    $message = $data['message'] ?? '';
    
    $response = new StreamedResponse(function() use ($chatService, $message) {
        // Implémenter le streaming avec Event Stream (SSE)
        // Voir documentation Google Gemini pour streaming
        echo "data: {partial response}\n\n";
        flush();
    });
    
    $response->headers->set('Content-Type', 'text/event-stream');
    return $response;
}
```

### Côté JavaScript

```javascript
async sendMessage() {
    const message = this.messageTarget.value;
    
    const response = await fetch(this.endpointValue.replace('/ask', '/ask-stream'), {
        method: 'POST',
        body: JSON.stringify({ message }),
    });
    
    const reader = response.body.getReader();
    while (true) {
        const { done, value } = await reader.read();
        if (done) break;
        
        const text = new TextDecoder().decode(value);
        // Afficher le texte au fur et à mesure
        this.streamText += text;
        this.renderMessages();
    }
}
```

## 8️⃣ Analyse et Monitoring

### Tracker l'utilisation

Créer un service `ChatbotAnalyticsService` :

```php
<?php
namespace App\Service;

use Psr\Log\LoggerInterface;

final class ChatbotAnalyticsService {
    public function __construct(private readonly LoggerInterface $logger) {}
    
    public function trackAsk(string $message, string $response, float $responseTime): void {
        $this->logger->info('Chatbot usage', [
            'messageLength' => strlen($message),
            'responseLength' => strlen($response),
            'responseTime' => $responseTime . 'ms',
        ]);
    }
}
```

### Mesurer le temps de réponse

```php
// Dans ChatbotController
$startTime = microtime(true);
$response = $chatService->ask($message);
$responseTime = (microtime(true) - $startTime) * 1000; // ms

$analytics->trackAsk($message, $response, $responseTime);
```

## 9️⃣ Intégration de Webhooks

Notifier les administrateurs de certains messages :

```php
#[Route('/api/chatbot/ask', name: 'app_chatbot_ask', methods: ['POST'])]
public function ask(
    // ...
    WebhookService $webhookService,
): JsonResponse {
    // ...
    
    // Notifier si demande spéciale
    if (strpos(strtolower($message), 'bug') !== false) {
        $webhookService->notify('chatbot', [
            'type' => 'potential_issue',
            'message' => $message,
            'user' => $this->getUser()?->getEmail(),
        ]);
    }
    
    return $this->json([...]);
}
```

## 🔟 Dark Mode Support

Ajouter le support du dark mode :

```css
@media (prefers-color-scheme: dark) {
    :root {
        --chatbot-primary: #10b981;
        --chatbot-user-bg: #1a3a2c;
        --chatbot-bot-bg: #1f2937;
        --chatbot-border: #374151;
    }
    
    .message-bot .message-bubble {
        background: #374151;
        color: #e5e7eb;
    }
    
    .chatbot-input {
        background: #1f2937;
        color: white;
        border-color: #374151;
    }
}
```

---

**Tous ces exemples sont optionnels et peuvent être implémentés selon vos besoins.**

Pour plus d'aide, consulter `CHATBOT_SETUP.md`.
