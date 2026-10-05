<?php

namespace App\Http\Controllers;

use App\Models\Act;
use Illuminate\Http\Request;

class ActController extends Controller
{
    public function index(Request $request)
    {
        $query = Act::published();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title_en', 'like', "%{$search}%")
                  ->orWhere('title_hi', 'like', "%{$search}%")
                  ->orWhere('description_en', 'like', "%{$search}%");
            });
        }

        if ($type = $request->input('type')) {
            if ($type !== 'all') {
                $query->where('type', $type);
            }
        }

        if ($year = $request->input('year')) {
            if ($year !== 'all') {
                $query->where('year', $year);
            }
        }

        if ($language = $request->input('language')) {
            if ($language !== 'all') {
                $query->where('language', $language);
            }
        }

        $acts = $query->latest('year')->latest('published_at')->paginate(10)->withQueryString();

        $years = Act::published()->distinct()->pluck('year')->sortDesc();

        return view('pages.acts.index', compact('acts', 'years'));
    }
}
