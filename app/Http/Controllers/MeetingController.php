<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index(Request $request)
    {
        $query = Meeting::published();

        if ($type = $request->input('type')) {
            if ($type !== 'all') {
                $query->where('type', $type);
            }
        }

        if ($status = $request->input('meeting_status')) {
            if ($status !== 'all') {
                $query->where('meeting_status', $status);
            }
        }

        if ($year = $request->input('year')) {
            if ($year !== 'all') {
                $query->whereYear('date', $year);
            }
        }

        $meetings = $query->latest('date')->paginate(10)->withQueryString();

        $years = Meeting::published()
            ->selectRaw('strftime("%Y", date) as year')
            ->distinct()
            ->pluck('year')
            ->filter();

        return view('pages.meetings.index', compact('meetings', 'years'));
    }

    public function show($locale, $slug)
    {
        $meeting = Meeting::published()
            ->where('slug', $slug)
            ->with('documents')
            ->firstOrFail();

        return view('pages.meetings.show', compact('meeting'));
    }
}
