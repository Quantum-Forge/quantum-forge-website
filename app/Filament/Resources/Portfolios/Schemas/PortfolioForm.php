<?php

namespace App\Filament\Resources\Portfolios\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;
use Filament\Schemas\Schema;

class PortfolioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        $set('slug', Str::slug($state ?? ''));
                    }),
                DatePicker::make('date')
                    ->required(),
                TextInput::make('clients')
                    ->required(),
                TextInput::make('category')
                    ->required(),
                TextInput::make('kota')
                    ->required(),
                Textarea::make('description_proyek')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('link')
                    ->default(null),
                TextInput::make('heading')
                    ->required(),
                Textarea::make('description2')
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('slug')
                    ->required()
                    ->hidden()
                    ->unique(ignoreRecord: true)
                    ->dehydrateStateUsing(fn ($state, $get) => Str::slug($get('title') ?? '')),
                FileUpload::make('images1')
                    ->image()
                    ->acceptedFileTypes(['image/*'])
                    ->disk('public')
                    ->directory('portfolios')
                    ->previewable(true)
                    ->downloadable()
                    ->default(null),
                FileUpload::make('images2')
                    ->image()
                    ->acceptedFileTypes(['image/*'])
                    ->disk('public')
                    ->directory('portfolios')
                    ->previewable(true)
                    ->downloadable()
                    ->default(null),
                FileUpload::make('images3')
                    ->image()
                    ->acceptedFileTypes(['image/*'])
                    ->disk('public')
                    ->directory('portfolios')
                    ->previewable(true)
                    ->downloadable()
                    ->default(null),
                FileUpload::make('images4')
                    ->image()
                    ->acceptedFileTypes(['image/*'])
                    ->disk('public')
                    ->directory('portfolios')
                    ->previewable(true)
                    ->downloadable()
                    ->default(null),
                TagsInput::make('tags')
                    ->placeholder('Tambah tag...')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
