<?php

namespace App\Filament\Resources\Media\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MediaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title_en')
                    ->required(),
                TextInput::make('title_hi'),
                Textarea::make('caption_en')
                    ->columnSpanFull(),
                Textarea::make('caption_hi')
                    ->columnSpanFull(),
                TextInput::make('category')
                    ->required()
                    ->default('general'),
                TextInput::make('file_path')
                    ->required(),
                TextInput::make('thumbnail_path'),
                DatePicker::make('date'),
                TextInput::make('status')
                    ->required()
                    ->default('published'),
            ]);
    }
}
