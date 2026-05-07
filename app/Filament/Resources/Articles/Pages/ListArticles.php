<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use Filament\Actions\CreateAction;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Components\TextInput;
use App\Services\AiService;
use App\Models\Article;
use Illuminate\Support\Str;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('generate_ai')
                ->label('Generate AI Article')
                ->icon('heroicon-o-sparkles')
                ->color('success')
                ->form([
                    TextInput::make('topic')
                        ->label('Topik Artikel')
                        ->required()
                        ->placeholder('Contoh: Perkembangan AI di Indonesia'),
                ])
                ->action(function (array $data) {
                    $aiService = new AiService();
                    
                    // Generate Content
                    $content = $aiService->generateArticle($data['topic']);
                    
                    // Generate Image
                    $imageUrl = $aiService->generateImage("Realistic cinematic photo of " . $data['topic']);
                    
                    // Save to database
                    Article::create([
                        'title' => $data['topic'],
                        'slug' => Str::slug($data['topic'] . '-' . uniqid()),
                        'category' => 'AI Generated',
                        'content' => $content,
                        'image_url' => $imageUrl,
                        'published_at' => now(),
                    ]);
                    
                    \Filament\Notifications\Notification::make()
                        ->title('Artikel berhasil digenerate!')
                        ->success()
                        ->send();
                }),
            CreateAction::make(),
        ];
    }
}
