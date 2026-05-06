<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use App\Jobs\GenerateArticleJob;
use App\Models\Article;
use App\Models\ArticleGeneration;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('generate')
                ->label('Generate')
                ->icon('heroicon-m-sparkles')
                ->action(function () {
                    /** @var Article $article */
                    $article = $this->record;

                    $article->forceFill([
                        'status' => Article::STATUS_GENERATING,
                        'failure_reason' => null,
                    ])->save();

                    $generation = ArticleGeneration::query()->create([
                        'article_id' => $article->id,
                        'provider' => 'openrouter',
                        'model' => (string) config('ai.openrouter.model'),
                        'input' => [
                            'topic' => $article->topic,
                            'tone' => $article->tone,
                            'keywords' => $article->keywords ?? [],
                            'image_prompt' => $article->image_prompt,
                        ],
                        'status' => 'queued',
                    ]);

                    GenerateArticleJob::dispatch($article->id, $generation->id);
                }),
            DeleteAction::make(),
        ];
    }
}

