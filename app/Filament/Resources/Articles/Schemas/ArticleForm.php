<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
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
                RichEditor::make('content')
                    ->default(null)
                    ->columnSpanFull(),
                FileUpload::make('image_url')
                    ->label('Thumbnail Image')
                    ->image()
                    ->disk('public')
                    ->directory('images'),
                DateTimePicker::make('published_at'),
            ]);
    }
}
