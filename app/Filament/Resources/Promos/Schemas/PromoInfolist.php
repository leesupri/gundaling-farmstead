<?php

namespace App\Filament\Resources\Promos\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PromoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('title_id'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('description_id')
                    ->columnSpanFull(),
                ImageEntry::make('image')
                    ->placeholder('-'),
                TextEntry::make('tag'),
                TextEntry::make('tag_id'),
                TextEntry::make('valid_until')
                    ->date()
                    ->placeholder('-'),
                IconEntry::make('is_active')
                    ->boolean(),
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
