<?php

namespace App\Console\Commands;

use App\Jobs\GenerateArticleJob;
use App\Models\Article;
use App\Models\ArticleGeneration;
use Illuminate\Console\Command;

class GenerateArticleCommand extends Command
{
    protected $signature = 'article:generate
        {topic : Topik/judul utama}
        {--tone= : Gaya bahasa (mis. Profesional)}
        {--keywords=* : Keyword SEO (boleh berulang)}
        {--image-prompt= : Prompt featured image (opsional)}';

    protected $description = 'Generate artikel menggunakan OpenRouter dan Pollinations (async via queue).';

    public function handle(): int
    {
        $topic = (string) $this->argument('topic');
        $tone = $this->option('tone') ? (string) $this->option('tone') : null;
        $keywords = array_values(array_filter((array) $this->option('keywords')));
        $imagePrompt = $this->option('image-prompt') ? (string) $this->option('image-prompt') : null;

        $article = Article::query()->create([
            'topic' => $topic,
            'title' => $topic,
            'tone' => $tone,
            'keywords' => $keywords,
            'image_prompt' => $imagePrompt,
            'status' => Article::STATUS_GENERATING,
        ]);

        $generation = ArticleGeneration::query()->create([
            'article_id' => $article->id,
            'provider' => 'openrouter',
            'model' => (string) config('ai.openrouter.model'),
            'input' => [
                'topic' => $topic,
                'tone' => $tone,
                'keywords' => $keywords,
                'image_prompt' => $imagePrompt,
            ],
            'status' => 'queued',
        ]);

        GenerateArticleJob::dispatch($article->id, $generation->id);

        $this->info('Queued generation: article_id=' . $article->id . ', generation_id=' . $generation->id);
        return self::SUCCESS;
    }
}

