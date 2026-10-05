@extends('layouts.app')

@section('title', $meeting->getTitle())

@section('breadcrumbs')
    <x-breadcrumbs :items="[
        ['label' => __('ui.meetings'), 'url' => route('meetings.index', ['locale' => app()->getLocale()])],
        ['label' => $meeting->getTitle(), 'url' => '']
    ]" />
@endsection

@section('content')
<div class="py-8 sm:py-10 bg-slate-50 min-h-[75vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-4">
            <a href="{{ route('meetings.index', ['locale' => app()->getLocale()]) }}" class="inline-flex items-center space-x-1.5 text-xs sm:text-sm font-semibold text-[#0A66D6] hover:underline">
                <span>&larr;</span>
                <span>Back to All Meetings</span>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left Column: Meeting Content (8 Cols) -->
            <div class="lg:col-span-8 space-y-6">
                
                <!-- Header Card -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6">
                    <div class="flex items-center space-x-2 text-xs text-slate-500 mb-2">
                        <span class="font-bold text-[#062B52] bg-blue-50 px-2 py-0.5 rounded border border-blue-200 uppercase tracking-wider">
                            {{ $meeting->type }}
                        </span>
                        <span>&bull;</span>
                        <x-status-badge :status="$meeting->meeting_status" />
                    </div>

                    <h1 class="text-xl sm:text-2xl font-bold text-[#062B52] leading-tight mb-3">
                        {{ $meeting->getTitle() }}
                    </h1>

                    <div class="flex flex-wrap items-center gap-4 text-xs text-slate-600 pb-4 border-b border-slate-100">
                        <span><strong>{{ __('ui.date') }}:</strong> {{ $meeting->date?->format('l, d F Y') }}</span>
                        <span>&bull;</span>
                        <span><strong>{{ __('ui.location') }}:</strong> {{ $meeting->getLocation() }}</span>
                    </div>

                    <!-- Agenda Section -->
                    <div class="pt-5">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-slate-700 mb-2 flex items-center space-x-2">
                            <svg class="w-4 h-4 text-[#0A66D6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <span>{{ __('ui.agenda') }}</span>
                        </h2>
                        <div class="text-sm text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-md border border-slate-100 whitespace-pre-line">
                            {{ $meeting->agenda_en ?: '1. Review of ongoing capital works.\n2. Vetting of supplementary project budget allocations.\n3. Inspection timeline enforcement.' }}
                        </div>
                    </div>

                    <!-- Minutes of Proceedings -->
                    <div class="pt-5">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-slate-700 mb-2 flex items-center space-x-2">
                            <svg class="w-4 h-4 text-[#0A66D6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <span>{{ __('ui.minutes') }} & {{ __('ui.proceedings') }}</span>
                        </h2>
                        <div class="text-sm text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-md border border-slate-100 whitespace-pre-line">
                            {{ $meeting->minutes_en ?: 'Meeting commenced at 11:00 AM under the chairmanship of Principal Secretary. Field engineers presented milestone completion reports. Council approved the administrative sanctions unanimously.' }}
                        </div>
                    </div>

                    <!-- Resolutions Adopted -->
                    <div class="pt-5">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-slate-700 mb-2 flex items-center space-x-2">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ __('ui.resolutions') }}</span>
                        </h2>
                        <div class="text-sm text-slate-700 leading-relaxed bg-emerald-50/50 p-4 rounded-md border border-emerald-200/60 whitespace-pre-line">
                            {{ $meeting->resolutions_en ?: 'Resolved that all pending quality audit observations be rectified within 14 working days. Resolved that monthly drone surveillance reports be archived on the public GIS portal.' }}
                        </div>
                    </div>

                    <!-- Action Taken Report (ATR) -->
                    <div class="pt-5">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-slate-700 mb-2 flex items-center space-x-2">
                            <svg class="w-4 h-4 text-[#0A66D6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <span>{{ __('ui.action_taken_report') }}</span>
                        </h2>
                        <div class="text-sm text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-md border border-slate-100">
                            Action Taken Report (ATR) compiled by Vigilance & Technical Directorate. Compliance status achieved on 14 out of 16 actionable decisions. Supplementary ATR to be submitted at next Apex meeting.
                        </div>
                    </div>
                </div>

                <!-- Downloadable Documents -->
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-6">
                    <h2 class="text-base font-bold text-[#062B52] uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center space-x-2">
                        <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        <span>Official Signed Records</span>
                    </h2>

                    <div class="space-y-3">
                        <div class="p-3.5 bg-slate-50 rounded border border-slate-200 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <svg class="w-7 h-7 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <div>
                                    <h3 class="text-xs sm:text-sm font-semibold text-slate-800">Verified Minutes of Proceedings.pdf</h3>
                                    <span class="text-[11px] text-slate-500">Official Authenticated Record &bull; PDF &bull; 1.6 MB</span>
                                </div>
                            </div>
                            <a 
                                href="{{ asset('storage/documents/Meeting_Minutes_SEC_42.pdf') }}" 
                                target="_blank"
                                class="inline-flex items-center px-3 py-1.5 bg-[#0A66D6] hover:bg-blue-700 text-white text-xs font-semibold rounded shadow-sm transition"
                            >
                                {{ __('ui.download') }}
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column: Metadata & Notice (4 Cols) -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-5">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 pb-3 border-b border-slate-100 mb-3">
                        Session Metadata
                    </h3>
                    <dl class="divide-y divide-slate-100 text-xs">
                        <div class="py-2.5 flex justify-between">
                            <dt class="text-slate-500">Quorum Status</dt>
                            <dd class="font-semibold text-emerald-700">Fulfilled (18 Members)</dd>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <dt class="text-slate-500">Presided By</dt>
                            <dd class="font-medium text-slate-800">Principal Secretary</dd>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <dt class="text-slate-500">Published Date</dt>
                            <dd class="font-medium text-slate-800">{{ $meeting->published_at?->format('d M Y') }}</dd>
                        </div>
                        <div class="py-2.5 flex justify-between">
                            <dt class="text-slate-500">Classification</dt>
                            <dd class="font-bold text-[#062B52]">Public Disclosure</dd>
                        </div>
                    </dl>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
