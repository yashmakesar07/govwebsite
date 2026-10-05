<?php

namespace App\Filament\Resources\FinancialDisclosures\Pages;

use App\Filament\Resources\FinancialDisclosures\FinancialDisclosureResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFinancialDisclosure extends EditRecord
{
    protected static string $resource = FinancialDisclosureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
