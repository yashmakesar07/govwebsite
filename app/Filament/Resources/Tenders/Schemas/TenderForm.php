<?php

namespace App\Filament\Resources\Tenders\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class TenderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('tender_number')
                    ->label('Tender Reference Number')
                    ->required()
                    ->default(fn () => 'TPI/' . date('Y') . '/' . sprintf('%03d', rand(10, 999)))
                    ->placeholder('e.g. TPI/2026/012'),

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

                Textarea::make('description_en')
                    ->label('Scope of Work / Description (English)')
                    ->rows(3)
                    ->columnSpanFull(),

                Textarea::make('description_hi')
                    ->label('Scope of Work / Description (Hindi)')
                    ->rows(3)
                    ->columnSpanFull(),

                TextInput::make('department')
                    ->label('Issuing Department')
                    ->required()
                    ->default('Department of Public Infrastructure'),

                Select::make('category')
                    ->label('Procurement Category')
                    ->options([
                        'works' => 'Civil Infrastructure Works',
                        'goods' => 'Goods & Equipment Supply',
                        'services' => 'Technical & IT Services',
                        'consultancy' => 'Engineering Consultancy',
                    ])
                    ->default('works')
                    ->required(),

                DatePicker::make('published_date')
                    ->label('Tender Publication Date')
                    ->default(now())
                    ->required(),

                DatePicker::make('closing_date')
                    ->label('Bid Submission Closing Date')
                    ->default(now()->addDays(21))
                    ->required(),

                Select::make('tender_status')
                    ->label('Tender Operational Status')
                    ->options([
                        'active' => 'Active / Open for Bidding',
                        'upcoming' => 'Upcoming (Notice Stage)',
                        'closing_soon' => 'Closing Soon (< 7 days)',
                        'closed' => 'Closed (Under Evaluation)',
                    ])
                    ->default('active')
                    ->required(),

                Select::make('status')
                    ->label('Publishing Workflow Status')
                    ->options([
                        'draft' => 'Draft',
                        'pending_review' => 'Pending Review',
                        'published' => 'Published',
                        'rejected' => 'Rejected',
                        'archived' => 'Archived',
                    ])
                    ->default('draft')
                    ->required(),

                TextInput::make('estimated_value')
                    ->label('Estimated Value (in INR)')
                    ->numeric()
                    ->prefix('₹')
                    ->placeholder('e.g. 50000000'),

                TextInput::make('contact_name')
                    ->label('Contact Official Name')
                    ->default('Executive Engineer (Procurement)'),

                TextInput::make('contact_email')
                    ->label('Contact Official Email')
                    ->email()
                    ->default('procurement@example.gov.in'),

                TextInput::make('contact_phone')
                    ->label('Contact Telephone')
                    ->tel()
                    ->default('+91-11-2309-8800'),

                DateTimePicker::make('published_at')
                    ->label('Publish Timestamp')
                    ->nullable(),

                Hidden::make('created_by')
                    ->default(fn () => auth()->id()),
            ]);
    }
}
