@extends('layouts.app')

@section('title', __('ui.portal_title'))

@section('content')
<!-- ================================================
     1. HERO SECTION
     ================================================ -->
<section class="relative bg-[#031C36] text-white overflow-hidden" aria-label="Hero Banner">
    <!-- Hero Background Image (16:6 aspect ratio) -->
    <div class="absolute inset-0 z-0">
        <img 
            src="{{ asset('assets/images/hero-infrastructure.svg') }}" 
            alt="State Administrative Infrastructure" 
            class="w-full h-full object-cover object-center opacity-40 mix-blend-luminosity" 
        />
        <div class="absolute inset-0 bg-gradient-to-r from-[#031C36] via-[#062B52]/90 to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24">
        <div class="max-w-2xl">
            <!-- Badge / Over-title -->
            <div class="inline-flex items-center space-x-2 px-3 py-1 rounded bg-[#0A66D6]/30 border border-[#0A66D6]/50 text-blue-200 text-xs sm:text-sm font-semibold tracking-wider uppercase mb-4">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                <span>{{ __('ui.portal_title') }}</span>
            </div>

            <!-- Hero Heading -->
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-white leading-tight mb-4">
                {{ __('ui.hero_heading') }}
            </h1>

            <!-- Hero Description -->
            <p class="text-base sm:text-lg text-slate-200 mb-8 leading-relaxed font-normal">
                {{ __('ui.hero_description') }}
            </p>

            <!-- Call to Actions -->
            <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                <a 
                    href="{{ route('schemes.index', ['locale' => app()->getLocale()]) }}" 
                    class="btn-primary shadow-md hover:shadow-lg transition"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span>{{ __('ui.explore_schemes') }}</span>
                </a>
                <a 
                    href="{{ route('tenders.index', ['locale' => app()->getLocale()]) }}" 
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 hover:bg-white/20 text-white font-semibold text-sm rounded border border-white/30 backdrop-blur-sm transition"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>{{ __('ui.view_tenders') }}</span>
                </a>
            </div>

            <!-- Subtle Indicators -->
            <div class="mt-8 flex items-center space-x-2 text-xs text-slate-300">
                <span class="w-8 h-1 bg-[#0A66D6] rounded"></span>
                <span class="w-2 h-1 bg-slate-500 rounded"></span>
                <span class="w-2 h-1 bg-slate-500 rounded"></span>
                <span class="ml-2 text-[11px] uppercase tracking-wider text-slate-300">Official Public Service Portal</span>
            </div>
        </div>
    </div>
</section>

<!-- ================================================
     2. QUICK ACCESS SECTION (7 CARDS)
     ================================================ -->
<section class="py-10 bg-white border-b border-slate-200" aria-label="Quick Access">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-[#062B52]">
                    {{ __('ui.quick_access') }}
                </h2>
                <div class="h-1 w-12 bg-[#0A66D6] mt-1.5 rounded"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-4">
            <!-- Card 1: Acts & Rules -->
            <a href="{{ route('acts.index', ['locale' => app()->getLocale()]) }}" class="group block p-4 bg-slate-50 hover:bg-[#EAF3FF] border border-slate-200 hover:border-[#0A66D6] rounded-lg transition card-hover">
                <div class="w-10 h-10 rounded-md bg-blue-100 text-[#0A66D6] flex items-center justify-center mb-3 group-hover:scale-105 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-[#10233F] group-hover:text-[#0A66D6] mb-1 leading-snug">
                    {{ __('ui.acts_rules') }}
                </h3>
                <p class="text-xs text-slate-500 line-clamp-2">
                    {{ __('ui.acts_rules_desc') }}
                </p>
                <span class="inline-block mt-2 text-xs font-semibold text-[#0A66D6] group-hover:translate-x-1 transition">&rarr;</span>
            </a>

            <!-- Card 2: Schemes -->
            <a href="{{ route('schemes.index', ['locale' => app()->getLocale()]) }}" class="group block p-4 bg-slate-50 hover:bg-[#EAF3FF] border border-slate-200 hover:border-[#0A66D6] rounded-lg transition card-hover">
                <div class="w-10 h-10 rounded-md bg-emerald-100 text-emerald-700 flex items-center justify-center mb-3 group-hover:scale-105 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-[#10233F] group-hover:text-[#0A66D6] mb-1 leading-snug">
                    {{ __('ui.schemes') }}
                </h3>
                <p class="text-xs text-slate-500 line-clamp-2">
                    {{ __('ui.schemes_desc') }}
                </p>
                <span class="inline-block mt-2 text-xs font-semibold text-[#0A66D6] group-hover:translate-x-1 transition">&rarr;</span>
            </a>

            <!-- Card 3: Tenders & EOIs -->
            <a href="{{ route('tenders.index', ['locale' => app()->getLocale()]) }}" class="group block p-4 bg-slate-50 hover:bg-[#EAF3FF] border border-slate-200 hover:border-[#0A66D6] rounded-lg transition card-hover">
                <div class="w-10 h-10 rounded-md bg-amber-100 text-amber-800 flex items-center justify-center mb-3 group-hover:scale-105 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-[#10233F] group-hover:text-[#0A66D6] mb-1 leading-snug">
                    {{ __('ui.tenders') }}
                </h3>
                <p class="text-xs text-slate-500 line-clamp-2">
                    {{ __('ui.tenders_desc') }}
                </p>
                <span class="inline-block mt-2 text-xs font-semibold text-[#0A66D6] group-hover:translate-x-1 transition">&rarr;</span>
            </a>

            <!-- Card 4: Meetings & Minutes -->
            <a href="{{ route('meetings.index', ['locale' => app()->getLocale()]) }}" class="group block p-4 bg-slate-50 hover:bg-[#EAF3FF] border border-slate-200 hover:border-[#0A66D6] rounded-lg transition card-hover">
                <div class="w-10 h-10 rounded-md bg-indigo-100 text-indigo-700 flex items-center justify-center mb-3 group-hover:scale-105 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-[#10233F] group-hover:text-[#0A66D6] mb-1 leading-snug">
                    {{ __('ui.meetings') }}
                </h3>
                <p class="text-xs text-slate-500 line-clamp-2">
                    {{ __('ui.meetings_desc') }}
                </p>
                <span class="inline-block mt-2 text-xs font-semibold text-[#0A66D6] group-hover:translate-x-1 transition">&rarr;</span>
            </a>

            <!-- Card 5: Financial Disclosure -->
            <a href="{{ route('financial.index', ['locale' => app()->getLocale()]) }}" class="group block p-4 bg-slate-50 hover:bg-[#EAF3FF] border border-slate-200 hover:border-[#0A66D6] rounded-lg transition card-hover">
                <div class="w-10 h-10 rounded-md bg-teal-100 text-teal-800 flex items-center justify-center mb-3 group-hover:scale-105 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-[#10233F] group-hover:text-[#0A66D6] mb-1 leading-snug">
                    {{ __('ui.financial_disclosure') }}
                </h3>
                <p class="text-xs text-slate-500 line-clamp-2">
                    {{ __('ui.financial_desc') }}
                </p>
                <span class="inline-block mt-2 text-xs font-semibold text-[#0A66D6] group-hover:translate-x-1 transition">&rarr;</span>
            </a>

            <!-- Card 6: Media Gallery -->
            <a href="{{ route('media.index', ['locale' => app()->getLocale()]) }}" class="group block p-4 bg-slate-50 hover:bg-[#EAF3FF] border border-slate-200 hover:border-[#0A66D6] rounded-lg transition card-hover">
                <div class="w-10 h-10 rounded-md bg-purple-100 text-purple-700 flex items-center justify-center mb-3 group-hover:scale-105 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-[#10233F] group-hover:text-[#0A66D6] mb-1 leading-snug">
                    {{ __('ui.media') }}
                </h3>
                <p class="text-xs text-slate-500 line-clamp-2">
                    {{ __('ui.media_desc') }}
                </p>
                <span class="inline-block mt-2 text-xs font-semibold text-[#0A66D6] group-hover:translate-x-1 transition">&rarr;</span>
            </a>

            <!-- Card 7: RTI -->
            <a href="{{ route('rti', ['locale' => app()->getLocale()]) }}" class="group block p-4 bg-slate-50 hover:bg-[#EAF3FF] border border-slate-200 hover:border-[#0A66D6] rounded-lg transition card-hover">
                <div class="w-10 h-10 rounded-md bg-rose-100 text-rose-700 flex items-center justify-center mb-3 group-hover:scale-105 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-sm font-semibold text-[#10233F] group-hover:text-[#0A66D6] mb-1 leading-snug">
                    {{ __('ui.rti') }}
                </h3>
                <p class="text-xs text-slate-500 line-clamp-2">
                    {{ __('ui.rti_desc') }}
                </p>
                <span class="inline-block mt-2 text-xs font-semibold text-[#0A66D6] group-hover:translate-x-1 transition">&rarr;</span>
            </a>
        </div>
    </div>
</section>

<!-- ================================================
     3. IMPORTANT NOTICES + LATEST TENDERS (SIDE BY SIDE ON DESKTOP)
     ================================================ -->
<section class="py-12 bg-slate-50" aria-label="Official Disclosures and Tenders">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Left: Important Notices -->
            <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between pb-4 border-b border-slate-200 mb-4">
                        <div>
                            <h2 class="text-lg sm:text-xl font-bold text-[#062B52] flex items-center space-x-2">
                                <svg class="w-5 h-5 text-[#0A66D6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                <span>{{ __('ui.important_notices') }}</span>
                            </h2>
                        </div>
                        <a href="{{ route('acts.index', ['locale' => app()->getLocale()]) }}" class="text-xs font-semibold text-[#0A66D6] hover:underline flex items-center space-x-1">
                            <span>{{ __('ui.view_all') }}</span>
                            <span>&rarr;</span>
                        </a>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @foreach($notices as $notice)
                            <article class="py-3.5 group">
                                <div class="flex items-center space-x-2 text-[11px] text-slate-500 mb-1">
                                    <time datetime="{{ $notice->published_at?->toIso8601String() }}">
                                        {{ $notice->published_at?->format('d M Y') }}
                                    </time>
                                    <span>&bull;</span>
                                    <span class="uppercase tracking-wider font-semibold text-slate-600">
                                        {{ str_replace('_', ' ', $notice->category) }}
                                    </span>
                                    @if($notice->is_new)
                                        <span class="badge badge-new">{{ __('ui.new') }}</span>
                                    @endif
                                </div>
                                <div class="flex items-start justify-between gap-3">
                                    <h3 class="text-sm font-semibold text-slate-900 group-hover:text-[#0A66D6] leading-snug">
                                        {{ $notice->getTitle() }}
                                    </h3>
                                    @if($notice->file_path)
                                        <a 
                                            href="{{ asset('storage/' . $notice->file_path) }}" 
                                            target="_blank"
                                            class="shrink-0 text-slate-400 hover:text-rose-600 transition p-1"
                                            title="Download PDF"
                                            aria-label="Download document for {{ $notice->getTitle() }}"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 text-right">
                    <a href="{{ route('acts.index', ['locale' => app()->getLocale()]) }}" class="inline-flex items-center text-xs font-semibold text-[#0A66D6] hover:underline">
                        <span>Browse Official Notices Archive &rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Right: Latest Tenders -->
            <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between pb-4 border-b border-slate-200 mb-4">
                        <div>
                            <h2 class="text-lg sm:text-xl font-bold text-[#062B52] flex items-center space-x-2">
                                <svg class="w-5 h-5 text-[#0A66D6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                                <span>{{ __('ui.latest_tenders') }}</span>
                            </h2>
                        </div>
                        <a href="{{ route('tenders.index', ['locale' => app()->getLocale()]) }}" class="text-xs font-semibold text-[#0A66D6] hover:underline flex items-center space-x-1">
                            <span>{{ __('ui.view_all') }}</span>
                            <span>&rarr;</span>
                        </a>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @foreach($tenders as $tender)
                            <article class="py-3.5 group">
                                <div class="flex items-center justify-between gap-2 mb-1">
                                    <div class="flex items-center space-x-2 text-xs">
                                        <span class="font-mono font-bold text-[#062B52]">{{ $tender->tender_number }}</span>
                                        <span class="text-slate-400">&bull;</span>
                                        <span class="text-slate-500 capitalize">{{ $tender->category }}</span>
                                    </div>
                                    <x-status-badge :status="$tender->tender_status" />
                                </div>
                                
                                <h3 class="text-sm font-semibold text-slate-900 group-hover:text-[#0A66D6] leading-snug mb-1.5">
                                    <a href="{{ route('tenders.show', ['locale' => app()->getLocale(), 'slug' => $tender->slug]) }}">
                                        {{ $tender->getTitle() }}
                                    </a>
                                </h3>

                                <div class="flex items-center justify-between text-[11px] text-slate-500">
                                    <span>Closing: <strong class="text-slate-700 font-semibold">{{ $tender->closing_date?->format('d M Y') }}</strong></span>
                                    <a 
                                        href="{{ route('tenders.show', ['locale' => app()->getLocale(), 'slug' => $tender->slug]) }}" 
                                        class="font-semibold text-[#0A66D6] hover:underline inline-flex items-center space-x-1"
                                    >
                                        <span>{{ __('ui.view') }} Details</span>
                                        <span>&rarr;</span>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 text-right">
                    <a href="{{ route('tenders.index', ['locale' => app()->getLocale()]) }}" class="inline-flex items-center text-xs font-semibold text-[#0A66D6] hover:underline">
                        <span>Search All Procurement & Tenders &rarr;</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ================================================
     4. ABOUT DEPARTMENT (INSTITUTIONAL SPLIT LAYOUT)
     ================================================ -->
<section class="py-14 bg-white border-y border-slate-200" aria-label="About Department">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- Left: Text Summary -->
            <div class="lg:col-span-7 space-y-4">
                <div class="inline-block text-xs font-bold uppercase tracking-wider text-[#0A66D6] bg-blue-50 px-2.5 py-1 rounded">
                    Institutional Mandate
                </div>
                <h2 class="text-2xl sm:text-3xl font-bold text-[#062B52] leading-tight">
                    {{ __('ui.about_department') }}
                </h2>
                <div class="h-1 w-16 bg-[#0A66D6] rounded"></div>

                <p class="text-slate-700 text-base leading-relaxed">
                    {{ __('ui.about_description') }}
                </p>

                <p class="text-slate-600 text-sm leading-relaxed">
                    Established under the State Governance Framework, the department oversees the complete lifecycle of public capital projects — from rigorous feasibility appraisals and transparent electronic bidding to automated telemetry monitoring and public social audits.
                </p>

                <div class="pt-2">
                    <a 
                        href="{{ route('about', ['locale' => app()->getLocale()]) }}" 
                        class="btn-outline text-sm"
                    >
                        <span>{{ __('ui.read_more') }}</span>
                        <span>&rarr;</span>
                    </a>
                </div>
            </div>

            <!-- Right: Statistics / Achievements -->
            <div class="lg:col-span-5 bg-slate-50 border border-slate-200 rounded-xl p-6 sm:p-8">
                <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-6">
                    Verified Departmental Milestones (Demo Data)
                </h3>
                
                <div class="grid grid-cols-2 gap-6">
                    <div class="border-l-4 border-[#0A66D6] pl-3">
                        <span class="block text-2xl sm:text-3xl font-extrabold text-[#062B52]">25+</span>
                        <span class="text-xs text-slate-600 font-medium">{{ __('ui.schemes_implemented') }}</span>
                    </div>

                    <div class="border-l-4 border-emerald-600 pl-3">
                        <span class="block text-2xl sm:text-3xl font-extrabold text-[#062B52]">150+</span>
                        <span class="text-xs text-slate-600 font-medium">{{ __('ui.tenders_published') }}</span>
                    </div>

                    <div class="border-l-4 border-amber-600 pl-3">
                        <span class="block text-2xl sm:text-3xl font-extrabold text-[#062B52]">500+</span>
                        <span class="text-xs text-slate-600 font-medium">{{ __('ui.meetings_conducted') }}</span>
                    </div>

                    <div class="border-l-4 border-indigo-600 pl-3">
                        <span class="block text-2xl sm:text-3xl font-extrabold text-[#062B52]">1000+</span>
                        <span class="text-xs text-slate-600 font-medium">{{ __('ui.citizens_benefited') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ================================================
     5. KEY INFORMATION STATISTICS STRIP
     ================================================ -->
<section class="py-12 bg-[#062B52] text-white" aria-label="Key Information Strip">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <h2 class="text-xl sm:text-2xl font-bold uppercase tracking-wide text-blue-200">
                {{ __('ui.key_information') }}
            </h2>
            <p class="text-xs text-slate-300 mt-1">
                Real-time open disclosure indices updated continuously
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 text-center">
            <!-- 1. Acts & Rules -->
            <div class="bg-white/5 border border-white/10 rounded-lg p-5 backdrop-blur-sm">
                <span class="block text-3xl sm:text-4xl font-extrabold text-white mb-1">125+</span>
                <span class="text-xs font-medium text-slate-300">{{ __('ui.acts_and_rules') }}</span>
            </div>

            <!-- 2. Schemes -->
            <div class="bg-white/5 border border-white/10 rounded-lg p-5 backdrop-blur-sm">
                <span class="block text-3xl sm:text-4xl font-extrabold text-white mb-1">48</span>
                <span class="text-xs font-medium text-slate-300">{{ __('ui.government_schemes') }}</span>
            </div>

            <!-- 3. Active Tenders -->
            <div class="bg-white/5 border border-white/10 rounded-lg p-5 backdrop-blur-sm">
                <span class="block text-3xl sm:text-4xl font-extrabold text-emerald-300 mb-1">62</span>
                <span class="text-xs font-medium text-slate-300">{{ __('ui.active_tenders') }}</span>
            </div>

            <!-- 4. Meetings -->
            <div class="bg-white/5 border border-white/10 rounded-lg p-5 backdrop-blur-sm">
                <span class="block text-3xl sm:text-4xl font-extrabold text-white mb-1">90+</span>
                <span class="text-xs font-medium text-slate-300">{{ __('ui.meetings_label') }}</span>
            </div>

            <!-- 5. Project Allocation -->
            <div class="bg-white/5 border border-white/10 rounded-lg p-5 backdrop-blur-sm col-span-2 md:col-span-1">
                <span class="block text-3xl sm:text-4xl font-extrabold text-amber-300 mb-1">₹480 Cr</span>
                <span class="text-xs font-medium text-slate-300">{{ __('ui.project_allocation') }}</span>
            </div>
        </div>
    </div>
</section>

<!-- ================================================
     6. FEATURED SCHEMES / DEVELOPMENT (3 CARDS)
     ================================================ -->
<section class="py-14 bg-slate-50" aria-label="Featured Development Schemes">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-[#062B52]">
                    {{ __('ui.featured_schemes') }}
                </h2>
                <div class="h-1 w-14 bg-[#0A66D6] mt-2 rounded"></div>
            </div>
            <a href="{{ route('schemes.index', ['locale' => app()->getLocale()]) }}" class="inline-flex items-center space-x-1.5 text-sm font-semibold text-[#0A66D6] hover:underline">
                <span>{{ __('ui.view_all') }} Schemes</span>
                <span>&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($schemes as $scheme)
                <div class="bg-white rounded-lg border border-slate-200 overflow-hidden shadow-sm flex flex-col justify-between card-hover">
                    <div>
                        <!-- Scheme Header Graphic -->
                        <div class="relative h-44 bg-slate-100 overflow-hidden">
                            <img 
                                src="{{ asset($scheme->image_path ?: 'assets/images/scheme-rural.svg') }}" 
                                alt="{{ $scheme->getTitle() }}"
                                class="w-full h-full object-cover" 
                            />
                            <div class="absolute top-3 right-3">
                                <x-status-badge :status="$scheme->scheme_status" />
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-[#062B52] mb-2 leading-snug">
                                <a href="{{ route('schemes.show', ['locale' => app()->getLocale(), 'slug' => $scheme->slug]) }}" class="hover:text-[#0A66D6]">
                                    {{ $scheme->getTitle() }}
                                </a>
                            </h3>
                            <p class="text-xs text-slate-600 line-clamp-3 mb-4 leading-relaxed">
                                {{ $scheme->getDescription() }}
                            </p>

                            <!-- Progress Bar -->
                            <div class="space-y-1.5 bg-slate-50 p-3 rounded-md border border-slate-100">
                                <div class="flex items-center justify-between text-xs font-semibold">
                                    <span class="text-slate-600">{{ __('ui.implementation_progress') }}</span>
                                    <span class="text-[#0A66D6] font-bold">{{ $scheme->progress_percentage }}%</span>
                                </div>
                                <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-[#0A66D6] rounded-full" style="width: {{ $scheme->progress_percentage }}%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="px-5 py-3.5 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-500">Updated: {{ $scheme->published_at?->format('d M Y') }}</span>
                        <a 
                            href="{{ route('schemes.show', ['locale' => app()->getLocale(), 'slug' => $scheme->slug]) }}" 
                            class="font-semibold text-[#0A66D6] hover:underline inline-flex items-center space-x-1"
                        >
                            <span>{{ __('ui.view_scheme') }}</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ================================================
     7. LATEST UPDATES (4-CARD GRID)
     ================================================ -->
<section class="py-14 bg-white border-b border-slate-200" aria-label="Latest Departmental Updates">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-[#062B52]">
                {{ __('ui.latest_updates') }}
            </h2>
            <div class="h-1 w-14 bg-[#0A66D6] mt-2 rounded"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($updates as $update)
                <article class="bg-slate-50 border border-slate-200 rounded-lg p-5 flex flex-col justify-between card-hover">
                    <div>
                        <div class="flex items-center justify-between text-[11px] text-slate-500 mb-2">
                            <span class="uppercase tracking-wider font-semibold text-[#0A66D6]">{{ str_replace('_', ' ', $update->category) }}</span>
                            <time datetime="{{ $update->published_at?->toIso8601String() }}">{{ $update->published_at?->format('d M Y') }}</time>
                        </div>
                        <h3 class="text-sm font-bold text-[#10233F] leading-snug mb-2">
                            {{ $update->getTitle() }}
                        </h3>
                        <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed mb-4">
                            {{ $update->getContent() }}
                        </p>
                    </div>

                    <div class="pt-3 border-t border-slate-200 text-xs">
                        @if($update->file_path)
                            <a 
                                href="{{ asset('storage/' . $update->file_path) }}" 
                                target="_blank"
                                class="font-semibold text-[#0A66D6] hover:underline inline-flex items-center space-x-1"
                            >
                                <span>Download Circular (PDF)</span>
                                <span>&rarr;</span>
                            </a>
                        @else
                            <a href="{{ route('acts.index', ['locale' => app()->getLocale()]) }}" class="font-semibold text-[#0A66D6] hover:underline inline-flex items-center space-x-1">
                                <span>Read Notification</span>
                                <span>&rarr;</span>
                            </a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<!-- ================================================
     8. MEDIA GALLERY (6 IMAGES WITH LIGHTBOX)
     ================================================ -->
<section class="py-14 bg-slate-50" aria-label="Media Gallery">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-4">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-[#062B52]">
                    {{ __('ui.media_gallery') }}
                </h2>
                <div class="h-1 w-14 bg-[#0A66D6] mt-2 rounded"></div>
            </div>
            <a href="{{ route('media.index', ['locale' => app()->getLocale()]) }}" class="inline-flex items-center space-x-1.5 text-sm font-semibold text-[#0A66D6] hover:underline">
                <span>{{ __('ui.view_full_gallery') }}</span>
                <span>&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
            @foreach($gallery as $img)
                <div 
                    class="group relative bg-white border border-slate-200 rounded-lg overflow-hidden shadow-sm cursor-pointer card-hover"
                    onclick="openLightbox('{{ asset($img->file_path) }}', '{{ addslashes($img->getTitle()) }}', '{{ addslashes($img->getCaption()) }}')"
                >
                    <div class="aspect-w-16 aspect-h-11 bg-slate-200 overflow-hidden h-48">
                        <img 
                            src="{{ asset($img->file_path) }}" 
                            alt="{{ $img->getTitle() }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                        />
                    </div>
                    <div class="p-3.5 bg-white">
                        <div class="flex items-center justify-between text-[11px] text-slate-500 mb-1">
                            <span class="uppercase tracking-wider font-semibold text-[#0A66D6]">{{ $img->category }}</span>
                            <span>{{ $img->date?->format('d M Y') }}</span>
                        </div>
                        <h3 class="text-xs font-semibold text-slate-900 truncate">
                            {{ $img->getTitle() }}
                        </h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Lightbox Modal Component -->
<div id="gallery-lightbox" class="fixed inset-0 z-50 bg-black/80 hidden items-center justify-center p-4" onclick="closeLightbox(event)" role="dialog" aria-modal="true" aria-label="Photo Preview">
    <div class="max-w-3xl w-full bg-white rounded-lg overflow-hidden shadow-2xl relative" onclick="event.stopPropagation()">
        <button onclick="closeLightbox()" class="absolute top-3 right-3 text-slate-400 hover:text-slate-800 bg-white/80 rounded-full p-1.5 transition" aria-label="Close Preview">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <img id="lightbox-image" src="" alt="" class="w-full max-h-[70vh] object-contain bg-slate-900" />
        <div class="p-4 bg-white">
            <h4 id="lightbox-title" class="text-base font-bold text-slate-900"></h4>
            <p id="lightbox-caption" class="text-xs text-slate-600 mt-1"></p>
        </div>
    </div>
</div>

<script>
    function openLightbox(src, title, caption) {
        document.getElementById('lightbox-image').src = src;
        document.getElementById('lightbox-title').innerText = title;
        document.getElementById('lightbox-caption').innerText = caption;
        const modal = document.getElementById('gallery-lightbox');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeLightbox() {
        const modal = document.getElementById('gallery-lightbox');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>

<!-- ================================================
     9. IMPORTANT LINKS & CITIZEN PORTAL CTA
     ================================================ -->
<section class="py-12 bg-white border-t border-slate-200" aria-label="Important Links and Contact CTA">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
            
            <div class="p-6 bg-slate-50 border border-slate-200 rounded-lg">
                <h3 class="text-base font-bold text-[#062B52] mb-1">State E-Procurement</h3>
                <p class="text-xs text-slate-600 mb-3">Unified vendor registration, digital tender submissions and automated bidding.</p>
                <a href="{{ route('tenders.index', ['locale' => app()->getLocale()]) }}" class="text-xs font-semibold text-[#0A66D6] hover:underline">
                    Access Procurement Portal &rarr;
                </a>
            </div>

            <div class="p-6 bg-slate-50 border border-slate-200 rounded-lg">
                <h3 class="text-base font-bold text-[#062B52] mb-1">Right to Information</h3>
                <p class="text-xs text-slate-600 mb-3">Statutory disclosures, CPIO contact details, and online RTI filing guidance.</p>
                <a href="{{ route('rti', ['locale' => app()->getLocale()]) }}" class="text-xs font-semibold text-[#0A66D6] hover:underline">
                    View RTI Disclosures &rarr;
                </a>
            </div>

            <div class="p-6 bg-[#062B52] text-white rounded-lg">
                <h3 class="text-base font-bold text-white mb-1">Citizen Grievance Redressal</h3>
                <p class="text-xs text-slate-300 mb-3">Submit inquiries or report issues regarding state public infrastructure works.</p>
                <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="inline-flex items-center px-3 py-1.5 bg-[#0A66D6] text-white text-xs font-semibold rounded hover:bg-blue-600 transition">
                    Contact Us &rarr;
                </a>
            </div>

        </div>
    </div>
</section>
@endsection
