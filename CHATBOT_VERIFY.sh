#!/usr/bin/env bash
# Installation Verification Checklist

echo "🔍 Gemini Chatbot Installation Verification"
echo "=========================================="
echo ""

ERRORS=0

# Check .env configuration
echo "1️⃣  Checking .env configuration..."
if grep -q "GEMINI_API_KEY" .env; then
    echo "   ✅ .env has GEMINI_API_KEY"
else
    echo "   ❌ Missing GEMINI_API_KEY in .env"
    ERRORS=$((ERRORS + 1))
fi

if grep -q "GEMINI_API_ENDPOINT" .env; then
    echo "   ✅ .env has GEMINI_API_ENDPOINT"
else
    echo "   ❌ Missing GEMINI_API_ENDPOINT in .env"
    ERRORS=$((ERRORS + 1))
fi

# Check .env.local
echo ""
echo "2️⃣  Checking .env.local configuration..."
if [ -f .env.local ]; then
    if grep -q "GEMINI_API_KEY=" .env.local; then
        echo "   ✅ .env.local has GEMINI_API_KEY"
        if grep -q 'GEMINI_API_KEY=""' .env.local; then
            echo "   ⚠️  GEMINI_API_KEY is empty in .env.local!"
            ERRORS=$((ERRORS + 1))
        fi
    else
        echo "   ℹ️  .env.local exists but missing GEMINI_API_KEY (add it manually)"
    fi
else
    echo "   ℹ️  .env.local doesn't exist yet (will be created)"
fi

# Check PHP files
echo ""
echo "3️⃣  Checking PHP files..."
if [ -f "src/Service/GeminiChatService.php" ]; then
    echo "   ✅ GeminiChatService.php exists"
else
    echo "   ❌ GeminiChatService.php not found"
    ERRORS=$((ERRORS + 1))
fi

if [ -f "src/Controller/ChatbotController.php" ]; then
    echo "   ✅ ChatbotController.php exists"
else
    echo "   ❌ ChatbotController.php not found"
    ERRORS=$((ERRORS + 1))
fi

# Check JS files
echo ""
echo "4️⃣  Checking JavaScript files..."
if [ -f "assets/controllers/chatbot_controller.js" ]; then
    echo "   ✅ chatbot_controller.js exists"
else
    echo "   ❌ chatbot_controller.js not found"
    ERRORS=$((ERRORS + 1))
fi

# Check Twig files
echo ""
echo "5️⃣  Checking Twig files..."
if [ -f "templates/components/chatbot.html.twig" ]; then
    echo "   ✅ chatbot.html.twig exists"
else
    echo "   ❌ chatbot.html.twig not found"
    ERRORS=$((ERRORS + 1))
fi

if grep -q "{% include 'components/chatbot.html.twig' %}" "templates/base.html.twig"; then
    echo "   ✅ Chatbot included in base.html.twig"
else
    echo "   ❌ Chatbot not included in base.html.twig"
    ERRORS=$((ERRORS + 1))
fi

# Check services.yaml
echo ""
echo "6️⃣  Checking services.yaml configuration..."
if grep -q "geminiApiKey" config/services.yaml; then
    echo "   ✅ services.yaml has Gemini bindings"
else
    echo "   ❌ Gemini bindings missing in services.yaml"
    ERRORS=$((ERRORS + 1))
fi

# Check documentation
echo ""
echo "7️⃣  Checking documentation..."
if [ -f "CHATBOT_SETUP.md" ]; then
    echo "   ✅ CHATBOT_SETUP.md exists"
else
    echo "   ℹ️  CHATBOT_SETUP.md not found"
fi

if [ -f "CHATBOT_EXAMPLES.md" ]; then
    echo "   ✅ CHATBOT_EXAMPLES.md exists"
else
    echo "   ℹ️  CHATBOT_EXAMPLES.md not found"
fi

# Summary
echo ""
echo "=========================================="
if [ $ERRORS -eq 0 ]; then
    echo "✅ All checks passed!"
    echo ""
    echo "Next steps:"
    echo "1. Set GEMINI_API_KEY in .env.local"
    echo "2. Run: symfony console cache:clear"
    echo "3. Test: curl -X GET http://localhost:8000/api/chatbot/health"
    echo "4. Open http://localhost:8000 and check for chatbot"
else
    echo "❌ $ERRORS error(s) found. Please fix them above."
    exit 1
fi
