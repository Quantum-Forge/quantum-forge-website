<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TagsInput::make('tags')
                    ->separator(',')
                    ->placeholder('Tambah tag baru (tekan enter)'),
                RichEditor::make('content')
                    ->default(null)
                    ->columnSpanFull(),
                \Filament\Schemas\Components\Section::make('Thumbnail')
                    ->components([
                        FileUpload::make('image_url')
                            ->label('Thumbnail Image')
                            ->hiddenLabel()
                            ->image()
                            ->disk('public')
                            ->directory('images')
                            ->columnSpanFull(),
                    ])->columnSpanFull(),
                DateTimePicker::make('published_at')
                    ->columnSpanFull(),
            ]);
    }
}
