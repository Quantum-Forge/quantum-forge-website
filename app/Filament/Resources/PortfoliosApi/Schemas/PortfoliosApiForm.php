<?php

namespace App\Filament\Resources\PortfoliosApi\Schemas;

use App\Models\Portfolio;
use Filament\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

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
                                    ->readOnly()
                                    ->suffixActions([
                                        Action::make('generate')
                                            ->label('Generate')
                                            ->icon('heroicon-m-key')
                                            ->action(function (Set $set) {
                                                $key = (string) Str::uuid();
                                                $set('api_key', $key);
                                                $set('api_key_created_at', now());
                                            }),
                                        Action::make('copyApiKey')
                                            ->label('Copy')
                                            ->icon('heroicon-m-clipboard')
                                            ->color('gray')
                                            ->action(function ($livewire, $state) {
                                                $js = 'window.navigator.clipboard.writeText(' . json_encode($state) . '); $tooltip("' . __('Copied to clipboard') . '", { timeout: 1500 });';
                                                $livewire->js($js);
                                            }),
                                    ])
                                    ->columnSpan(['md' => 6]),
                                Hidden::make('api_key_created_at'),
                                Placeholder::make('endpoint')
                                    ->label('Endpoint URL')
                                    ->content(fn () => url('/api/portfolios'))
                                    ->columnSpan(['md' => 6]),
                                // Placeholder::make('auth_header')
                                //     ->label('Auth Header')
                                //     ->content('X-API-Key')
                                //     ->columnSpan(['md' => 6]),
                                Placeholder::make('usage')
                                    ->label('Usage')
                                    ->content(fn ($record) => "curl -H 'X-API-Key: " . ($record->api_key ?? '{YOUR_KEY}') . "' '" . url('/api/portfolios') . "'")
                                    ->columnSpan(['md' => 6]),
                                Placeholder::make('usage_query')
                                    ->label('Usage (Query)')
                                    ->content(fn ($record) => url('/api/portfolios') . '?api_key=' . ($record->api_key ?? '{YOUR_KEY}'))
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
                            // ->hint(fn (Get $get) => empty($get('selected_portfolio_ids')) ? 'Belum ada portfolio yang dipilih' : null)
                            ->helperText(fn () => Portfolio::query()->exists() ? null : 'Belum Ada Portfolio')
                            ->disabled(fn () => ! Portfolio::query()->exists()),
                    ]),
            ]);
    }
}
