<?php

namespace App\Filament\Resources\Portfolios\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PortfolioInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('date')
                    ->date(),
                TextEntry::make('clients'),
                TextEntry::make('category'),
                TextEntry::make('kota'),
                TextEntry::make('description_proyek')
                    ->columnSpanFull(),
                TextEntry::make('link')
                    ->placeholder('-'),
                TextEntry::make('images1')
                    ->placeholder('-'),
                TextEntry::make('heading'),
                TextEntry::make('description2')
                    ->columnSpanFull(),
                TextEntry::make('images2')
                    ->placeholder('-'),
                TextEntry::make('images3')
                    ->placeholder('-'),
                TextEntry::make('images4')
                    ->placeholder('-'),
                IconEntry::make('is_active')
                    ->boolean(),
                // Removed IconEntry for 'is_featured'
                TextEntry::make('slug'),
                TextEntry::make('tags')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('updated_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
