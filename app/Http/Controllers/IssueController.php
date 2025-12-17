<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Services\GitHubService;
use App\Services\LLMService;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function scan(Request $request, GitHubService $github)
    {
        $request->validate([
            'repo' => 'required|string'
        ]);

        $issues = $github->fetchIssues($request->repo);
        $count = 0;

        foreach ($issues as $issue) {
            if (!isset($issue['id'])) continue;

            Issue::updateOrCreate(
                ['github_id' => $issue['id']],
                [
                    'repo' => $request->repo,
                    'title' => $issue['title'],
                    'body' => $issue['body'] ?? '',
                    'html_url' => $issue['html_url'],
                    'created_at_github' => $issue['created_at']
                ]
            );
            $count++;
        }

        return response()->json([
            'repo' => $request->repo,
            'issues_fetched' => $count,
            'cached_successfully' => true
        ]);
    }

    public function analyze(Request $request, LLMService $llm)
    {
        $request->validate([
            'repo' => 'required|string',
            'prompt' => 'required|string'
        ]);

        $issues = Issue::where('repo', $request->repo)->get();

        if ($issues->isEmpty()) {
            return response()->json(['error' => 'No cached issues found'], 404);
        }

        $text = $issues->map(fn($i) =>
            "- {$i->title}: {$i->body}"
        )->implode("\n");

        return response()->json([
            'analysis' => $llm->analyze($request->prompt, $text)
        ]);
    }
}