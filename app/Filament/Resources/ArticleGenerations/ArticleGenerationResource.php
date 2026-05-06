<?php

namespace App\Filament\Resources\ArticleGenerations;

use App\Filament\Resources\ArticleGenerations\Pages\ListArticleGenerations;
use App\Filament\Resources\ArticleGenerations\Tables\ArticleGenerationsTable;
use App\Models\ArticleGeneration;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ArticleGenerationResource extends Resource
{
    protected static ?string $model = ArticleGeneration::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCpuChip;

    protected static UnitEnum|string|null $navigationGroup = 'Content';

    protected static ?int $navigationSort = 3;

    public static function table(Table $table): Table
    {
        return ArticleGenerationsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArticleGenerations::route('/'),
        ];
    }
}

