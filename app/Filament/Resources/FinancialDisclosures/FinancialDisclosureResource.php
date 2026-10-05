<?php

namespace App\Filament\Resources\FinancialDisclosures;

use App\Filament\Resources\FinancialDisclosures\Pages\CreateFinancialDisclosure;
use App\Filament\Resources\FinancialDisclosures\Pages\EditFinancialDisclosure;
use App\Filament\Resources\FinancialDisclosures\Pages\ListFinancialDisclosures;
use App\Filament\Resources\FinancialDisclosures\Schemas\FinancialDisclosureForm;
use App\Filament\Resources\FinancialDisclosures\Tables\FinancialDisclosuresTable;
use App\Models\FinancialDisclosure;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FinancialDisclosureResource extends Resource
{
    protected static ?string $model = FinancialDisclosure::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;
    protected static string|\UnitEnum|null $navigationGroup = 'Content';
    protected static ?int $navigationSort = 7;

    public static function form(Schema $schema): Schema
    {
        return FinancialDisclosureForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FinancialDisclosuresTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFinancialDisclosures::route('/'),
            'create' => CreateFinancialDisclosure::route('/create'),
            'edit' => EditFinancialDisclosure::route('/{record}/edit'),
        ];
    }
}
