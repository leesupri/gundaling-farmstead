<?php

namespace App\Filament\Widgets;

use App\Models\Reservation;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class TodaysBookingsWidget extends TableWidget
{
    protected static ?string $heading = "Today's Bookings";

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Reservation::query()->whereDate('date', today())->orderBy('time'))
            ->columns([
                TextColumn::make('time')
                    ->time(),
                TextColumn::make('name'),
                TextColumn::make('guests')
                    ->numeric(),
                TextColumn::make('status')
                    ->badge(),
            ])
            ->paginated(false);
    }
}
