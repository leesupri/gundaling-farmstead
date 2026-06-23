<?php

namespace App\Filament\Resources\MenuItems\Tables;

use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class MenuItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('price')
                    ->money('idr')
                    ->sortable(),
                ToggleColumn::make('is_sold_out')
                    ->label('Sold Out'),
                ToggleColumn::make('is_available'),
                IconColumn::make('is_featured')
                    ->boolean(),
                TextColumn::make('badge')
                    ->badge()
                    ->searchable(),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->label('Category'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('markSoldOut')
                        ->label('Mark Sold Out')
                        ->action(fn (Collection $records) => $records->each->update(['is_sold_out' => true]))
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('markAvailable')
                        ->label('Mark Available')
                        ->action(fn (Collection $records) => $records->each->update(['is_sold_out' => false]))
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('toggleFeatured')
                        ->label('Toggle Featured')
                        ->action(fn (Collection $records) => $records->each(
                            fn ($record) => $record->update(['is_featured' => ! $record->is_featured])
                        ))
                        ->deselectRecordsAfterCompletion(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
