<?php

namespace App\Filament\Resources\Reservations\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ReservationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('email')
                    ->label('Email address'),
                TextEntry::make('phone'),
                TextEntry::make('date')
                    ->date(),
                TextEntry::make('time')
                    ->time(),
                TextEntry::make('guests')
                    ->numeric(),
                TextEntry::make('occasion')
                    ->placeholder('-'),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('status')
                    ->badge(),
                IconEntry::make('wa_sent')
                    ->boolean(),
                TextEntry::make('beo_file')
                    ->placeholder('-'),
                TextEntry::make('group_name')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
