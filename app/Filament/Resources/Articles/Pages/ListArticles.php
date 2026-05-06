<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use App\Jobs\GenerateArticleJob;
use App\Models\Article;
use App\Models\ArticleGeneration;
use App\Services\Ai\OpenRouterClient;
use App\Services\Ai\PollinationsClient;
use Filament\Actions\Action;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\HtmlString;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('newArticle')
                ->label('New article')
                ->modalHeading('Generate Ide Artikel')
                ->modalDescription('Review ide artikel dari AI, pilih tone, lalu lanjutkan generate konten lengkap.')
                ->modalSubmitActionLabel('Generate Artikel Lengkap')
                ->form([
                    TextInput::make('topic')
                        ->label('Topik Artikel')
                        ->required(),
                    TagsInput::make('keywords')
                        ->label('Keywords SEO')
                        ->required(),
                    Textarea::make('image_prompt')
                        ->label('Prompt Gambar')
                        ->required(),
                    Placeholder::make('photo_preview')
                        ->label('Preview Gambar (Pollinations)')
                        ->content(function ($get) {
                            $prompt = $get('image_prompt');
                            if (! $prompt) return null;
                            $url = app(PollinationsClient::class)->buildImageUrl($prompt);
                            return new HtmlString('<img src="' . $url . '" style="max-height: 200px; border-radius: 8px; margin-top: 0.5rem;" />');
                        }),
                    Select::make('tone')
                        ->label('Tone Artikel')
                        ->options([
                            'profesional' => 'Profesional (Sopan & Bisnis)',
                            'casual' => 'Casual (Santai & Ramah)',
                            'teknis' => 'Teknis (Mendalam & Spesifik)',
                            'marketing' => 'Marketing (Persuasif & Sales)',
                        ])
                        ->required()
                        ->default('profesional'),
                ])
                ->mountUsing(function (\Filament\Schemas\Schema $form) {
                    $idea = app(OpenRouterClient::class)->generateIdea();
                    $form->fill([
                        'topic' => $idea['topic'] ?? '',
                        'keywords' => $idea['keywords'] ?? [],
                        'image_prompt' => $idea['image_prompt'] ?? '',
                        'tone' => 'profesional',
                    ]);
                })
                ->action(function (array $data) {
                    $article = Article::create([
                        'topic' => $data['topic'],
                        'title' => $data['topic'],
                        'keywords' => $data['keywords'],
                        'image_prompt' => $data['image_prompt'],
                        'tone' => $data['tone'],
                        'author_user_id' => auth()->id(),
                        'status' => Article::STATUS_GENERATING,
                    ]);

                    $generation = ArticleGeneration::create([
                        'article_id' => $article->id,
                        'provider' => 'openrouter',
                        'model' => (string) config('ai.openrouter.model'),
                        'input' => [
                            'topic' => $data['topic'],
                            'tone' => $data['tone'],
                            'keywords' => $data['keywords'],
                            'image_prompt' => $data['image_prompt'],
                        ],
                        'status' => 'queued',
                    ]);

                    GenerateArticleJob::dispatch($article->id, $generation->id);

                    $this->redirect(ArticleResource::getUrl('edit', ['record' => $article]));
                }),
        ];
    }
}


