<?php

namespace App\Filament\Resources\Promos\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PromoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Title (EN)')
                    ->required(),
                TextInput::make('title_id')
                    ->label('Title (ID)')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('description_id')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('promos'),
                TextInput::make('tag')
                    ->required(),
                TextInput::make('tag_id')
                    ->required(),
                DatePicker::make('valid_until'),
                Toggle::make('is_active')
                    ->required()
                    ->default(true),
                Toggle::make('show_as_popup')
                    ->label('Show as popup on site entry')
                    ->helperText('Shown once per visitor on first page load. Only one promo can be the active popup — enabling this turns it off for any other promo.')
                    ->default(false),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
