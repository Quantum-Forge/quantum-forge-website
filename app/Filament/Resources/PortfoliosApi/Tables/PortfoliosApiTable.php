<?php

namespace App\Filament\Resources\PortfoliosApi\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\EditAction;

class PortfoliosApiTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('User')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('api_key')
                    ->label('API Key')
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->actions([
                EditAction::make(),
            ]);
    }
}
