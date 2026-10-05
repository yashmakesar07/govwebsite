<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        $page = Page::published()->where('slug', 'about')->first();
        return view('pages.about', compact('page'));
    }

    public function rti()
    {
        $page = Page::published()->where('slug', 'rti')->first();
        return view('pages.rti', compact('page'));
    }

    public function contact()
    {
        $page = Page::published()->where('slug', 'contact')->first();
        return view('pages.contact', compact('page'));
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:2000',
        ]);

        return back()->with('success', app()->getLocale() === 'hi' 
            ? 'आपका संदेश सफलतापूर्वक प्राप्त हो गया है। संदर्भ संख्या: DPI-G-' . rand(10000, 99999)
            : 'Your message has been received successfully. Acknowledgment Reference: DPI-G-' . rand(10000, 99999)
        );
    }
}
