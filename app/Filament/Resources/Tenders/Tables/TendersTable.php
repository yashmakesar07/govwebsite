<?php

namespace App\Filament\Resources\Tenders\Tables;

use App\Models\Tender;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TendersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tender_number')
                    ->label('Tender No.')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('title_en')
                    ->label('Title')
                    ->searchable()
                    ->limit(40)
                    ->tooltip(fn (Tender $record): string => $record->title_en),

                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->sortable(),

                TextColumn::make('tender_status')
                    ->label('Tender Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'upcoming' => 'info',
                        'closing_soon' => 'warning',
                        'closed' => 'gray',
                        default => 'gray',
                    }),

                TextColumn::make('status')
                    ->label('Workflow State')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'pending_review' => 'warning',
                        'draft' => 'gray',
                        'rejected' => 'danger',
                        'archived' => 'secondary',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('published_date')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('closing_date')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // 1. Submit for Review (Editor -> Publisher workflow)
                Action::make('submit_for_review')
                    ->label('Submit for Review')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Submit Tender for Review')
                    ->modalDescription('Are you sure you want to submit this tender to the Designated Publisher for vetting?')
                    ->visible(fn (Tender $record): bool => $record->status === 'draft')
                    ->action(function (Tender $record) {
                        $record->update(['status' => 'pending_review']);
                        Notification::make()
                            ->title('Submitted for Review')
                            ->body("Tender {$record->tender_number} has been submitted for review.")
                            ->warning()
                            ->send();
                    }),

                // 2. Approve and Publish (Publisher workflow)
                Action::make('approve_and_publish')
                    ->label('Approve & Publish')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Approve and Publish Tender')
                    ->modalDescription('This will immediately publish the tender onto the live public portal.')
                    ->visible(fn (Tender $record): bool => in_array($record->status, ['pending_review', 'draft']))
                    ->action(function (Tender $record) {
                        $record->update([
                            'status' => 'published',
                            'published_at' => now(),
                        ]);
                        Notification::make()
                            ->title('Tender Published Successfully')
                            ->body("Tender {$record->tender_number} is now live on the public website.")
                            ->success()
                            ->send();
                    }),

                // 3. Reject Tender
                Action::make('reject')
                    ->label('Reject')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Reject Tender Submission')
                    ->visible(fn (Tender $record): bool => $record->status === 'pending_review')
                    ->action(function (Tender $record) {
                        $record->update(['status' => 'rejected']);
                        Notification::make()
                            ->title('Tender Submission Rejected')
                            ->body("Tender {$record->tender_number} marked as rejected.")
                            ->danger()
                            ->send();
                    }),

                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
