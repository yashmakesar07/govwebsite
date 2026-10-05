<?php

namespace App\Filament\Resources\Notices\Tables;

use App\Models\Notice;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NoticesTable
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
                    ->tooltip(fn (Notice $record): string => $record->title_en),

                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'public_notice' => 'Public Notice',
                        'circular' => 'Circular',
                        'office_order' => 'Office Order',
                        'notification' => 'Notification',
                        'general' => 'General Notice',
                        default => ucfirst(str_replace('_', ' ', $state)),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'public_notice' => 'warning',
                        'circular' => 'info',
                        'office_order' => 'primary',
                        'notification' => 'danger',
                        'general' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
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

                IconColumn::make('is_new')
                    ->label('New')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('published_at')
                    ->label('Published At')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                Action::make('publish')
                    ->label('Publish')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Publish Notice')
                    ->modalDescription('Are you sure you want to publish this notice?')
                    ->visible(fn (Notice $record): bool => $record->status !== 'published')
                    ->action(function (Notice $record) {
                        $record->update([
                            'status' => 'published',
                            'published_at' => now(),
                        ]);
                        Notification::make()
                            ->title('Notice Published')
                            ->body("Notice '{$record->title_en}' has been published successfully.")
                            ->success()
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
