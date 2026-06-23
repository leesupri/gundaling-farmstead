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
                    ->required(),
                TextInput::make('title_id')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('description_id')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->directory('promos'),
                TextInput::make('tag')
                    ->required(),
                TextInput::make('tag_id')
                    ->required(),
                DatePicker::make('valid_until'),
                Toggle::make('is_active')
                    ->required()
                    ->default(true),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
