# AI Conflict Resolution - Setup Instructions

## ✅ What's Been Upgraded

**Before:** Mock AI responses only  
**After:** Real Gemini AI integration with intelligent fallback

## 🔧 Setup (2 minutes)

### 1. Get a Gemini API Key (FREE)
1. Go to https://makersuite.google.com/app/apikey
2. Click "Create API Key"
3. Copy the key

### 2. Add to `.env`
```env
GEMINI_API_KEY=your_api_key_here
```

### 3. Test It
Visit `/conflict-chat` and send a message. You'll get real AI-powered conflict mediation advice!

## 🤖 How It Works

**The AI Prompt:**
```
You are Aura, an AI relationship mediator. Analyze this conflict conversation 
and provide ONE brief, empathetic suggestion (max 2 sentences) to help 
de-escalate and improve communication.

Focus on:
- Using "I" statements instead of "you" accusations
- Acknowledging feelings
- Finding common ground
- De-escalation techniques
```

**Example AI Responses:**
- "I notice you're both feeling hurt. Try expressing what you need rather than what your partner did wrong."
- "It sounds like there's a misunderstanding. Can you each share what you heard the other person say?"
- "Take a moment to breathe. Remember, you're partners working together, not opponents."

## 🛡️ Fallback System

If Gemini API fails (no key, timeout, error), it automatically falls back to 4 pre-written mock responses.

**No crashes, always works!**

## 📊 Features

- ✅ Real-time AI analysis of conflict conversations
- ✅ Context-aware mediation advice
- ✅ Empathetic, de-escalation focused
- ✅ Automatic fallback to mock responses
- ✅ Error logging for debugging
- ✅ 10-second timeout protection

## 🎯 Integration

Already integrated into Zarif's `ConflictChat` component. No changes needed!

Just add the API key and it works.
