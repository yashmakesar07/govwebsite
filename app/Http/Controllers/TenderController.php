<?php

namespace App\Http\Controllers;

use App\Models\Tender;
use Illuminate\Http\Request;

class TenderController extends Controller
{
    public function index(Request $request)
    {
        $query = Tender::published();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('tender_number', 'like', "%{$search}%")
                  ->orWhere('title_en', 'like', "%{$search}%")
                  ->orWhere('title_hi', 'like', "%{$search}%")
                  ->orWhere('description_en', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            if ($status !== 'all') {
                $query->where('tender_status', $status);
            }
        }

        if ($category = $request->input('category')) {
            if ($category !== 'all') {
                $query->where('category', $category);
            }
        }

        if ($year = $request->input('year')) {
            if ($year !== 'all') {
                $query->whereYear('published_date', $year);
            }
        }

        $tenders = $query->latest('published_date')->paginate(10)->withQueryString();

        $years = Tender::published()
            ->selectRaw('strftime("%Y", published_date) as year')
            ->distinct()
            ->pluck('year')
            ->filter();

        return view('pages.tenders.index', compact('tenders', 'years'));
    }

    public function show($locale, $slug)
    {
        $tender = Tender::published()
            ->where('slug', $slug)
            ->with('documents')
            ->firstOrFail();

        $relatedTenders = Tender::published()
            ->where('id', '!=', $tender->id)
            ->where('category', $tender->category)
            ->take(3)
            ->get();

        return view('pages.tenders.show', compact('tender', 'relatedTenders'));
    }
}
