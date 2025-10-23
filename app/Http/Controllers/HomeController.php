<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $newsApiUrl = env('NEWS_API_URL');
        $newsApiKey = env('NEWS_API_KEY');
        $query = $request->query('search', 'UMKM Indonesia');
        $page = (int) $request->query('page', 1);
        $pageSize = 5;

        $newsData = null;

        if ($newsApiUrl && $newsApiKey) {
            try {
                $response = Http::withHeaders([
                    'User-Agent' => 'Laravel-Http'
                ])->get($newsApiUrl, [
                    'q' => $query,
                    'apiKey' => $newsApiKey,
                    'page' => $page,
                    'pageSize' => $pageSize,
                ]);

                if ($response->ok()) {
                    $newsData = $response->json();
                }
            } catch (\Throwable $e) {
                $newsData = null;
            }
        }

        return view('home', compact('newsData'));
    }
}
