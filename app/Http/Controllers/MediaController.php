<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::published();

        if ($category = $request->input('category')) {
            if ($category !== 'all') {
                $query->where('category', $category);
            }
        }

        $items = $query->latest('date')->paginate(12)->withQueryString();
        $categories = Media::published()->distinct()->pluck('category');

        return view('pages.media.index', compact('items', 'categories'));
    }
}
