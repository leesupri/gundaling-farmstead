<?php

namespace App\Filament\Resources\MenuItems\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MenuItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('category.name')
                    ->label('Category'),
                TextEntry::make('name'),
                TextEntry::make('name_id'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('description_id')
                    ->columnSpanFull(),
                TextEntry::make('price')
                    ->money(),
                ImageEntry::make('image')
                    ->placeholder('-'),
                IconEntry::make('is_available')
                    ->boolean(),
                IconEntry::make('is_featured')
                    ->boolean(),
                IconEntry::make('is_sold_out')
                    ->boolean(),
                TextEntry::make('badge')
                    ->placeholder('-'),
                TextEntry::make('sort_order')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
