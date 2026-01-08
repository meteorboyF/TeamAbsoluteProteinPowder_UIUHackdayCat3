<?php

namespace App\Services\Features;

class AuraService
{
    /**
     * Analyze the conflict conversation and return advice.
     *
     * @param array $messages
     * @return string
     */
    public function analyzeConflict(array $messages): string
    {
        // Mocking the AI analysis
        // In the future, this would connect to an LLM
        return "It seems like things are getting heated. Remember to use 'I' statements and focus on how you feel rather than blaming the other person.";
    }
}
