<?php

namespace App\Filament\Resources\Schemes\Tables;

use App\Models\Scheme;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SchemesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title_en')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->limit(40)
                    ->tooltip(fn (Scheme $record): string => $record->title_en),

                TextColumn::make('progress_percentage')
                    ->label('Progress')
                    ->numeric()
                    ->suffix('%')
                    ->sortable(),

                TextColumn::make('financial_allocation')
                    ->label('Financial Allocation')
                    ->money('INR')
                    ->sortable(),

                TextColumn::make('scheme_status')
                    ->label('Scheme Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'upcoming' => 'info',
                        'completed' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Workflow Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'pending_review' => 'warning',
                        'draft' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
