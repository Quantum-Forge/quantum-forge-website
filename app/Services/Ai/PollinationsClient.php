<?php

namespace App\Services\Ai;

class PollinationsClient
{
    public function buildImageUrl(string $prompt): string
    {
        $baseUrl = (string) config('ai.pollinations.base_url');
        $baseUrl = rtrim($baseUrl, '/') . '/';
        return $baseUrl . urlencode($prompt);
    }
}

