<?php

namespace App\Filament\Widgets;

use App\Models\MenuItem;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class SoldOutItemsWidget extends TableWidget
{
    protected static ?string $heading = 'Currently Sold Out';

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => MenuItem::query()->where('is_sold_out', true))
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('category.name')
                    ->label('Category'),
            ])
            ->recordActions([
                Action::make('markAvailable')
                    ->label('Mark Available')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn (MenuItem $record) => $record->update(['is_sold_out' => false]))
                    ->successNotificationTitle('Marked available'),
            ])
            ->paginated(false);
    }
}
