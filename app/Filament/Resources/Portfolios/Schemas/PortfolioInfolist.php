<?php

namespace App\Filament\Resources\Portfolios\Schemas;

use Filament\Infolists\Components\ViewEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PortfolioInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Portfolio')
                    ->description('Ringkasan portfolio ditampilkan sebagai kartu yang rapi dan responsif.')
                    ->columnSpanFull()
                    ->components([
                        Grid::make(12)
                            ->extraAttributes(['class' => 'gap-6'])
                            ->components([
                                ViewEntry::make('portfolio_card_main')
                                    ->view('filament.infolists.portfolio-card-main')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 6,
                                        'lg' => 4,
                                    ]),
                                ViewEntry::make('portfolio_card_media')
                                    ->view('filament.infolists.portfolio-card-media')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 6,
                                        'lg' => 4,
                                    ]),
                                ViewEntry::make('portfolio_card_marketing')
                                    ->view('filament.infolists.portfolio-card-marketing')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 6,
                                        'lg' => 4,
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
