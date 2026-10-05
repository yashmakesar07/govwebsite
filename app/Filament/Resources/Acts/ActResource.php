<?php

namespace App\Filament\Resources\Acts;

use App\Filament\Resources\Acts\Pages\CreateAct;
use App\Filament\Resources\Acts\Pages\EditAct;
use App\Filament\Resources\Acts\Pages\ListActs;
use App\Filament\Resources\Acts\Schemas\ActForm;
use App\Filament\Resources\Acts\Tables\ActsTable;
use App\Models\Act;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ActResource extends Resource
{
    protected static ?string $model = Act::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedScale;
    protected static string|\UnitEnum|null $navigationGroup = 'Content';
    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return ActForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ActsTable::configure($table);
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
            'index' => ListActs::route('/'),
            'create' => CreateAct::route('/create'),
            'edit' => EditAct::route('/{record}/edit'),
        ];
    }
}
