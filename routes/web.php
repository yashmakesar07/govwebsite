<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\ActController;
use App\Http\Controllers\SchemeController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\FinancialDisclosureController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DocumentController;

// Direct root route redirects to default/session locale
Route::get('/', function () {
    $locale = session('locale', config('app.locale', 'en'));
    return redirect("/{$locale}");
});

// Direct document download endpoint
Route::get('/documents/{document}/download', [DocumentController::class, 'download'])
    ->name('documents.download');

// Locale-prefixed routes for English and Hindi (/en/... and /hi/...)
Route::prefix('{locale}')
    ->where(['locale' => 'en|hi'])
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/about', [PageController::class, 'about'])->name('about');
        
        // Tenders
        Route::get('/tenders', [TenderController::class, 'index'])->name('tenders.index');
        Route::get('/tenders/{slug}', [TenderController::class, 'show'])->name('tenders.show');

        // Acts & Rules
        Route::get('/acts-rules', [ActController::class, 'index'])->name('acts.index');

        // Schemes
        Route::get('/schemes', [SchemeController::class, 'index'])->name('schemes.index');
        Route::get('/schemes/{slug}', [SchemeController::class, 'show'])->name('schemes.show');

        // Meetings
        Route::get('/meetings', [MeetingController::class, 'index'])->name('meetings.index');
        Route::get('/meetings/{slug}', [MeetingController::class, 'show'])->name('meetings.show');

        // Financial Disclosures
        Route::get('/financial-disclosure', [FinancialDisclosureController::class, 'index'])->name('financial.index');

        // Media Gallery
        Route::get('/media', [MediaController::class, 'index'])->name('media.index');

        // RTI
        Route::get('/rti', [PageController::class, 'rti'])->name('rti');

        // Contact
        Route::get('/contact', [PageController::class, 'contact'])->name('contact');
        Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');

        // Global Search
        Route::get('/search', [SearchController::class, 'index'])->name('search');
    });
