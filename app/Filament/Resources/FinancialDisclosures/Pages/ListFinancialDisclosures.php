<?php

namespace App\Filament\Resources\FinancialDisclosures\Pages;

use App\Filament\Resources\FinancialDisclosures\FinancialDisclosureResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFinancialDisclosures extends ListRecords
{
    protected static string $resource = FinancialDisclosureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
