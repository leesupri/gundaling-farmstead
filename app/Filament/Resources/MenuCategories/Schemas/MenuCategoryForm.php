<?php

namespace App\Filament\Resources\MenuCategories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class MenuCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('department')
                    ->options([
                        'foods' => 'Foods',
                        'drinks' => 'Drinks',
                        'retail' => 'Retail',
                    ])
                    ->required(),
                TextInput::make('name')
                    ->label('Name (EN)')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),
                TextInput::make('name_id')
                    ->label('Name (ID)')
                    ->required(),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->required()
                    ->default(true),
                TextInput::make('icon')
                    ->default(null),
                FileUpload::make('image')
                    ->image()
                    ->directory('menu-categories'),
            ]);
    }
}
