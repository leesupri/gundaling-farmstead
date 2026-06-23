<?php

namespace App\Filament\Resources\MenuCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MenuCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->columns([
                BadgeColumn::make('department'),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                ImageColumn::make('image'),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('name_id')
                    ->searchable(),
                TextColumn::make('items_count')
                    ->label('Items')
                    ->counts('items')
                    ->badge(),
                ToggleColumn::make('is_active'),
            ])
            ->filters([
                SelectFilter::make('department')
                    ->options([
                        'foods' => 'Foods',
                        'drinks' => 'Drinks',
                        'retail' => 'Retail',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
