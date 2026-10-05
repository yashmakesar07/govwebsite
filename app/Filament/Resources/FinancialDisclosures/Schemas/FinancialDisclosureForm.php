<?php

namespace App\Filament\Resources\FinancialDisclosures\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FinancialDisclosureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('financial_year')
                    ->required(),
                TextInput::make('quarter')
                    ->required(),
                TextInput::make('fund_receipts')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('expenditure')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('project_allocation')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('project_category')
                    ->required()
                    ->default('general'),
                Textarea::make('remarks_en')
                    ->columnSpanFull(),
                Textarea::make('remarks_hi')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('draft'),
                DateTimePicker::make('published_at'),
                TextInput::make('created_by')
                    ->numeric(),
            ]);
    }
}
