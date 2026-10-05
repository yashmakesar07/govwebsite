<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Notices\NoticeResource;
use App\Models\Notice;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LatestNoticesWidget extends TableWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Latest Notices')
            ->query(
                Notice::query()
                    ->latest('published_at')
                    ->latest('id')
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('title_en')
                    ->label('Title')
                    ->searchable()
                    ->wrap()
                    ->limit(65)
                    ->tooltip(fn (Notice $record): ?string => $record->title_en),

                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => $state ? ucwords(str_replace('_', ' ', $state)) : '—'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'gray',
                        'pending_review' => 'warning',
                        'archived' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'published' => 'Published',
                        'draft' => 'Draft',
                        'pending_review' => 'Pending Review',
                        'archived' => 'Archived',
                        default => ucfirst($state),
                    }),

                TextColumn::make('published_at')
                    ->label('Published At')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->placeholder('Not published'),
            ])
            ->recordActions([
                EditAction::make()
                    ->url(fn (Notice $record): string => NoticeResource::getUrl('edit', ['record' => $record])),
            ])
            ->paginated(false);
    }
}
