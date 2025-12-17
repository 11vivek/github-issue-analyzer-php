<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GitHubService
{
    public function fetchIssues(string $repo): array
    {
        $response = Http::withHeaders([
            'User-Agent' => 'Laravel-Issue-Analyzer'
        ])->get("https://api.github.com/repos/{$repo}/issues", [
            'state' => 'open',
            'per_page' => 100
        ]);

        return $response->json();
    }
}
