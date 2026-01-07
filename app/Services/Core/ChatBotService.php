<?php

namespace App\Services\Core;

use App\Models\BotPersona;
use App\Models\ChatMessage;
use App\Models\Faq;
use Illuminate\Support\Str;

class ChatBotService extends BaseService
{
    public function respond(string $sessionId, string $message): ?ChatMessage
    {
        // 1. Save User Message
        ChatMessage::create([
            'session_id' => $sessionId,
            'role' => 'user',
            'content' => $message,
        ]);

        // 2. Get Persona
        $persona = BotPersona::getActive();
        if (!$persona) {
            return $this->reply($sessionId, "I am offline right now. Creating a persona in the admin panel might wake me up.", null);
        }

        // 3. Generate Response (Mock Driver)
        $response = $this->generateMockResponse($message, $persona);

        // 4. Save Assistant Message
        return $this->reply($sessionId, $response, $persona->id);
    }

    protected function reply($sessionId, $content, $personaId)
    {
        return ChatMessage::create([
            'session_id' => $sessionId,
            'role' => 'assistant',
            'content' => $content,
            'persona_id' => $personaId,
        ]);
    }

    protected function generateMockResponse($input, $persona)
    {
        $input = Str::lower($input);

        // A. Check FAQs (Smart Knowledge)
        $faq = Faq::where('question', 'like', "%{$input}%")->where('is_active', true)->first();
        if ($faq) {
            return "Found this in my knowledge base: " . $faq->answer;
        }

        // B. Keyword Triggers
        if (Str::contains($input, ['pricing', 'cost', 'money'])) {
            return "Our pricing is transparent. Check out the [Pricing Page](/pricing).";
        }

        if (Str::contains($input, ['help', 'support'])) {
            return "You can open a support ticket [here](/tickets).";
        }

        // C. Default Fallback (Persona Flavored)
        // Here we simulate the persona's "voice" simply by using the system prompt as a guide (conceptually)
        // In a real LLM integration, we'd send the system_prompt + history.
        return "I heard you say '{$input}'. " . $persona->system_prompt . " (This is a mock response)";
    }
}
