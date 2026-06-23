<?php

namespace App\Filament\Resources\Reservations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ReservationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                DatePicker::make('date')
                    ->required(),
                TimePicker::make('time')
                    ->required(),
                TextInput::make('guests')
                    ->required()
                    ->numeric(),
                Select::make('occasion')
                    ->options([
                        'Birthday' => 'Birthday',
                        'Anniversary' => 'Anniversary',
                        'Business Dinner' => 'Business Dinner',
                        'Wedding' => 'Wedding',
                        'Large Group' => 'Large Group',
                        'Other' => 'Other',
                    ])
                    ->default(null),
                Toggle::make('is_group_event')
                    ->label('Large group or event (10+ guests)')
                    ->live()
                    ->dehydrated(false),
                TextInput::make('group_name')
                    ->label('Group / Event Name')
                    ->visible(fn ($get) => $get('is_group_event') || $get('group_name'))
                    ->default(null),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                        'beo_uploaded' => 'BEO Uploaded',
                    ])
                    ->default('pending')
                    ->required(),
                Toggle::make('wa_sent')
                    ->required(),
                FileUpload::make('beo_file')
                    ->label('BEO (PDF)')
                    ->disk('local')
                    ->directory('beos')
                    ->visibility('private')
                    ->acceptedFileTypes(['application/pdf'])
                    ->maxSize(10240)
                    ->afterStateUpdated(fn ($state, $set) => $state && $set('status', 'beo_uploaded'))
                    ->live(),
            ]);
    }
}
