<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Visit;
use Carbon\Carbon;

class DailyVisitorsChart extends ChartWidget
{
    protected ?string $heading = 'Daily Visitors';
    protected ?string $pollingInterval = null; // disable auto-refresh
    protected int|string|array $columnSpan = ['sm' => 12, 'md' => 6];

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        // Last 14 days including today
        $days = collect(range(13, 0))
            ->map(fn ($i) => Carbon::today()->subDays($i));

        $labels = $days->map(fn ($day) => $day->format('d M'));

        // Aggregate visits by day
        $countsByDate = Visit::query()
            ->where('visited_at', '>=', Carbon::today()->subDays(13))
            ->get()
            ->groupBy(fn ($visit) => Carbon::parse($visit->visited_at)->toDateString())
            ->map->count();

        $data = $days->map(fn ($day) => $countsByDate[$day->toDateString()] ?? 0);

        return [
            'labels' => $labels->all(),
            'datasets' => [
                [
                    'label' => 'Visitors',
                    'data' => $data->all(),
                    'borderColor' => '#1A73E8',
                    'backgroundColor' => 'rgba(26, 115, 232, 0.15)',
                    'tension' => 0.3,
                    'fill' => true,
                ],
            ],
        ];
    }
}
