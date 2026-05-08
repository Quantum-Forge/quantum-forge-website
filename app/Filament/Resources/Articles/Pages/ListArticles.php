<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use Filament\Actions\CreateAction;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms\Components\TextInput;
use App\Services\AiService;
use App\Models\Article;
use App\Models\Category;
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
                    \Filament\Forms\Components\Select::make('category_id')
                        ->label('Kategori')
                        ->options(Category::pluck('name', 'id'))
                        ->required()
                        ->searchable(),
                ])
                ->action(function (array $data) {
                    set_time_limit(300);

                    $aiService = new AiService();

                    // Generate prompt untuk Cover (Thumbnail) dan Content Image (Gambar Tengah)
                    $coverPrompt = $aiService->generateImagePrompt($data['topic'], 'main');
                    $coverImageUrl = $aiService->generateImage($coverPrompt);

                    // Generate Content and pass the generated image url for the middle-image
                    $content = $aiService->generateArticle($data['topic']);

                    // Save to database
                    Article::create([
                        'title' => $data['topic'],
                        'slug' => Str::slug($data['topic'] . '-' . uniqid()),
                        'category_id' => $data['category_id'],
                        'content' => $content,
                        'image_url' => $coverImageUrl,
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
