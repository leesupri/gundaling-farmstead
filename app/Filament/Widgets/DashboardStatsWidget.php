<?php

namespace App\Filament\Widgets;

use App\Models\MenuItem;
use App\Models\Promo;
use App\Models\Reservation;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $nextExpiringPromo = Promo::where('is_active', true)
            ->whereNotNull('valid_until')
            ->orderBy('valid_until')
            ->first();

        return [
            Stat::make("Today's Reservations", Reservation::whereDate('date', today())->count())
                ->description('Upcoming 7 days: ' . Reservation::whereBetween('date', [today(), today()->addDays(7)])->count())
                ->color('success'),

            Stat::make('Currently Sold Out', MenuItem::where('is_sold_out', true)->count())
                ->description('Menu items marked unavailable')
                ->color('danger'),

            Stat::make('Active Promos', Promo::where('is_active', true)->count())
                ->description($nextExpiringPromo?->valid_until
                    ? 'Next expires ' . $nextExpiringPromo->valid_until->format('d M Y')
                    : 'No expiry scheduled')
                ->color('warning'),
        ];
    }
}
