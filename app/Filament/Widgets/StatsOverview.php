<?php

namespace App\Filament\Widgets;

use App\Models\Act;
use App\Models\Notice;
use App\Models\Scheme;
use App\Models\Tender;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalPublished = Notice::where('status', 'published')->count()
            + Tender::where('status', 'published')->count()
            + Scheme::where('status', 'published')->count()
            + Act::where('status', 'published')->count();

        $drafts = Notice::where('status', 'draft')->count()
            + Tender::where('status', 'draft')->count()
            + Scheme::where('status', 'draft')->count()
            + Act::where('status', 'draft')->count();

        $pendingReview = Notice::where('status', 'pending_review')->count()
            + Tender::where('status', 'pending_review')->count()
            + Scheme::where('status', 'pending_review')->count()
            + Act::where('status', 'pending_review')->count();

        $archived = Notice::where('status', 'archived')->count()
            + Tender::where('status', 'archived')->count()
            + Scheme::where('status', 'archived')->count()
            + Act::where('status', 'archived')->count();

        $activeTenders = Tender::where('tender_status', 'active')->count();

        $upcomingTenders = Tender::where('tender_status', 'upcoming')->count();

        return [
            Stat::make('Total Published', (string) $totalPublished)
                ->description('Published notices, tenders, schemes & acts')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Drafts', (string) $drafts)
                ->description('Items in drafting state')
                ->descriptionIcon('heroicon-m-pencil-square')
                ->color('gray'),

            Stat::make('Pending Review', (string) $pendingReview)
                ->description('Items awaiting publication approval')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Archived', (string) $archived)
                ->description('Archived records across system')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('danger'),

            Stat::make('Active Tenders', (string) $activeTenders)
                ->description('Currently accepting competitive bids')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),

            Stat::make('Upcoming Tenders', (string) $upcomingTenders)
                ->description('Scheduled for upcoming release')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info'),
        ];
    }
}
