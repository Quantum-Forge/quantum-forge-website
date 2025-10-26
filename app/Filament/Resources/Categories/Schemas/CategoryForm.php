<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->gap('md')
            ->components([
                Section::make('Kategori')
                    ->columnSpan(['md' => 12])
                    ->components([
                        Grid::make(['md' => 12])
                            ->components([
                                TextInput::make('name')
                                    ->label('Nama')
                                    ->required()
                                    ->maxLength(100)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Set $set, ?string $state) {
                                        $set('slug', Str::slug($state ?? ''));
                                    })
                                    ->columnSpan(['md' => 6]),
                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->hidden()
                                    ->dehydrateStateUsing(fn ($state, $get) => Str::slug($get('name') ?? '')),
                                Textarea::make('description')
                                    ->label('Deskripsi')
                                    ->rows(4)
                                    ->columnSpan(['md' => 12]),
                                Toggle::make('is_active')
                                    ->label('Aktif')
                                    ->default(true)
                                    ->columnSpan(['md' => 12]),
                            ]),
                    ]),
            ]);
    }
}