<?php

namespace Tests\Unit;

use App\Services\Ai\OpenRouterClient;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class OpenRouterClientTest extends TestCase
{
    public function test_generate_article_parses_json_response(): void
    {
        Config::set('ai.openrouter.api_key', 'test-key');
        Config::set('ai.openrouter.model', 'test-model');
        Config::set('ai.openrouter.base_url', 'https://openrouter.ai/api/v1');
        Config::set('ai.openrouter.timeout_seconds', 5);

        Http::fake([
            'https://openrouter.ai/api/v1/chat/completions' => Http::response([
                'choices' => [
                    ['message' => ['content' => json_encode([
                        'title' => 'Judul',
                        'markdown' => "## Heading\n\nKonten.",
                        'meta_title' => 'Meta Title',
                        'meta_description' => 'Meta Description',
                        'image_prompt' => 'futuristic ai background, 3d render',
                    ], JSON_UNESCAPED_UNICODE)]],
                ],
                'usage' => ['prompt_tokens' => 10, 'completion_tokens' => 20],
            ]),
        ]);

        $client = new OpenRouterClient();
        $result = $client->generateArticle('Topik', 'Profesional', ['ai', 'startup'], null);

        $this->assertSame('Judul', $result['title']);
        $this->assertStringContainsString('## Heading', $result['markdown']);
        $this->assertSame('Meta Title', $result['meta_title']);
        $this->assertSame('Meta Description', $result['meta_description']);
        $this->assertSame('futuristic ai background, 3d render', $result['image_prompt']);
        $this->assertIsArray($result['token_usage']);
        $this->assertSame('test-model', $result['model']);
        $this->assertNotEmpty($result['raw_content']);
    }

    public function test_generate_article_can_extract_json_from_wrapped_text(): void
    {
        Config::set('ai.openrouter.api_key', 'test-key');
        Config::set('ai.openrouter.model', 'test-model');
        Config::set('ai.openrouter.base_url', 'https://openrouter.ai/api/v1');
        Config::set('ai.openrouter.timeout_seconds', 5);

        $payload = [
            'title' => 'Judul',
            'markdown' => "## Heading\n\nKonten.",
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'image_prompt' => 'prompt',
        ];

        Http::fake([
            'https://openrouter.ai/api/v1/chat/completions' => Http::response([
                'choices' => [
                    ['message' => ['content' => "Berikut JSON:\n" . json_encode($payload, JSON_UNESCAPED_UNICODE) . "\nTerima kasih"]],
                ],
            ]),
        ]);

        $client = new OpenRouterClient();
        $result = $client->generateArticle('Topik');

        $this->assertSame('Judul', $result['title']);
        $this->assertSame('prompt', $result['image_prompt']);
    }
}

