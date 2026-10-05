@extends('layouts.app')

@section('title', $scheme->getTitle())

@section('breadcrumbs')
    <x-breadcrumbs :items="[
        ['label' => __('ui.government_schemes'), 'url' => route('schemes.index', ['locale' => app()->getLocale()])],
        ['label' => $scheme->getTitle(), 'url' => '']
    ]" />
@endsection

@section('content')
<div class="py-8 sm:py-10 bg-slate-50 min-h-[75vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-4">
            <a href="{{ route('schemes.index', ['locale' => app()->getLocale()]) }}" class="inline-flex items-center space-x-1.5 text-xs sm:text-sm font-semibold text-[#0A66D6] hover:underline">
                <span>&larr;</span>
                <span>Back to All Schemes</span>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left: Main Scheme Content (8 Cols) -->
            <div class="lg:col-span-8 space-y-6">
                
                <!-- Main Header Banner -->
                <div class="bg-white rounded-lg border border-slate-200 overflow-hidden shadow-sm">
                    <div class="h-64 sm:h-72 w-full bg-slate-800 relative">
                        <img 
                            src="{{ asset($scheme->image_path ?: 'assets/images/scheme-rural.svg') }}" 
                            alt="{{ $scheme->getTitle() }}"
                            class="w-full h-full object-cover opacity-90" 
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-[#062B52] via-transparent to-black/20"></div>
                        <div class="absolute bottom-4 left-6 right-6">
                            <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded bg-[#0A66D6] text-white uppercase tracking-wider mb-2">
                                State Development Mission
                            </span>
                            <h1 class="text-xl sm:text-2xl md:text-3xl font-extrabold text-white leading-tight">
                                {{ $scheme->getTitle() }}
                            </h1>
                        </div>
                    </div>

                    <!-- Scheme Overview -->
                    <div class="p-6 space-y-6">
                        <div>
                            <h2 class="text-base font-bold text-[#062B52] uppercase tracking-wider mb-2 pb-2 border-b border-slate-100 flex items-center space-x-2">
                                <svg class="w-5 h-5 text-[#0A66D6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ __('ui.scheme_overview') }}</span>
                            </h2>
                            <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                                {{ $scheme->getDescription() }}
                            </p>
                        </div>

                        <!-- Objectives -->
                        <div>
                            <h2 class="text-base font-bold text-[#062B52] uppercase tracking-wider mb-2 pb-2 border-b border-slate-100 flex items-center space-x-2">
                                <svg class="w-5 h-5 text-[#0A66D6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ __('ui.objectives') }}</span>
                            </h2>
                            <div class="text-sm text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-md border border-slate-100 whitespace-pre-line">
                                {{ $scheme->getObjectives() ?: '1. Enhance state-wide access to quality public infrastructure.\n2. Ensure zero-gap connectivity across underserved citizen pockets.\n3. Climate-resilient construction certified by third-party testing.' }}
                            </div>
                        </div>

                        <!-- Eligibility -->
                        <div>
                            <h2 class="text-base font-bold text-[#062B52] uppercase tracking-wider mb-2 pb-2 border-b border-slate-100 flex items-center space-x-2">
                                <svg class="w-5 h-5 text-[#0A66D6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <span>{{ __('ui.eligibility') }}</span>
                            </h2>
                            <p class="text-sm text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-md border border-slate-100">
                                {{ $scheme->getEligibility() ?: 'All local panchayats, municipal bodies, and state departments within the jurisdiction of Example State.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Related Documents -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6">
                    <h2 class="text-base font-bold text-[#062B52] uppercase tracking-wider mb-3 pb-2 border-b border-slate-100 flex items-center space-x-2">
                        <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ __('ui.related_documents') }}</span>
                    </h2>

                    <div class="space-y-3">
                        <div class="p-3.5 bg-slate-50 rounded border border-slate-200 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <svg class="w-7 h-7 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <div>
                                    <h3 class="text-xs sm:text-sm font-semibold text-slate-800">Operational Scheme Guidelines & Financial Norms.pdf</h3>
                                    <span class="text-[11px] text-slate-500">Official Government Order &bull; 1.5 MB &bull; PDF</span>
                                </div>
                            </div>
                            <a 
                                href="{{ asset('storage/documents/Infrastructure_Guidelines_2026.pdf') }}" 
                                target="_blank"
                                class="inline-flex items-center px-3 py-1.5 bg-[#0A66D6] hover:bg-blue-700 text-white text-xs font-semibold rounded shadow-sm transition"
                            >
                                {{ __('ui.download') }}
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right: Progress, Beneficiaries, Financials (4 Cols) -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Implementation Progress Card -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-5">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">
                        {{ __('ui.implementation_progress') }}
                    </h3>

                    <div class="space-y-3">
                        <div class="flex items-baseline justify-between">
                            <span class="text-3xl font-extrabold text-[#062B52]">{{ $scheme->progress_percentage }}%</span>
                            <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">On Track</span>
                        </div>

                        <div class="w-full h-3 bg-slate-200 rounded-full overflow-hidden">
                            <div class="h-full bg-[#0A66D6] rounded-full transition-all duration-500" style="width: {{ $scheme->progress_percentage }}%;"></div>
                        </div>

                        <p class="text-xs text-slate-500 leading-relaxed pt-1">
                            Physical execution vetted through quarterly geospatial milestone surveys and engineer-in-charge certifications.
                        </p>
                    </div>
                </div>

                <!-- Scheme Status & Financials Card -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-5">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 pb-3 border-b border-slate-100 mb-3">
                        Scheme Parameters
                    </h3>

                    <dl class="divide-y divide-slate-100 text-xs">
                        <div class="py-2.5 flex justify-between">
                            <dt class="text-slate-500">{{ __('ui.approval_status') }}</dt>
                            <dd><x-status-badge :status="$scheme->scheme_status" /></dd>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <dt class="text-slate-500">{{ __('ui.financial_allocation_label') }}</dt>
                            <dd class="font-bold text-[#062B52]">₹{{ number_format($scheme->financial_allocation / 10000000, 2) }} Cr</dd>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <dt class="text-slate-500">{{ __('ui.beneficiaries') }}</dt>
                            <dd class="font-semibold text-slate-800">{{ number_format($scheme->beneficiaries_count) }}+</dd>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <dt class="text-slate-500">Fund Source</dt>
                            <dd class="font-medium text-slate-800">State Infrastructure Fund (SIF)</dd>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <dt class="text-slate-500">Monitoring Agency</dt>
                            <dd class="font-medium text-slate-800">Apex Technical Directorate</dd>
                        </div>
                    </dl>
                </div>

                <!-- Related Schemes -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-5">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 pb-3 border-b border-slate-100 mb-3">
                        Other State Schemes
                    </h3>
                    <div class="divide-y divide-slate-100">
                        @foreach($otherSchemes as $other)
                            <div class="py-2.5">
                                <a href="{{ route('schemes.show', ['locale' => app()->getLocale(), 'slug' => $other->slug]) }}" class="text-xs font-semibold text-slate-800 hover:text-[#0A66D6] block leading-tight">
                                    {{ $other->getTitle() }}
                                </a>
                                <span class="text-[11px] text-slate-500 mt-0.5 inline-block">Progress: {{ $other->progress_percentage }}%</span>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
