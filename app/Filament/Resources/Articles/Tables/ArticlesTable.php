<?php

namespace App\Filament\Resources\Articles\Tables;

use App\Models\Article;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('No')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        Article::STATUS_PUBLISHED => 'success',
                        Article::STATUS_READY => 'info',
                        Article::STATUS_GENERATING => 'warning',
                        Article::STATUS_FAILED => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('generated_at')
                    ->label('Generated')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->actions([
                Action::make('publish')
                    ->label('Publish')
                    ->icon('heroicon-m-megaphone')
                    ->visible(fn (Article $record) => in_array($record->status, [Article::STATUS_READY, Article::STATUS_DRAFT, Article::STATUS_FAILED], true))
                    ->action(function (Article $record) {
                        $record->forceFill([
                            'status' => Article::STATUS_PUBLISHED,
                            'published_at' => $record->published_at ?? now(),
                        ])->save();
                    }),
                Action::make('unpublish')
                    ->label('Unpublish')
                    ->color('gray')
                    ->icon('heroicon-m-eye-slash')
                    ->visible(fn (Article $record) => $record->status === Article::STATUS_PUBLISHED)
                    ->action(function (Article $record) {
                        $record->forceFill([
                            'status' => Article::STATUS_READY,
                            'published_at' => null,
                        ])->save();
                    }),
                ViewAction::make(),
                EditAction::make(),
            ]);
    }
}
