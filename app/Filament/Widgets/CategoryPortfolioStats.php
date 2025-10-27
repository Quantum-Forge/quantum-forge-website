<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Portfolio;
use Filament\Widgets\StatsOverviewWidget as BaseStatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CategoryPortfolioStats extends BaseStatsOverviewWidget
{
    protected int|string|array $columnSpan = ['sm' => 12, 'md' => 6];

    protected function getStats(): array
    {
        return [
            Stat::make('Categories', (string) Category::query()->count())
                ->icon('heroicon-o-tag'),
            Stat::make('Portfolio', (string) Portfolio::query()->count())
                ->icon('heroicon-o-briefcase'),
        ];
    }

    protected function getColumns(): int|array
    {
        // Full width on mobile (1 col), 2 cols on md+
        return [
            'md' => 2,
        ];
    }
}
