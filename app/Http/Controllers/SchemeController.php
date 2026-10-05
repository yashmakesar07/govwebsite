<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use Illuminate\Http\Request;

class SchemeController extends Controller
{
    public function index()
    {
        $schemes = Scheme::published()->latest('published_at')->get();
        return view('pages.schemes.index', compact('schemes'));
    }

    public function show($locale, $slug)
    {
        $scheme = Scheme::published()
            ->where('slug', $slug)
            ->firstOrFail();

        $otherSchemes = Scheme::published()
            ->where('id', '!=', $scheme->id)
            ->take(3)
            ->get();

        return view('pages.schemes.show', compact('scheme', 'otherSchemes'));
    }
}
