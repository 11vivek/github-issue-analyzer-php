<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class LLMService
{
    public function analyze(string $prompt, string $issues): string
    {
        $response = Http::withToken(env('OPENAI_API_KEY'))
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    ['role' => 'system', 'content' => 'You analyze GitHub issues.'],
                    ['role' => 'user', 'content' => $prompt . "\n\nIssues:\n" . $issues]
                ]
            ]);

        return $response->json('choices.0.message.content') ?? 'LLM error';
    }
}
