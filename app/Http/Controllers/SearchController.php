<?php

namespace App\Http\Controllers;

use App\Models\Act;
use App\Models\Tender;
use App\Models\Scheme;
use App\Models\Meeting;
use App\Models\Notice;
use App\Models\Media;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->input('q', ''));

        $acts = collect();
        $tenders = collect();
        $schemes = collect();
        $meetings = collect();
        $notices = collect();
        $media = collect();

        if (strlen($q) >= 2) {
            $acts = Act::published()
                ->where(function ($query) use ($q) {
                    $query->where('title_en', 'like', "%{$q}%")
                          ->orWhere('title_hi', 'like', "%{$q}%")
                          ->orWhere('description_en', 'like', "%{$q}%");
                })->take(5)->get();

            $tenders = Tender::published()
                ->where(function ($query) use ($q) {
                    $query->where('tender_number', 'like', "%{$q}%")
                          ->orWhere('title_en', 'like', "%{$q}%")
                          ->orWhere('title_hi', 'like', "%{$q}%")
                          ->orWhere('description_en', 'like', "%{$q}%");
                })->take(5)->get();

            $schemes = Scheme::published()
                ->where(function ($query) use ($q) {
                    $query->where('title_en', 'like', "%{$q}%")
                          ->orWhere('title_hi', 'like', "%{$q}%")
                          ->orWhere('description_en', 'like', "%{$q}%");
                })->take(5)->get();

            $meetings = Meeting::published()
                ->where(function ($query) use ($q) {
                    $query->where('title_en', 'like', "%{$q}%")
                          ->orWhere('title_hi', 'like', "%{$q}%")
                          ->orWhere('agenda_en', 'like', "%{$q}%");
                })->take(5)->get();

            $notices = Notice::published()
                ->where(function ($query) use ($q) {
                    $query->where('title_en', 'like', "%{$q}%")
                          ->orWhere('title_hi', 'like', "%{$q}%")
                          ->orWhere('content_en', 'like', "%{$q}%");
                })->take(5)->get();

            $media = Media::published()
                ->where(function ($query) use ($q) {
                    $query->where('title_en', 'like', "%{$q}%")
                          ->orWhere('caption_en', 'like', "%{$q}%");
                })->take(5)->get();
        }

        $totalCount = $acts->count() + $tenders->count() + $schemes->count() + $meetings->count() + $notices->count() + $media->count();

        return view('pages.search', compact(
            'q', 'acts', 'tenders', 'schemes', 'meetings', 'notices', 'media', 'totalCount'
        ));
    }
}
