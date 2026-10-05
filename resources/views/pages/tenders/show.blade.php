@extends('layouts.app')

@section('title', $tender->tender_number . ' - ' . $tender->getTitle())

@section('breadcrumbs')
    <x-breadcrumbs :items="[
        ['label' => __('ui.tenders'), 'url' => route('tenders.index', ['locale' => app()->getLocale()])],
        ['label' => $tender->tender_number, 'url' => '']
    ]" />
@endsection

@section('content')
<div class="py-8 sm:py-10 bg-slate-50 min-h-[75vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Top Back Link -->
        <div class="mb-4">
            <a href="{{ route('tenders.index', ['locale' => app()->getLocale()]) }}" class="inline-flex items-center space-x-1.5 text-xs sm:text-sm font-semibold text-[#0A66D6] hover:underline">
                <span>&larr;</span>
                <span>Back to All Tenders</span>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left / Main Column: Tender Details & Documents (8 Cols) -->
            <div class="lg:col-span-8 space-y-6">
                
                <!-- Main Header Card -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                        <span class="font-mono font-bold text-sm bg-blue-50 text-[#062B52] px-3 py-1 rounded border border-blue-200">
                            {{ $tender->tender_number }}
                        </span>
                        <x-status-badge :status="$tender->tender_status" />
                    </div>

                    <h1 class="text-xl sm:text-2xl font-bold text-[#062B52] leading-tight mb-3">
                        {{ $tender->getTitle() }}
                    </h1>

                    <div class="flex flex-wrap items-center gap-y-2 gap-x-4 text-xs text-slate-500 pb-4 border-b border-slate-100">
                        <span><strong>{{ __('ui.department') }}:</strong> {{ $tender->department }}</span>
                        <span>&bull;</span>
                        <span class="capitalize"><strong>{{ __('ui.category') }}:</strong> {{ $tender->category }}</span>
                    </div>

                    <!-- Scope / Description -->
                    <div class="pt-5">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-slate-700 mb-2">
                            {{ __('ui.description') }}
                        </h2>
                        <div class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                            {{ $tender->getDescription() }}
                        </div>
                    </div>
                </div>

                <!-- Tender Documents Section (Crucial requirement) -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-200 mb-4">
                        <h2 class="text-base font-bold text-[#062B52] flex items-center space-x-2">
                            <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ __('ui.tender_documents') }}</span>
                        </h2>
                        <span class="text-xs text-slate-500 font-medium">Official Verified Attachments</span>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @forelse($tender->documents as $doc)
                            <div class="py-3.5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 group">
                                <div class="flex items-start space-x-3">
                                    <div class="w-9 h-9 rounded bg-rose-50 text-rose-600 border border-rose-200 flex items-center justify-center shrink-0 mt-0.5">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-semibold text-slate-900 group-hover:text-[#0A66D6] leading-tight">
                                            {{ $doc->getTitle() }}
                                        </h3>
                                        <p class="text-[11px] text-slate-500 mt-0.5">
                                            <span>Format: PDF</span>
                                            <span class="mx-1">&bull;</span>
                                            <span>Size: {{ $doc->getFormattedFileSize() }}</span>
                                            <span class="mx-1">&bull;</span>
                                            <span class="capitalize">Type: {{ str_replace('_', ' ', $doc->type) }}</span>
                                        </p>
                                    </div>
                                </div>

                                <div class="shrink-0 flex items-center space-x-2">
                                    <!-- Download Button with active route -->
                                    <a 
                                        href="{{ route('documents.download', ['document' => $doc->id]) }}" 
                                        class="inline-flex items-center space-x-1.5 px-3 py-1.5 bg-[#0A66D6] hover:bg-blue-700 text-white text-xs font-semibold rounded shadow-sm transition"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                        <span>{{ __('ui.download') }}</span>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-500 py-3">No supplementary documents uploaded for this tender.</p>
                        @endforelse
                    </div>

                    <div class="mt-4 p-3 bg-amber-50 rounded border border-amber-200 text-xs text-amber-900 flex items-start space-x-2">
                        <svg class="w-4 h-4 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>All tender documents and BOQ specifications are digitally authenticated with cryptographic hash checksums. Corrigenda (if any) will be notified on this same page.</span>
                    </div>
                </div>

            </div>

            <!-- Right Sidebar: Tender Info & Important Dates (4 Cols) -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Important Dates Card -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-5">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-[#062B52] pb-3 border-b border-slate-200 mb-3 flex items-center space-x-2">
                        <svg class="w-4 h-4 text-[#0A66D6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ __('ui.important_dates') }}</span>
                    </h3>

                    <dl class="divide-y divide-slate-100 text-xs">
                        <div class="py-2.5 flex justify-between">
                            <dt class="text-slate-500">{{ __('ui.published_date') }}</dt>
                            <dd class="font-semibold text-slate-800">{{ $tender->published_date?->format('d M Y') }}</dd>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <dt class="text-slate-500">{{ __('ui.closing_date') }}</dt>
                            <dd class="font-bold text-rose-700">{{ $tender->closing_date?->format('d M Y') }}</dd>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <dt class="text-slate-500">Bid Opening Date</dt>
                            <dd class="font-semibold text-slate-800">{{ $tender->closing_date?->copy()->addDay()->format('d M Y') }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Tender Information Card -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-5">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-[#062B52] pb-3 border-b border-slate-200 mb-3 flex items-center space-x-2">
                        <svg class="w-4 h-4 text-[#0A66D6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ __('ui.tender_information') }}</span>
                    </h3>

                    <dl class="divide-y divide-slate-100 text-xs">
                        <div class="py-2.5 flex justify-between">
                            <dt class="text-slate-500">Tender Reference</dt>
                            <dd class="font-mono font-bold text-slate-900">{{ $tender->tender_number }}</dd>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <dt class="text-slate-500">Estimated Project Value</dt>
                            <dd class="font-bold text-[#062B52]">
                                @if($tender->estimated_value)
                                    ₹{{ number_format($tender->estimated_value / 10000000, 2) }} Crore
                                @else
                                    Refer BOQ
                                @endif
                            </dd>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <dt class="text-slate-500">Bidding Type</dt>
                            <dd class="font-medium text-slate-800">Two-Cover (Technical + Financial)</dd>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <dt class="text-slate-500">EMD Requirement</dt>
                            <dd class="font-medium text-slate-800">2% of Estimated Value</dd>
                        </div>
                    </dl>
                </div>

                <!-- Contact Information -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-5">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-[#062B52] pb-3 border-b border-slate-200 mb-3 flex items-center space-x-2">
                        <svg class="w-4 h-4 text-[#0A66D6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>{{ __('ui.contact_information') }}</span>
                    </h3>

                    <div class="text-xs space-y-2 text-slate-700">
                        <p class="font-semibold text-slate-900">{{ $tender->contact_name ?: 'Procurement Officer' }}</p>
                        <p class="text-slate-500">{{ $tender->department }}</p>
                        @if($tender->contact_email)
                            <p class="flex items-center space-x-1.5 text-[#0A66D6]">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <a href="mailto:{{ $tender->contact_email }}" class="hover:underline">{{ $tender->contact_email }}</a>
                            </p>
                        @endif
                        @if($tender->contact_phone)
                            <p class="flex items-center space-x-1.5 text-slate-600">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span>{{ $tender->contact_phone }}</span>
                            </p>
                        @endif
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
