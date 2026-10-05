@extends('layouts.app')

@section('title', __('ui.meeting_archive'))

@section('breadcrumbs')
    <x-breadcrumbs :items="[
        ['label' => __('ui.meetings'), 'url' => '']
    ]" />
@endsection

@section('content')
<div class="py-8 sm:py-10 bg-slate-50 min-h-[75vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#062B52] tracking-tight">
                {{ __('ui.meeting_archive') }}
            </h1>
            <p class="text-sm text-slate-600 mt-1">
                Official records of departmental review meetings, technical vetting sessions, and public hearings.
            </p>
            <div class="h-1 w-14 bg-[#0A66D6] mt-2 rounded"></div>
        </div>

        <!-- Filter Toolbar -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-4 sm:p-5 mb-6">
            <form action="{{ route('meetings.index', ['locale' => app()->getLocale()]) }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5">
                
                <div>
                    <label for="type" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('ui.meeting_type') }}</label>
                    <select name="type" id="type" class="w-full py-2 px-3 border border-slate-300 rounded-md text-xs sm:text-sm bg-white" onchange="this.form.submit()">
                        <option value="all">{{ __('ui.all') }} Types</option>
                        <option value="departmental" {{ request('type') === 'departmental' ? 'selected' : '' }}>Departmental</option>
                        <option value="review" {{ request('type') === 'review' ? 'selected' : '' }}>Apex Review</option>
                        <option value="special" {{ request('type') === 'special' ? 'selected' : '' }}>Special Committee</option>
                        <option value="public" {{ request('type') === 'public' ? 'selected' : '' }}>Public Hearing</option>
                    </select>
                </div>

                <div>
                    <label for="meeting_status" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('ui.status') }}</label>
                    <select name="meeting_status" id="meeting_status" class="w-full py-2 px-3 border border-slate-300 rounded-md text-xs sm:text-sm bg-white" onchange="this.form.submit()">
                        <option value="all">{{ __('ui.all') }} Statuses</option>
                        <option value="completed" {{ request('meeting_status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="scheduled" {{ request('meeting_status') === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                    </select>
                </div>

                <div>
                    <label for="year" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('ui.year') }}</label>
                    <select name="year" id="year" class="w-full py-2 px-3 border border-slate-300 rounded-md text-xs sm:text-sm bg-white" onchange="this.form.submit()">
                        <option value="all">{{ __('ui.all') }} Years</option>
                        @foreach($years as $yr)
                            <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full py-2 px-4 bg-[#0A66D6] hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm rounded-md transition shadow-sm">
                        Filter Meetings
                    </button>
                </div>

            </form>
        </div>

        <!-- Meetings List -->
        <div class="space-y-4">
            @forelse($meetings as $meeting)
                <div class="bg-white rounded-lg border border-slate-200 p-5 shadow-sm hover:border-[#0A66D6] transition card-hover flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="space-y-1.5 max-w-3xl">
                        <div class="flex items-center space-x-2 text-xs text-slate-500">
                            <span class="font-bold text-[#062B52] bg-blue-50 px-2 py-0.5 rounded border border-blue-200 uppercase tracking-wider">
                                {{ $meeting->type }}
                            </span>
                            <span>&bull;</span>
                            <time datetime="{{ $meeting->date?->toDateString() }}" class="font-medium text-slate-700">
                                {{ $meeting->date?->format('l, d F Y') }}
                            </time>
                            <span>&bull;</span>
                            <x-status-badge :status="$meeting->meeting_status" />
                        </div>

                        <h2 class="text-base font-bold text-slate-900 leading-snug">
                            <a href="{{ route('meetings.show', ['locale' => app()->getLocale(), 'slug' => $meeting->slug]) }}" class="hover:text-[#0A66D6]">
                                {{ $meeting->getTitle() }}
                            </a>
                        </h2>

                        <p class="text-xs text-slate-600 flex items-center space-x-1.5">
                            <svg class="w-3.5 h-3.5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>{{ $meeting->getLocation() ?: 'Secretariat Conference Room' }}</span>
                        </p>
                    </div>

                    <div class="shrink-0 flex items-center space-x-3">
                        <a 
                            href="{{ route('meetings.show', ['locale' => app()->getLocale(), 'slug' => $meeting->slug]) }}" 
                            class="inline-flex items-center px-4 py-2 bg-[#0A66D6] hover:bg-blue-700 text-white text-xs font-semibold rounded shadow-sm transition"
                        >
                            <span>View Proceedings & Minutes</span>
                            <span class="ml-1.5">&rarr;</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center bg-white rounded-lg border border-slate-200 text-slate-500 text-sm">
                    {{ __('ui.no_results') }}
                </div>
            @endforelse
        </div>

        @if($meetings->hasPages())
            <div class="pt-6">
                {{ $meetings->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
