<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\ArticleGeneration;
use App\Models\ArticleImage;
use App\Services\Ai\OpenRouterClient;
use App\Services\Ai\PollinationsClient;
use App\Services\Markdown\MarkdownRenderer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Throwable;

class GenerateArticleJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly int $articleId,
        public readonly int $generationId,
    ) {
    }

    public function handle(
        OpenRouterClient $openRouter,
        PollinationsClient $pollinations,
        MarkdownRenderer $markdownRenderer,
    ): void {
        try {
            /** @var Article $article */
            $article = Article::query()->findOrFail($this->articleId);

            /** @var ArticleGeneration $generation */
            $generation = ArticleGeneration::query()->whereKey($this->generationId)->where('article_id', $article->id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return;
        }

        DB::transaction(function () use ($article, $generation) {
            $article->forceFill([
                'status' => Article::STATUS_GENERATING,
                'failure_reason' => null,
            ])->save();

            $generation->forceFill([
                'status' => 'running',
                'error_message' => null,
            ])->save();
        });

        try {
            $result = $openRouter->generateArticle(
                topic: $article->topic,
                tone: $article->tone,
                keywords: $article->keywords ?? [],
                imagePrompt: $article->image_prompt,
            );

            $html = $markdownRenderer->toHtml($result['markdown']);
            $imageUrl = $pollinations->buildImageUrl($result['image_prompt']);

            DB::transaction(function () use ($article, $generation, $result, $html, $imageUrl) {
                $article->forceFill([
                    'title' => $result['title'],
                    'markdown' => $result['markdown'],
                    'html' => $html,
                    'meta_title' => $result['meta_title'],
                    'meta_description' => $result['meta_description'],
                    'image_prompt' => $result['image_prompt'],
                    'featured_image_url' => $imageUrl,
                    'status' => Article::STATUS_READY,
                    'generated_at' => now(),
                    'failure_reason' => null,
                ])->save();

                ArticleImage::query()->create([
                    'article_id' => $article->id,
                    'provider' => 'pollinations',
                    'prompt' => $result['image_prompt'],
                    'url' => $imageUrl,
                ]);

                $generation->forceFill([
                    'provider' => 'openrouter',
                    'model' => $result['model'],
                    'raw_response' => $result['raw_content'],
                    'token_usage' => $result['token_usage'],
                    'latency_ms' => $result['latency_ms'],
                    'status' => 'succeeded',
                ])->save();
            });
        } catch (Throwable $e) {
            DB::transaction(function () use ($article, $generation, $e) {
                $article->forceFill([
                    'status' => Article::STATUS_FAILED,
                    'failure_reason' => $e->getMessage(),
                ])->save();

                $generation->forceFill([
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                ])->save();
            });

            throw $e;
        }
    }
}

