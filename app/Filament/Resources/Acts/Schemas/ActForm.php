<?php

namespace App\Filament\Resources\Acts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ActForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title_en')
                    ->label('Title (English)')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation, $state, callable $set) {
                        if ($operation === 'create') {
                            $set('slug', Str::slug($state));
                        }
                    }),

                TextInput::make('title_hi')
                    ->label('Title (Hindi / हिन्दी)'),

                TextInput::make('slug')
                    ->label('URL Slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Select::make('type')
                    ->label('Document Type')
                    ->options([
                        'act' => 'Act',
                        'rule' => 'Rule',
                        'guideline' => 'Guideline',
                        'regulation' => 'Regulation',
                        'circular' => 'Circular',
                    ])
                    ->default('act')
                    ->required(),

                TextInput::make('year')
                    ->label('Year')
                    ->numeric()
                    ->default((int) date('Y'))
                    ->required(),

                Select::make('language')
                    ->label('Language')
                    ->options([
                        'english' => 'English',
                        'hindi' => 'Hindi (हिन्दी)',
                        'bilingual' => 'Bilingual (English & Hindi)',
                    ])
                    ->default('english')
                    ->required(),

                TextInput::make('category')
                    ->label('Category')
                    ->default('general')
                    ->required(),

                Select::make('status')
                    ->label('Publishing Status')
                    ->options([
                        'draft' => 'Draft',
                        'pending_review' => 'Pending Review',
                        'published' => 'Published',
                    ])
                    ->default('draft')
                    ->required(),

                TextInput::make('file_path')
                    ->label('File Path / Document URL')
                    ->placeholder('e.g. acts/2026/act-01.pdf')
                    ->columnSpanFull(),

                Textarea::make('description_en')
                    ->label('Description (English)')
                    ->rows(3)
                    ->columnSpanFull(),

                Textarea::make('description_hi')
                    ->label('Description (Hindi / हिन्दी)')
                    ->rows(3)
                    ->columnSpanFull(),

                TextInput::make('file_size')
                    ->label('File Size (in bytes)')
                    ->numeric()
                    ->nullable(),

                DateTimePicker::make('published_at')
                    ->label('Publication Date & Time')
                    ->nullable(),

                Hidden::make('created_by')
                    ->default(fn () => auth()->id()),
            ]);
    }
}
