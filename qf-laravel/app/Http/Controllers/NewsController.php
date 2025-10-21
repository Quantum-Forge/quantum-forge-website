<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $baseUrl = config('app.news_api_url', env('NEWS_API_URL'));
        $apiKey  = env('NEWS_API_KEY');

        $query    = trim($request->input('q', 'technology OR software OR programming'));
        $page     = max(1, (int) $request->input('page', 1));
        $pageSize = 5; // keep consistent with legacy pagination

        $news = [
            'articles' => [],
            'totalResults' => 0,
        ];

        if ($baseUrl && $apiKey) {
            try {
                $response = Http::get($baseUrl, [
                    'q' => $query,
                    'pageSize' => $pageSize,
                    'page' => $page,
                    'sortBy' => 'publishedAt',
                    // 'language' => 'id', // uncomment if you want Indonesian articles only
                    'apiKey' => $apiKey,
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $news['articles'] = $data['articles'] ?? [];
                    $news['totalResults'] = (int) ($data['totalResults'] ?? 0);
                }
            } catch (\Throwable $e) {
                // Log or ignore; keep view resilient
                // logger()->error('News API error: '.$e->getMessage());
            }
        }

        $totalPages = (int) ceil(($news['totalResults'] ?? 0) / $pageSize);

        return view('news', [
            'news' => $news,
            'query' => $query,
            'page' => $page,
            'pageSize' => $pageSize,
            'totalPages' => $totalPages,
        ]);
    }
}