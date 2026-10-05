<?php

namespace App\Filament\Resources\Documents\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('documentable_type'),
                TextInput::make('documentable_id')
                    ->numeric(),
                TextInput::make('title_en')
                    ->required(),
                TextInput::make('title_hi'),
                TextInput::make('type')
                    ->required()
                    ->default('document'),
                TextInput::make('language')
                    ->required()
                    ->default('english'),
                TextInput::make('file_path')
                    ->required(),
                TextInput::make('file_size')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('mime_type'),
                TextInput::make('status')
                    ->required()
                    ->default('published'),
                DateTimePicker::make('published_at'),
                TextInput::make('uploaded_by')
                    ->numeric(),
            ]);
    }
}
