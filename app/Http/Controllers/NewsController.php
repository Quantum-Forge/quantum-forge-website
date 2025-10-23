<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query    = trim($request->input('q', 'technology OR software OR programming'));
        $page     = max(1, (int) $request->input('page', 1));
        $pageSize = 5; // keep consistent with legacy pagination

        [$news, $error] = $this->fetchNews($query, $page, $pageSize);
        $totalPages = (int) ceil(($news['totalResults'] ?? 0) / $pageSize);

        return view('news', [
            'news' => $news,
            'query' => $query,
            'page' => $page,
            'pageSize' => $pageSize,
            'totalPages' => $totalPages,
            'error' => $error,
        ]);
    }

    public function apiIndex(Request $request): Response
    {
        $validated = $request->validate([
            'q' => ['nullable', 'string', 'max:200'],
            'page' => ['nullable', 'integer', 'min:1'],
        ]);

        $query = trim($validated['q'] ?? 'technology OR software OR programming');
        $page = max(1, (int) ($validated['page'] ?? 1));
        $pageSize = 5;

        [$news, $error] = $this->fetchNews($query, $page, $pageSize);
        $status = $error ? 502 : 200;

        return response()->json([
            'query' => $query,
            'page' => $page,
            'pageSize' => $pageSize,
            'totalPages' => (int) ceil(($news['totalResults'] ?? 0) / $pageSize),
            'articles' => $news['articles'] ?? [],
            'totalResults' => $news['totalResults'] ?? 0,
            'error' => $error,
        ], $status);
    }

    private function fetchNews(string $query, int $page, int $pageSize): array
    {
        $baseUrl = config('app.news_api_url', env('NEWS_API_URL'));
        $apiKey  = env('NEWS_API_KEY');

        $news = [
            'articles' => [],
            'totalResults' => 0,
        ];

        if (!$baseUrl || !$apiKey) {
            return [$news, 'News API is not configured'];
        }

        try {
            $response = Http::timeout(10)->get($baseUrl, [
                'q' => $query,
                'pageSize' => $pageSize,
                'page' => $page,
                'sortBy' => 'publishedAt',
                // 'language' => 'id',
                'apiKey' => $apiKey,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $news['articles'] = $data['articles'] ?? [];
                $news['totalResults'] = (int) ($data['totalResults'] ?? 0);
                return [$news, null];
            }

            Log::warning('News API non-success response', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return [$news, 'Failed to fetch news'];
        } catch (\Throwable $e) {
            Log::error('News API error: '.$e->getMessage());
            return [$news, 'Error fetching news'];
        }
    }
}
