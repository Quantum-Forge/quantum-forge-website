<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use App\Models\Category;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->limit(80),
                TextColumn::make('portfolios_count')
                    ->label('Jumlah Portfolio')
                    ->state(fn (Category $record) => $record->portfolios()->count())
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Aktif')
                    ->sortable(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
                    ->label('Delete')
                    ->requiresConfirmation()
                    ->disabled(fn (Category $record) => $record->portfolios()->exists())
                    ->tooltip('Tidak bisa dihapus jika ada portfolio terkait'),
            ])
            
            ->filters([
                TernaryFilter::make('is_active'),
            ]);
    }
}