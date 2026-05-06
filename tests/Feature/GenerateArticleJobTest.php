<?php

namespace Tests\Feature;

use App\Jobs\GenerateArticleJob;
use App\Models\Article;
use App\Models\ArticleGeneration;
use App\Services\Ai\OpenRouterClient;
use App\Services\Ai\PollinationsClient;
use App\Services\Markdown\MarkdownRenderer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GenerateArticleJobTest extends TestCase
{
    use RefreshDatabase;

    public function test_job_generates_article_and_updates_status(): void
    {
        Config::set('ai.openrouter.api_key', 'test-key');
        Config::set('ai.openrouter.model', 'test-model');
        Config::set('ai.openrouter.base_url', 'https://openrouter.ai/api/v1');
        Config::set('ai.pollinations.base_url', 'https://image.pollinations.ai/prompt/');

        $payload = [
            'title' => 'Judul Generated',
            'markdown' => "## Heading\n\nKonten.",
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'image_prompt' => 'futuristic ai background',
        ];

        Http::fake([
            'https://openrouter.ai/api/v1/chat/completions' => Http::response([
                'choices' => [
                    ['message' => ['content' => json_encode($payload, JSON_UNESCAPED_UNICODE)]],
                ],
                'usage' => ['prompt_tokens' => 1, 'completion_tokens' => 2],
            ]),
        ]);

        $article = Article::query()->create([
            'topic' => 'Topik',
            'title' => 'Topik',
            'tone' => 'Profesional',
            'keywords' => ['ai'],
            'status' => Article::STATUS_GENERATING,
        ]);

        $generation = ArticleGeneration::query()->create([
            'article_id' => $article->id,
            'provider' => 'openrouter',
            'model' => 'test-model',
            'input' => ['topic' => 'Topik'],
            'status' => 'queued',
        ]);

        $job = new GenerateArticleJob($article->id, $generation->id);
        $job->handle(app(OpenRouterClient::class), app(PollinationsClient::class), app(MarkdownRenderer::class));

        $article->refresh();
        $generation->refresh();

        $this->assertSame(Article::STATUS_READY, $article->status);
        $this->assertSame('Judul Generated', $article->title);
        $this->assertNotEmpty($article->html);
        $this->assertStringContainsString('pollinations.ai/prompt/', $article->featured_image_url);

        $this->assertSame('succeeded', $generation->status);
        $this->assertNotEmpty($generation->raw_response);
        $this->assertIsArray($generation->token_usage);
    }
}

