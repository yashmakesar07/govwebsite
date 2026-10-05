<?php

namespace App\Filament\Resources\Schemes\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class SchemeForm
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

                TextInput::make('progress_percentage')
                    ->label('Progress Percentage')
                    ->numeric()
                    ->suffix('%')
                    ->default(0)
                    ->minValue(0)
                    ->maxValue(100)
                    ->required(),

                TextInput::make('financial_allocation')
                    ->label('Financial Allocation')
                    ->numeric()
                    ->prefix('₹')
                    ->placeholder('e.g. 50000000'),

                TextInput::make('beneficiaries_count')
                    ->label('Beneficiaries Count')
                    ->numeric()
                    ->default(0)
                    ->required(),

                Select::make('scheme_status')
                    ->label('Scheme Operational Status')
                    ->options([
                        'active' => 'Active',
                        'upcoming' => 'Upcoming',
                        'completed' => 'Completed',
                    ])
                    ->default('active')
                    ->required(),

                Select::make('status')
                    ->label('Workflow Status')
                    ->options([
                        'draft' => 'Draft',
                        'pending_review' => 'Pending Review',
                        'published' => 'Published',
                    ])
                    ->default('draft')
                    ->required(),

                Textarea::make('description_en')
                    ->label('Description (English)')
                    ->rows(3)
                    ->columnSpanFull(),

                Textarea::make('description_hi')
                    ->label('Description (Hindi / हिन्दी)')
                    ->rows(3)
                    ->columnSpanFull(),

                Textarea::make('objectives_en')
                    ->label('Objectives (English)')
                    ->rows(3)
                    ->columnSpanFull(),

                Textarea::make('objectives_hi')
                    ->label('Objectives (Hindi / हिन्दी)')
                    ->rows(3)
                    ->columnSpanFull(),

                Textarea::make('eligibility_en')
                    ->label('Eligibility Criteria (English)')
                    ->rows(3)
                    ->columnSpanFull(),

                Textarea::make('eligibility_hi')
                    ->label('Eligibility Criteria (Hindi / हिन्दी)')
                    ->rows(3)
                    ->columnSpanFull(),

                FileUpload::make('image_path')
                    ->label('Scheme Image')
                    ->image()
                    ->directory('schemes')
                    ->columnSpanFull(),

                DateTimePicker::make('published_at')
                    ->label('Publication Date & Time')
                    ->nullable(),

                Hidden::make('created_by')
                    ->default(fn () => auth()->id()),
            ]);
    }
}
