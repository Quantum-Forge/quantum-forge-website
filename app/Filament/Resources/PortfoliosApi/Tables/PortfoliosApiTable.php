<?php

namespace App\Filament\Resources\PortfoliosApi\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PortfoliosApiTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('api_key')
                    ->label('API Key')
                    ->copyable()
                    ->toggleable(),
                TextColumn::make('api_key_created_at')
                    ->label('Created')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('selected_portfolio_ids')
                    ->label('Selected Portfolios')
                    ->formatStateUsing(fn ($state) => is_array($state) ? count($state) : 0)
                    ->sortable(),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }
}
