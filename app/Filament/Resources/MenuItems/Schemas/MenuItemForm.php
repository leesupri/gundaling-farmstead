<?php

namespace App\Filament\Resources\MenuItems\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MenuItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('name')
                    ->label('Name (EN)')
                    ->required(),
                TextInput::make('name_id')
                    ->label('Name (ID)')
                    ->required(),
                Textarea::make('description')
                    ->label('Description (EN)')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('description_id')
                    ->label('Description (ID)')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->numeric()
                    ->prefix('Rp')
                    ->helperText('Flat price. Leave blank if this item uses Hot/Cold or Whole/Slice pricing instead.'),
                TextInput::make('hot_price')
                    ->numeric()
                    ->prefix('Rp'),
                TextInput::make('cold_price')
                    ->numeric()
                    ->prefix('Rp'),
                TextInput::make('whole_price')
                    ->numeric()
                    ->prefix('Rp'),
                TextInput::make('slice_price')
                    ->numeric()
                    ->prefix('Rp'),
                Textarea::make('notes')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('menu-items'),
                Toggle::make('is_available')
                    ->required()
                    ->default(true),
                Toggle::make('is_featured')
                    ->required(),
                Toggle::make('is_sold_out')
                    ->required(),
                TextInput::make('badge')
                    ->helperText('e.g. New, Signature, Spicy')
                    ->default(null),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
