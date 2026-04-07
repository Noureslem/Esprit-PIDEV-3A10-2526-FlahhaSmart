#!/usr/bin/env bash
# Quick Setup Script for Gemini Chatbot

echo "🚀 Gemini Chatbot Setup - Quick Start"
echo "======================================"
echo ""

# Colors
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${YELLOW}Step 1: Configure .env.local${NC}"
echo "
Create/Edit .env.local and add:

GEMINI_API_KEY=\"AIzaSyBUNkR3-qmg4o77qB6j-RliYsMBsvyOtoQ\"

Path: .env.local
"

echo -e "${YELLOW}Step 2: Clear Cache${NC}"
echo "
Run: symfony console cache:clear
"

echo -e "${YELLOW}Step 3: Test Health Check${NC}"
echo "
Run: curl -X GET http://localhost:8000/api/chatbot/health

Expected Response:
{\"status\":\"ok\",\"service\":\"gemini-chatbot\"}
"

echo -e "${YELLOW}Step 4: Test Chatbot${NC}"
echo "
Open your browser at: http://localhost:8000

You should see a green floating button (💬) in the bottom right corner.
Click it to open the chatbot!
"

echo -e "${GREEN}✅ Setup Complete!${NC}"
echo ""
echo "📚 Documentation:"
echo "  - Main Setup Guide: CHATBOT_SETUP.md"
echo "  - Examples & Integration: CHATBOT_EXAMPLES.md"
echo ""
echo "⚠️  Important: Store API key in .env.local ONLY"
echo "   Never commit .env.local to version control"
