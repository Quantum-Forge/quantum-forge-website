<?php

namespace App\Filament\Resources\ArticleGenerations\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArticleGenerationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('No')
                    ->sortable(),
                TextColumn::make('article.title')
                    ->label('Artikel')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->sortable(),
                TextColumn::make('provider')
                    ->sortable(),
                TextColumn::make('model')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('latency_ms')
                    ->label('Latency (ms)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('error_message')
                    ->label('Error')
                    ->wrap()
                    ->limit(80)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('id', 'desc');
    }
}

