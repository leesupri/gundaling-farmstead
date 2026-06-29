<?php

namespace App\Filament\Widgets;

use App\Models\Reservation;
use Filament\Widgets\ChartWidget;

class ReservationsChartWidget extends ChartWidget
{
    protected ?string $heading = 'Upcoming 7 Days — Reservations';

    protected function getData(): array
    {
        $days = collect(range(0, 6))->map(fn (int $i) => today()->addDays($i));

        $counts = $days->map(
            fn ($day) => Reservation::whereDate('date', $day)->count()
        );

        return [
            'datasets' => [
                [
                    'label' => 'Reservations',
                    'data' => $counts->all(),
                    'backgroundColor' => '#2C5F2D',
                ],
            ],
            'labels' => $days->map(fn ($day) => $day->format('D, d M'))->all(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
