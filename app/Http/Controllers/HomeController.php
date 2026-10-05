<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\Tender;
use App\Models\Scheme;
use App\Models\Media;
use App\Models\Act;
use App\Models\Meeting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 5-6 Latest Notices
        $notices = Notice::published()
            ->latest('published_at')
            ->take(6)
            ->get();

        // 4-5 Latest Active/Closing Soon Tenders for side-by-side display
        $tenders = Tender::published()
            ->whereIn('tender_status', ['active', 'closing_soon', 'upcoming'])
            ->orderByRaw("CASE WHEN tender_status = 'closing_soon' THEN 1 WHEN tender_status = 'active' THEN 2 ELSE 3 END")
            ->latest('published_date')
            ->take(5)
            ->get();

        // 3 Featured Schemes
        $schemes = Scheme::published()
            ->take(3)
            ->get();

        // 4 Updates (notices of type notification or public_notice)
        $updates = Notice::published()
            ->whereIn('category', ['notification', 'public_notice', 'circular'])
            ->latest('published_at')
            ->take(4)
            ->get();

        // 6 Media Gallery Images
        $gallery = Media::published()
            ->latest('date')
            ->take(6)
            ->get();

        // Statistics counters
        $stats = [
            'schemes_count' => Scheme::published()->count(),
            'tenders_count' => Tender::published()->where('tender_status', 'active')->count(),
            'acts_count' => Act::published()->count(),
            'meetings_count' => Meeting::published()->count(),
            'total_allocation' => '₹480 Cr',
        ];

        return view('pages.home', compact('notices', 'tenders', 'schemes', 'updates', 'gallery', 'stats'));
    }
}
