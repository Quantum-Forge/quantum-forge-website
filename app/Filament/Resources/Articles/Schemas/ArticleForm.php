<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Article;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->gap('md')
            ->components([
                Section::make('Input')
                    ->columnSpan(['md' => 12])
                    ->components([
                        Grid::make(['md' => 12])
                            ->components([
                                TextInput::make('topic')
                                    ->label('Topic / Title')
                                    ->required()
                                    ->maxLength(150)
                                    ->columnSpan(['md' => 12]),
                                TextInput::make('tone')
                                    ->label('Tone')
                                    ->placeholder('Profesional / Inovatif / Bisnis-sentris')
                                    ->maxLength(100)
                                    ->columnSpan(['md' => 6]),
                                TagsInput::make('keywords')
                                    ->label('Keywords')
                                    ->placeholder('Tambahkan keyword')
                                    ->columnSpan(['md' => 6]),
                                Textarea::make('image_prompt')
                                    ->label('Image Prompt (Opsional)')
                                    ->rows(3)
                                    ->columnSpan(['md' => 12]),
                            ]),
                    ]),

                Section::make('Output')
                    ->columnSpan(['md' => 12])
                    ->collapsed(fn (?Article $record) => $record === null)
                    ->components([
                        Grid::make(['md' => 12])
                            ->components([
                                Placeholder::make('status')
                                    ->label('Status')
                                    ->content(fn (?Article $record) => $record?->status)
                                    ->columnSpan(['md' => 6]),
                                Placeholder::make('generated_at')
                                    ->label('Generated')
                                    ->content(fn (?Article $record) => $record?->generated_at?->toDateTimeString())
                                    ->columnSpan(['md' => 6]),
                                TextInput::make('meta_title')
                                    ->label('Meta Title')
                                    ->maxLength(255)
                                    ->columnSpan(['md' => 12]),
                                Textarea::make('meta_description')
                                    ->label('Meta Description')
                                    ->rows(3)
                                    ->columnSpan(['md' => 12]),
                                Textarea::make('featured_image_url')
                                    ->label('Featured Image URL')
                                    ->rows(2)
                                    ->columnSpan(['md' => 12]),
                            ]),
                        Textarea::make('markdown')
                            ->label('Markdown')
                            ->rows(12)
                            ->columnSpanFull(),
                        Textarea::make('html')
                            ->label('HTML')
                            ->rows(12)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
