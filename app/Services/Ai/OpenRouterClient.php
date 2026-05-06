<?php

namespace App\Services\Ai;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class OpenRouterClient
{
    /**
     * @return array{title:string,markdown:string,meta_title:string,meta_description:string,image_prompt:string,raw_content:string,token_usage:array|null,latency_ms:int|null,model:string}
     */
    public function generateArticle(
        string $topic,
        ?string $tone = null,
        array $keywords = [],
        ?string $imagePrompt = null,
    ): array {
        $apiKey = config('ai.openrouter.api_key');
        $baseUrl = rtrim((string) config('ai.openrouter.base_url'), '/');
        $model = (string) config('ai.openrouter.model');
        $timeoutSeconds = (int) config('ai.openrouter.timeout_seconds', 60);

        if (blank($apiKey)) {
            throw new RuntimeException('OPENROUTER_API_KEY belum dikonfigurasi.');
        }
        if (blank($model)) {
            throw new RuntimeException('OPENROUTER_MODEL belum dikonfigurasi.');
        }

        $brief = [
            'topic' => $topic,
            'tone' => $tone,
            'keywords' => array_values(array_filter($keywords, fn ($k) => filled($k))),
            'image_prompt' => $imagePrompt,
        ];

        $system = <<<'PROMPT'
Kamu adalah Chief Technology Officer (CTO) dan pakar Digital Marketing di sebuah Software House ternama. Tugasmu adalah menulis artikel blog yang mendalam, edukatif, dan persuasif. Gunakan bahasa Indonesia yang profesional namun hangat. Pastikan setiap artikel menonjolkan keunggulan solusi custom software (khususnya menggunakan Laravel) dan fokus pada ROI (Return on Investment) bagi klien.

Anda selalu menjawab dengan JSON valid saja (tanpa markdown code block, tanpa teks tambahan). Pastikan JSON memiliki tepat key berikut: title, markdown, meta_title, meta_description, image_prompt.

Aturan:
- markdown harus berisi artikel lengkap dengan struktur heading (H2/H3), paragraf, dan bullet points bila relevan.
- meta_title maksimal 60 karakter, meta_description maksimal 160 karakter.
- image_prompt adalah prompt singkat untuk ilustrasi featured image bertema teknologi (3D render/tech illustration), aman untuk publik.
PROMPT;

        $user = "Buat artikel berdasarkan brief berikut:\n" . json_encode($brief, JSON_UNESCAPED_UNICODE);
        
        $requestPayload = [
            'model' => $model,
            'messages' => [
                ['role' => 'system', 'content' => $system],
                ['role' => 'user', 'content' => $user],
            ],
        ];

        try {
            $startedAt = hrtime(true);
            $response = Http::withToken($apiKey)
                ->acceptJson()
                ->timeout($timeoutSeconds)
                ->post($baseUrl . '/chat/completions', $requestPayload);
        } catch (ConnectionException $e) {
            throw new RuntimeException('Koneksi ke OpenRouter gagal: ' . $e->getMessage(), previous: $e);
        }

        $latencyMs = isset($startedAt) ? (int) round((hrtime(true) - $startedAt) / 1_000_000) : null;

        if (! $response->successful()) {
            $errorDetail = $response->body();
            throw new RuntimeException("OpenRouter error: HTTP {$response->status()} - {$errorDetail} | Payload: " . json_encode($requestPayload));
        }

        $content = (string) $response->json('choices.0.message.content');
        if (blank($content)) {
            throw new RuntimeException('OpenRouter mengembalikan content kosong.');
        }

        $data = $this->decodeJsonFromText($content);

        $title = trim((string) Arr::get($data, 'title', ''));
        $markdown = (string) Arr::get($data, 'markdown', '');
        $metaTitle = trim((string) Arr::get($data, 'meta_title', ''));
        $metaDescription = trim((string) Arr::get($data, 'meta_description', ''));
        $finalImagePrompt = trim((string) Arr::get($data, 'image_prompt', ''));

        if (blank($title) || blank($markdown) || blank($metaTitle) || blank($metaDescription) || blank($finalImagePrompt)) {
            throw new RuntimeException('Format output OpenRouter tidak sesuai kontrak JSON.');
        }

        return [
            'title' => $title,
            'markdown' => $markdown,
            'meta_title' => $metaTitle,
            'meta_description' => $metaDescription,
            'image_prompt' => $finalImagePrompt,
            'raw_content' => $content,
            'token_usage' => $response->json('usage'),
            'latency_ms' => $latencyMs,
            'model' => $model,
        ];
    }

    /**
     * @return array{topic:string,keywords:array<string>,image_prompt:string}
     */
    public function generateIdea(): array
    {
        $apiKey = config('ai.openrouter.api_key');
        $baseUrl = rtrim((string) config('ai.openrouter.base_url'), '/');
        $model = (string) config('ai.openrouter.model');
        $timeoutSeconds = 30; // Timeout lebih cepat untuk generate idea

        if (blank($apiKey)) {
            throw new RuntimeException('OPENROUTER_API_KEY belum dikonfigurasi.');
        }
        if (blank($model)) {
            throw new RuntimeException('OPENROUTER_MODEL belum dikonfigurasi.');
        }

        $system = <<<'PROMPT'
Kamu adalah Chief Technology Officer (CTO) dan pakar Digital Marketing di sebuah Software House ternama.
Tugasmu adalah memberikan ide topik artikel blog yang mendalam, edukatif, dan persuasif. Fokus pada menonjolkan keunggulan solusi custom software (khususnya menggunakan Laravel) dan fokus pada ROI (Return on Investment) bagi klien.
Kembalikan HANYA JSON valid dengan format:
{
  "topic": "Judul/Topik Artikel",
  "keywords": ["keyword1", "keyword2", "keyword3"],
  "image_prompt": "Prompt bahasa inggris untuk generate gambar ilustrasi 3D/Tech"
}
PROMPT;

        $user = "Berikan 1 ide artikel blog terbaru yang sangat menarik untuk target klien kita.";

        $requestPayload = [
            'model' => $model,
            'messages' => [
                ['role' => 'system', 'content' => $system],
                ['role' => 'user', 'content' => $user],
            ],
        ];

        try {
            $response = Http::withToken($apiKey)
                ->acceptJson()
                ->timeout($timeoutSeconds)
                ->post($baseUrl . '/chat/completions', $requestPayload);
        } catch (ConnectionException $e) {
            throw new RuntimeException('Koneksi ke OpenRouter gagal: ' . $e->getMessage(), previous: $e);
        }

        if (! $response->successful()) {
            $errorDetail = $response->body();
            throw new RuntimeException("OpenRouter error: HTTP {$response->status()} - {$errorDetail} | Payload: " . json_encode($requestPayload));
        }

        $content = (string) $response->json('choices.0.message.content');
        if (blank($content)) {
            throw new RuntimeException('OpenRouter mengembalikan content kosong.');
        }

        $data = $this->decodeJsonFromText($content);

        return [
            'topic' => trim((string) Arr::get($data, 'topic', '')),
            'keywords' => (array) Arr::get($data, 'keywords', []),
            'image_prompt' => trim((string) Arr::get($data, 'image_prompt', '')),
        ];
    }

    /**
     * @return array<string,mixed>
     */
    private function decodeJsonFromText(string $text): array
    {
        $trimmed = trim($text);
        $decoded = json_decode($trimmed, true);
        if (is_array($decoded)) {
            return $decoded;
        }

        $first = strpos($trimmed, '{');
        $last = strrpos($trimmed, '}');
        if ($first === false || $last === false || $last <= $first) {
            throw new RuntimeException('Output OpenRouter bukan JSON valid.');
        }

        $candidate = substr($trimmed, $first, $last - $first + 1);
        $decoded = json_decode($candidate, true);
        if (! is_array($decoded)) {
            throw new RuntimeException('Output OpenRouter bukan JSON valid.');
        }

        return $decoded;
    }
}
