<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title_en')
                    ->required(),
                TextInput::make('title_hi'),
                Textarea::make('content_en')
                    ->columnSpanFull(),
                Textarea::make('content_hi')
                    ->columnSpanFull(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('template')
                    ->required()
                    ->default('default'),
                TextInput::make('status')
                    ->required()
                    ->default('draft'),
                DateTimePicker::make('published_at'),
                TextInput::make('created_by')
                    ->numeric(),
            ]);
    }
}
