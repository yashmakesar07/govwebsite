@extends('layouts.app')

@section('title', __('ui.acts_rules_guidelines'))

@section('breadcrumbs')
    <x-breadcrumbs :items="[
        ['label' => __('ui.acts_rules_guidelines'), 'url' => '']
    ]" />
@endsection

@section('content')
<div class="py-8 sm:py-10 bg-slate-50 min-h-[75vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#062B52] tracking-tight">
                {{ __('ui.acts_rules_guidelines') }}
            </h1>
            <p class="text-sm text-slate-600 mt-1">
                Official statutory repository of legislation, executive rules, technical circulars, and regulatory codes.
            </p>
            <div class="h-1 w-14 bg-[#0A66D6] mt-2 rounded"></div>
        </div>

        <!-- Filter Toolbar -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-4 sm:p-5 mb-6">
            <form action="{{ route('acts.index', ['locale' => app()->getLocale()]) }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3.5">
                
                <!-- Search Keyword -->
                <div class="lg:col-span-2">
                    <label for="search" class="block text-xs font-semibold text-slate-700 mb-1">Search Legislation</label>
                    <input 
                        type="text" 
                        name="search" 
                        id="search"
                        value="{{ request('search') }}"
                        placeholder="e.g. Procurement or Guidelines" 
                        class="w-full px-3 py-2 border border-slate-300 rounded-md text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#0A66D6] focus:border-transparent"
                    />
                </div>

                <!-- Type Filter -->
                <div>
                    <label for="type" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('ui.document_type') }}</label>
                    <select 
                        name="type" 
                        id="type" 
                        class="w-full py-2 px-3 border border-slate-300 rounded-md text-xs sm:text-sm text-slate-800 focus:ring-2 focus:ring-[#0A66D6] focus:border-transparent bg-white"
                        onchange="this.form.submit()"
                    >
                        <option value="all">{{ __('ui.all') }} Types</option>
                        <option value="act" {{ request('type') === 'act' ? 'selected' : '' }}>Statutory Act</option>
                        <option value="rule" {{ request('type') === 'rule' ? 'selected' : '' }}>Executive Rule</option>
                        <option value="guideline" {{ request('type') === 'guideline' ? 'selected' : '' }}>Guideline</option>
                        <option value="regulation" {{ request('type') === 'regulation' ? 'selected' : '' }}>Regulation / Code</option>
                    </select>
                </div>

                <!-- Year Filter -->
                <div>
                    <label for="year" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('ui.year') }}</label>
                    <select 
                        name="year" 
                        id="year" 
                        class="w-full py-2 px-3 border border-slate-300 rounded-md text-xs sm:text-sm text-slate-800 focus:ring-2 focus:ring-[#0A66D6] focus:border-transparent bg-white"
                        onchange="this.form.submit()"
                    >
                        <option value="all">{{ __('ui.all') }} Years</option>
                        @foreach($years as $yr)
                            <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Language Filter -->
                <div>
                    <label for="language" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('ui.language') }}</label>
                    <select 
                        name="language" 
                        id="language" 
                        class="w-full py-2 px-3 border border-slate-300 rounded-md text-xs sm:text-sm text-slate-800 focus:ring-2 focus:ring-[#0A66D6] focus:border-transparent bg-white"
                        onchange="this.form.submit()"
                    >
                        <option value="all">{{ __('ui.all') }} Languages</option>
                        <option value="english" {{ request('language') === 'english' ? 'selected' : '' }}>English</option>
                        <option value="hindi" {{ request('language') === 'hindi' ? 'selected' : '' }}>Hindi</option>
                        <option value="bilingual" {{ request('language') === 'bilingual' ? 'selected' : '' }}>Bilingual</option>
                    </select>
                </div>

            </form>
        </div>

        <!-- Desktop Table / Document Repository -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden mb-6">
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-left text-xs sm:text-sm" aria-label="Acts and Rules Repository">
                    <thead class="bg-[#062B52] text-white">
                        <tr>
                            <th scope="col" class="py-3.5 px-4 font-semibold">{{ __('ui.document_name') }}</th>
                            <th scope="col" class="py-3.5 px-3 font-semibold w-28">{{ __('ui.document_type') }}</th>
                            <th scope="col" class="py-3.5 px-3 font-semibold w-20 text-center">{{ __('ui.year') }}</th>
                            <th scope="col" class="py-3.5 px-3 font-semibold w-24 text-center">{{ __('ui.language') }}</th>
                            <th scope="col" class="py-3.5 px-3 font-semibold w-28">{{ __('ui.last_updated') }}</th>
                            <th scope="col" class="py-3.5 px-4 font-semibold w-28 text-right">{{ __('ui.download') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($acts as $act)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="py-4 px-4">
                                    <div class="font-semibold text-slate-900 leading-snug">
                                        {{ $act->getTitle() }}
                                    </div>
                                    <p class="text-xs text-slate-500 mt-0.5 line-clamp-1">
                                        {{ $act->getDescription() }}
                                    </p>
                                </td>

                                <td class="py-4 px-3 text-xs capitalize text-slate-700">
                                    <span class="inline-block bg-slate-100 text-slate-700 px-2 py-0.5 rounded font-medium">
                                        {{ $act->type }}
                                    </span>
                                </td>

                                <td class="py-4 px-3 text-center text-xs font-mono font-semibold text-slate-700">
                                    {{ $act->year }}
                                </td>

                                <td class="py-4 px-3 text-center text-xs text-slate-600 capitalize">
                                    {{ $act->language }}
                                </td>

                                <td class="py-4 px-3 text-xs text-slate-500 whitespace-nowrap">
                                    {{ $act->published_at?->format('d M Y') }}
                                </td>

                                <td class="py-4 px-4 text-right whitespace-nowrap">
                                    @if($act->file_path)
                                        <a 
                                            href="{{ asset('storage/' . $act->file_path) }}" 
                                            target="_blank"
                                            class="inline-flex items-center space-x-1 px-2.5 py-1.5 bg-[#0A66D6] hover:bg-blue-700 text-white text-xs font-semibold rounded shadow-sm transition"
                                        >
                                            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                            </svg>
                                            <span>PDF</span>
                                        </a>
                                    @else
                                        <span class="text-slate-400 text-xs">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-slate-500 text-sm">
                                    {{ __('ui.no_results') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile View: Cards -->
            <div class="md:hidden divide-y divide-slate-200">
                @forelse($acts as $act)
                    <div class="p-4 space-y-2">
                        <div class="flex items-center justify-between text-xs text-slate-500">
                            <span class="uppercase tracking-wider font-semibold bg-slate-100 text-slate-700 px-2 py-0.5 rounded">
                                {{ $act->type }} &bull; {{ $act->year }}
                            </span>
                            <span class="capitalize">{{ $act->language }}</span>
                        </div>

                        <h3 class="text-sm font-semibold text-slate-900 leading-snug">
                            {{ $act->getTitle() }}
                        </h3>

                        <p class="text-xs text-slate-600 line-clamp-2">
                            {{ $act->getDescription() }}
                        </p>

                        <div class="pt-2 flex items-center justify-between border-t border-slate-100">
                            <span class="text-[11px] text-slate-400">{{ $act->published_at?->format('d M Y') }}</span>
                            @if($act->file_path)
                                <a 
                                    href="{{ asset('storage/' . $act->file_path) }}" 
                                    target="_blank"
                                    class="inline-flex items-center space-x-1 text-xs font-semibold text-[#0A66D6] hover:underline"
                                >
                                    <span>Download PDF</span>
                                    <span>&rarr;</span>
                                </a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-slate-500 text-sm">
                        {{ __('ui.no_results') }}
                    </div>
                @endforelse
            </div>
        </div>

        @if($acts->hasPages())
            <div class="py-2">
                {{ $acts->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
