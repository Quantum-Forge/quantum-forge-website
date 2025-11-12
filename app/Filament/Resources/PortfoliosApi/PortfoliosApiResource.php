<?php

namespace App\Filament\Resources\PortfoliosApi;

use App\Models\User;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use App\Filament\Resources\PortfoliosApi\Schemas\PortfoliosApiForm;
use App\Filament\Resources\PortfoliosApi\Tables\PortfoliosApiTable;
use App\Filament\Resources\PortfoliosApi\Pages\ListPortfoliosApis;
use App\Filament\Resources\PortfoliosApi\Pages\EditPortfoliosApi;

class PortfoliosApiResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedKey;

    protected static UnitEnum|string|null $navigationGroup = 'API';

    protected static ?string $navigationLabel = 'Portfolios API';

    protected static ?int $navigationSort = 50;

    public static function form(Schema $schema): Schema
    {
        return PortfoliosApiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PortfoliosApiTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPortfoliosApis::route('/'),
            'edit' => EditPortfoliosApi::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()->where('id', auth()->id());
    }

    public static function getNavigationUrl(): string
    {
        $user = auth()->user();

        if (! $user) {
            return static::getUrl('index');
        }

        return static::getUrl('edit', ['record' => $user]);
    }
}