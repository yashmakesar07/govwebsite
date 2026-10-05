@extends('layouts.app')

@section('title', __('ui.search_results'))

@section('breadcrumbs')
    <x-breadcrumbs :items="[
        ['label' => __('ui.search_results'), 'url' => '']
    ]" />
@endsection

@section('content')
<div class="py-8 sm:py-10 bg-slate-50 min-h-[75vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search Header & Prominent Input -->
        <div class="max-w-3xl mx-auto mb-8 text-center">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#062B52] mb-3">
                {{ __('ui.search_results') }}
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 mb-6">
                Search across all official acts, tenders, development schemes, minutes, notices, and media disclosures.
            </p>

            <form action="{{ route('search', ['locale' => app()->getLocale()]) }}" method="GET" class="relative max-w-2xl mx-auto">
                <input 
                    type="search" 
                    name="q" 
                    value="{{ $q }}" 
                    placeholder="Search documents, tenders, schemes, notices..." 
                    class="w-full pl-4 pr-24 py-3 text-sm sm:text-base border-2 border-[#0A66D6] rounded-lg shadow-sm focus:outline-none focus:ring-4 focus:ring-blue-100"
                    required
                />
                <button 
                    type="submit" 
                    class="absolute right-1.5 top-1.5 bottom-1.5 px-5 bg-[#0A66D6] hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm rounded-md transition"
                >
                    Search
                </button>
            </form>

            @if($q)
                <div class="mt-4 text-xs sm:text-sm text-slate-600">
                    Found <strong class="text-[#062B52]">{{ $totalCount }}</strong> {{ __('ui.results_found') }} for &ldquo;<span class="text-[#0A66D6] font-semibold">{{ $q }}</span>&rdquo;
                </div>
            @endif
        </div>

        @if($totalCount === 0 && $q)
            <div class="max-w-md mx-auto text-center py-12 bg-white rounded-lg border border-slate-200 p-8 shadow-sm">
                <svg class="w-12 h-12 text-slate-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-sm font-bold text-slate-800 mb-1">{{ __('ui.no_results') }}</h3>
                <p class="text-xs text-slate-500">Please try different keywords or browse categories using the top navigation bar.</p>
            </div>
        @endif

        <div class="space-y-8 max-w-4xl mx-auto">
            
            <!-- 1. Tenders Results -->
            @if($tenders->isNotEmpty())
                <div class="bg-white rounded-lg border border-slate-200 p-5 shadow-sm">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-3">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-[#062B52] flex items-center space-x-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                            <span>{{ __('ui.tenders') }} ({{ $tenders->count() }})</span>
                        </h2>
                        <a href="{{ route('tenders.index', ['locale' => app()->getLocale(), 'search' => $q]) }}" class="text-xs font-semibold text-[#0A66D6] hover:underline">
                            View All Tenders &rarr;
                        </a>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @foreach($tenders as $tender)
                            <div class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div>
                                    <div class="flex items-center space-x-2 text-xs text-slate-500 mb-0.5">
                                        <span class="font-mono font-bold text-[#062B52]">{{ $tender->tender_number }}</span>
                                        <span>&bull;</span>
                                        <x-status-badge :status="$tender->tender_status" />
                                    </div>
                                    <h3 class="text-sm font-semibold text-slate-900 hover:text-[#0A66D6]">
                                        <a href="{{ route('tenders.show', ['locale' => app()->getLocale(), 'slug' => $tender->slug]) }}">
                                            {{ $tender->getTitle() }}
                                        </a>
                                    </h3>
                                    <p class="text-xs text-slate-500 line-clamp-1 mt-0.5">{{ $tender->getDescription() }}</p>
                                </div>
                                <a href="{{ route('tenders.show', ['locale' => app()->getLocale(), 'slug' => $tender->slug]) }}" class="shrink-0 px-3 py-1 bg-[#0A66D6] text-white text-xs font-semibold rounded hover:bg-blue-700 transition">
                                    {{ __('ui.view') }} &rarr;
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- 2. Schemes Results -->
            @if($schemes->isNotEmpty())
                <div class="bg-white rounded-lg border border-slate-200 p-5 shadow-sm">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-3">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-[#062B52] flex items-center space-x-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                            <span>{{ __('ui.schemes') }} ({{ $schemes->count() }})</span>
                        </h2>
                        <a href="{{ route('schemes.index', ['locale' => app()->getLocale()]) }}" class="text-xs font-semibold text-[#0A66D6] hover:underline">
                            View All Schemes &rarr;
                        </a>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @foreach($schemes as $scheme)
                            <div class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div>
                                    <h3 class="text-sm font-semibold text-slate-900 hover:text-[#0A66D6]">
                                        <a href="{{ route('schemes.show', ['locale' => app()->getLocale(), 'slug' => $scheme->slug]) }}">
                                            {{ $scheme->getTitle() }}
                                        </a>
                                    </h3>
                                    <p class="text-xs text-slate-500 line-clamp-1 mt-0.5">{{ $scheme->getDescription() }}</p>
                                    <span class="text-[11px] text-[#0A66D6] font-semibold mt-1 inline-block">Progress: {{ $scheme->progress_percentage }}%</span>
                                </div>
                                <a href="{{ route('schemes.show', ['locale' => app()->getLocale(), 'slug' => $scheme->slug]) }}" class="shrink-0 px-3 py-1 bg-[#0A66D6] text-white text-xs font-semibold rounded hover:bg-blue-700 transition">
                                    {{ __('ui.view') }} &rarr;
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- 3. Acts & Rules Results -->
            @if($acts->isNotEmpty())
                <div class="bg-white rounded-lg border border-slate-200 p-5 shadow-sm">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-3">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-[#062B52] flex items-center space-x-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                            <span>{{ __('ui.acts_rules') }} ({{ $acts->count() }})</span>
                        </h2>
                        <a href="{{ route('acts.index', ['locale' => app()->getLocale()]) }}" class="text-xs font-semibold text-[#0A66D6] hover:underline">
                            View All Acts &rarr;
                        </a>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @foreach($acts as $act)
                            <div class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div>
                                    <div class="text-xs text-slate-500 mb-0.5">
                                        <span class="uppercase tracking-wider font-semibold text-slate-700">{{ $act->type }} &bull; {{ $act->year }}</span>
                                    </div>
                                    <h3 class="text-sm font-semibold text-slate-900">
                                        {{ $act->getTitle() }}
                                    </h3>
                                    <p class="text-xs text-slate-500 line-clamp-1 mt-0.5">{{ $act->getDescription() }}</p>
                                </div>
                                @if($act->file_path)
                                    <a href="{{ asset('storage/' . $act->file_path) }}" target="_blank" class="shrink-0 px-3 py-1 bg-[#0A66D6] text-white text-xs font-semibold rounded hover:bg-blue-700 transition">
                                        {{ __('ui.download') }} PDF &rarr;
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- 4. Important Notices & Circulars -->
            @if($notices->isNotEmpty())
                <div class="bg-white rounded-lg border border-slate-200 p-5 shadow-sm">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-3">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-[#062B52] flex items-center space-x-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                            <span>{{ __('ui.important_notices') }} & Circulars ({{ $notices->count() }})</span>
                        </h2>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @foreach($notices as $notice)
                            <div class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div>
                                    <div class="text-xs text-slate-500 mb-0.5">
                                        <span>{{ $notice->published_at?->format('d M Y') }} &bull; {{ str_replace('_', ' ', $notice->category) }}</span>
                                    </div>
                                    <h3 class="text-sm font-semibold text-slate-900">
                                        {{ $notice->getTitle() }}
                                    </h3>
                                    <p class="text-xs text-slate-500 line-clamp-1 mt-0.5">{{ $notice->getContent() }}</p>
                                </div>
                                @if($notice->file_path)
                                    <a href="{{ asset('storage/' . $notice->file_path) }}" target="_blank" class="shrink-0 px-3 py-1 bg-[#0A66D6] text-white text-xs font-semibold rounded hover:bg-blue-700 transition">
                                        Download PDF
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- 5. Meetings Results -->
            @if($meetings->isNotEmpty())
                <div class="bg-white rounded-lg border border-slate-200 p-5 shadow-sm">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-3">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-[#062B52] flex items-center space-x-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-indigo-500"></span>
                            <span>{{ __('ui.meetings') }} & Minutes ({{ $meetings->count() }})</span>
                        </h2>
                        <a href="{{ route('meetings.index', ['locale' => app()->getLocale()]) }}" class="text-xs font-semibold text-[#0A66D6] hover:underline">
                            View All Meetings &rarr;
                        </a>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @foreach($meetings as $meeting)
                            <div class="py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                                <div>
                                    <div class="text-xs text-slate-500 mb-0.5">
                                        <span>{{ $meeting->date?->format('d M Y') }} &bull; {{ $meeting->getLocation() }}</span>
                                    </div>
                                    <h3 class="text-sm font-semibold text-slate-900 hover:text-[#0A66D6]">
                                        <a href="{{ route('meetings.show', ['locale' => app()->getLocale(), 'slug' => $meeting->slug]) }}">
                                            {{ $meeting->getTitle() }}
                                        </a>
                                    </h3>
                                </div>
                                <a href="{{ route('meetings.show', ['locale' => app()->getLocale(), 'slug' => $meeting->slug]) }}" class="shrink-0 px-3 py-1 bg-[#0A66D6] text-white text-xs font-semibold rounded hover:bg-blue-700 transition">
                                    {{ __('ui.view') }} &rarr;
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>

    </div>
</div>
@endsection
