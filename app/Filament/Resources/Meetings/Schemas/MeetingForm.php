<?php

namespace App\Filament\Resources\Meetings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class MeetingForm
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

                DatePicker::make('date')
                    ->label('Meeting Date')
                    ->default(now())
                    ->required(),

                TextInput::make('location_en')
                    ->label('Location / Venue (English)')
                    ->placeholder('e.g. Conference Hall, Department HQ'),

                TextInput::make('location_hi')
                    ->label('Location / Venue (Hindi / हिन्दी)'),

                Select::make('type')
                    ->label('Meeting Type')
                    ->options([
                        'departmental' => 'Departmental',
                        'review' => 'Review',
                        'public' => 'Public',
                        'special' => 'Special',
                    ])
                    ->default('departmental')
                    ->required(),

                Select::make('meeting_status')
                    ->label('Meeting Status')
                    ->options([
                        'scheduled' => 'Scheduled',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('scheduled')
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

                Textarea::make('agenda_en')
                    ->label('Agenda (English)')
                    ->rows(3)
                    ->columnSpanFull(),

                Textarea::make('agenda_hi')
                    ->label('Agenda (Hindi / हिन्दी)')
                    ->rows(3)
                    ->columnSpanFull(),

                Textarea::make('minutes_en')
                    ->label('Minutes of Meeting (English)')
                    ->rows(4)
                    ->columnSpanFull(),

                Textarea::make('minutes_hi')
                    ->label('Minutes of Meeting (Hindi / हिन्दी)')
                    ->rows(4)
                    ->columnSpanFull(),

                Textarea::make('resolutions_en')
                    ->label('Resolutions / Decisions (English)')
                    ->rows(3)
                    ->columnSpanFull(),

                Textarea::make('resolutions_hi')
                    ->label('Resolutions / Decisions (Hindi / हिन्दी)')
                    ->rows(3)
                    ->columnSpanFull(),

                DateTimePicker::make('published_at')
                    ->label('Publication Date & Time')
                    ->nullable(),

                Hidden::make('created_by')
                    ->default(fn () => auth()->id()),
            ]);
    }
}
