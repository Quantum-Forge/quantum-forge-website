<?php

namespace App\Filament\Resources\Portfolios\Tables;

use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PortfoliosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('No')
                    ->sortable(),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('clients')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('kota')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date')
                    ->date('d/m/Y')
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Status')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_active'),
            ]);
    }
}
