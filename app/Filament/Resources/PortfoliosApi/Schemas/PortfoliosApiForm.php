<?php

namespace App\Filament\Resources\PortfoliosApi\Schemas;

use App\Models\Portfolio;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PortfoliosApiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('API Settings')
                    ->columnSpanFull()
                    ->components([
                        Grid::make(12)
                            ->components([
                                TextInput::make('api_key')
                                    ->label('API Key')
                                    ->disabled()
                                    ->columnSpan(['md' => 6]),
                                Placeholder::make('endpoint')
                                    ->label('Endpoint URL')
                                    ->content(fn () => url('/api/portfolios'))
                                    ->columnSpan(['md' => 6]),
                                Placeholder::make('auth_header')
                                    ->label('Auth Header')
                                    ->content('X-API-Key')
                                    ->columnSpan(['md' => 6]),
                                Placeholder::make('usage')
                                    ->label('Usage')
                                    ->content(fn ($record) => "curl -H 'X-API-Key: " . ($record->api_key ?? '{YOUR_KEY}') . "' '" . url('/api/portfolios') . "'")
                                    ->columnSpan(['md' => 6]),
                            ]),
                ]),
                Section::make('Select Portfolios')
                    ->description('Only selected portfolios will be returned by the API.')
                    ->columnSpanFull()
                    ->components([
                        CheckboxList::make('selected_portfolio_ids')
                            ->label('Portfolios')
                            ->options(fn () => Portfolio::query()
                                ->orderByDesc('date')
                                ->orderByDesc('id')
                                ->pluck('title', 'id')
                                ->toArray())
                            ->columns(2)
                            ->gridDirection('row')
                            ->live()
                            ->helperText(fn () => Portfolio::query()->exists() ? null : 'Belum Ada Portfolio')
                            ->disabled(fn () => ! Portfolio::query()->exists()),
                    ]),
            ]);
    }
}
