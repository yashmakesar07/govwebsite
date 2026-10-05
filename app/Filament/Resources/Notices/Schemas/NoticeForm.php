<?php

namespace App\Filament\Resources\Notices\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NoticeForm
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

                Select::make('category')
                    ->label('Notice Category')
                    ->options([
                        'public_notice' => 'Public Notice',
                        'circular' => 'Circular',
                        'office_order' => 'Office Order',
                        'notification' => 'Notification',
                        'general' => 'General Notice',
                    ])
                    ->default('general')
                    ->required(),

                Toggle::make('is_new')
                    ->label('Mark as New')
                    ->default(true),

                Select::make('status')
                    ->label('Publishing Status')
                    ->options([
                        'draft' => 'Draft',
                        'pending_review' => 'Pending Review',
                        'published' => 'Published',
                        'rejected' => 'Rejected',
                        'archived' => 'Archived',
                    ])
                    ->default('draft')
                    ->required(),

                Textarea::make('content_en')
                    ->label('Content (English)')
                    ->rows(4)
                    ->columnSpanFull(),

                Textarea::make('content_hi')
                    ->label('Content (Hindi / हिन्दी)')
                    ->rows(4)
                    ->columnSpanFull(),

                TextInput::make('file_path')
                    ->label('Attached File Path / Document URL')
                    ->placeholder('e.g. notices/2026/notice-01.pdf')
                    ->columnSpanFull(),

                DateTimePicker::make('published_at')
                    ->label('Publication Date & Time')
                    ->nullable(),

                Hidden::make('created_by')
                    ->default(fn () => auth()->id()),
            ]);
    }
}
