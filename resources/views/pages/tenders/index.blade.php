@extends('layouts.app')

@section('title', __('ui.tenders'))

@section('breadcrumbs')
    <x-breadcrumbs :items="[
        ['label' => __('ui.tenders'), 'url' => '']
    ]" />
@endsection

@section('content')
<div class="py-8 sm:py-10 bg-slate-50 min-h-[75vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#062B52] tracking-tight">
                {{ __('ui.latest_tenders') }}
            </h1>
            <p class="text-sm text-slate-600 mt-1">
                Official electronic procurement notices, requests for proposals (RFPs), and bids invited by the Department.
            </p>
            <div class="h-1 w-14 bg-[#0A66D6] mt-2 rounded"></div>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-4 sm:p-5 mb-6">
            <form action="{{ route('tenders.index', ['locale' => app()->getLocale()]) }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3.5">
                
                <!-- Search Keyword -->
                <div class="lg:col-span-2">
                    <label for="search" class="block text-xs font-semibold text-slate-700 mb-1">Keyword / Tender No.</label>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="search" 
                            id="search"
                            value="{{ request('search') }}"
                            placeholder="e.g. TPI/2026/001 or Highway" 
                            class="w-full pl-3 pr-9 py-2 border border-slate-300 rounded-md text-xs sm:text-sm text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-[#0A66D6] focus:border-transparent"
                        />
                        @if(request('search'))
                            <a href="{{ route('tenders.index', ['locale' => app()->getLocale()]) }}" class="absolute right-2.5 top-2.5 text-slate-400 hover:text-slate-600 text-xs font-bold">&times;</a>
                        @endif
                    </div>
                </div>

                <!-- Status Filter -->
                <div>
                    <label for="status" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('ui.status') }}</label>
                    <select 
                        name="status" 
                        id="status" 
                        class="w-full py-2 px-3 border border-slate-300 rounded-md text-xs sm:text-sm text-slate-800 focus:ring-2 focus:ring-[#0A66D6] focus:border-transparent bg-white"
                        onchange="this.form.submit()"
                    >
                        <option value="all">{{ __('ui.all') }} Statuses</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>{{ __('ui.active') }}</option>
                        <option value="closing_soon" {{ request('status') === 'closing_soon' ? 'selected' : '' }}>{{ __('ui.closing_soon') }}</option>
                        <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>{{ __('ui.upcoming') }}</option>
                        <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>{{ __('ui.closed') }}</option>
                    </select>
                </div>

                <!-- Category Filter -->
                <div>
                    <label for="category" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('ui.category') }}</label>
                    <select 
                        name="category" 
                        id="category" 
                        class="w-full py-2 px-3 border border-slate-300 rounded-md text-xs sm:text-sm text-slate-800 focus:ring-2 focus:ring-[#0A66D6] focus:border-transparent bg-white"
                        onchange="this.form.submit()"
                    >
                        <option value="all">{{ __('ui.all') }} Categories</option>
                        <option value="works" {{ request('category') === 'works' ? 'selected' : '' }}>Civil Works</option>
                        <option value="goods" {{ request('category') === 'goods' ? 'selected' : '' }}>Goods & Supply</option>
                        <option value="services" {{ request('category') === 'services' ? 'selected' : '' }}>Services & IT</option>
                        <option value="consultancy" {{ request('category') === 'consultancy' ? 'selected' : '' }}>Consultancy</option>
                    </select>
                </div>

                <!-- Filter Actions -->
                <div class="flex items-end space-x-2">
                    <button type="submit" class="w-full py-2 px-4 bg-[#0A66D6] hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm rounded-md transition shadow-sm">
                        Filter
                    </button>
                    @if(request()->hasAny(['search', 'status', 'category', 'year']))
                        <a href="{{ route('tenders.index', ['locale' => app()->getLocale()]) }}" class="py-2 px-3 bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold text-xs sm:text-sm rounded-md transition text-center whitespace-nowrap">
                            Reset
                        </a>
                    @endif
                </div>

            </form>
        </div>

        <!-- Tenders Table for Desktop -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden mb-6">
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-left text-xs sm:text-sm" aria-label="Tenders List">
                    <thead class="bg-[#062B52] text-white">
                        <tr>
                            <th scope="col" class="py-3.5 px-4 font-semibold w-32">{{ __('ui.tender_number') }}</th>
                            <th scope="col" class="py-3.5 px-4 font-semibold">{{ __('ui.title') }}</th>
                            <th scope="col" class="py-3.5 px-3 font-semibold w-28">{{ __('ui.published_date') }}</th>
                            <th scope="col" class="py-3.5 px-3 font-semibold w-28">{{ __('ui.closing_date') }}</th>
                            <th scope="col" class="py-3.5 px-3 font-semibold w-28">{{ __('ui.status') }}</th>
                            <th scope="col" class="py-3.5 px-4 font-semibold w-24 text-center">{{ __('ui.documents') }}</th>
                            <th scope="col" class="py-3.5 px-4 font-semibold w-28 text-right">{{ __('ui.action') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($tenders as $tender)
                            <tr class="hover:bg-slate-50 transition">
                                <!-- Tender Number -->
                                <td class="py-4 px-4 font-mono font-bold text-[#062B52] whitespace-nowrap">
                                    {{ $tender->tender_number }}
                                </td>

                                <!-- Title & Category -->
                                <td class="py-4 px-4">
                                    <a 
                                        href="{{ route('tenders.show', ['locale' => app()->getLocale(), 'slug' => $tender->slug]) }}" 
                                        class="font-semibold text-slate-900 hover:text-[#0A66D6] transition block leading-snug"
                                    >
                                        {{ $tender->getTitle() }}
                                    </a>
                                    <span class="inline-block mt-1 text-[11px] font-medium text-slate-500 uppercase tracking-wider bg-slate-100 px-2 py-0.5 rounded">
                                        {{ $tender->category }}
                                    </span>
                                </td>

                                <!-- Published Date -->
                                <td class="py-4 px-3 text-slate-600 whitespace-nowrap text-xs">
                                    {{ $tender->published_date?->format('d/m/Y') }}
                                </td>

                                <!-- Closing Date -->
                                <td class="py-4 px-3 text-slate-900 font-semibold whitespace-nowrap text-xs">
                                    {{ $tender->closing_date?->format('d/m/Y') }}
                                </td>

                                <!-- Status Badge -->
                                <td class="py-4 px-3 whitespace-nowrap">
                                    <x-status-badge :status="$tender->tender_status" />
                                </td>

                                <!-- Documents Count -->
                                <td class="py-4 px-4 text-center whitespace-nowrap">
                                    <span class="inline-flex items-center text-xs font-semibold text-slate-600 bg-slate-100 px-2 py-1 rounded">
                                        <svg class="w-3.5 h-3.5 text-rose-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                        3 Docs
                                    </span>
                                </td>

                                <!-- Action Buttons -->
                                <td class="py-4 px-4 text-right whitespace-nowrap">
                                    <a 
                                        href="{{ route('tenders.show', ['locale' => app()->getLocale(), 'slug' => $tender->slug]) }}" 
                                        class="inline-flex items-center px-3 py-1.5 bg-[#0A66D6] hover:bg-blue-700 text-white text-xs font-semibold rounded transition shadow-sm"
                                    >
                                        {{ __('ui.view') }} &rarr;
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-8 text-center text-slate-500 text-sm">
                                    {{ __('ui.no_results') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards View -->
            <div class="md:hidden divide-y divide-slate-200">
                @forelse($tenders as $tender)
                    <div class="p-4 space-y-2.5">
                        <div class="flex items-center justify-between">
                            <span class="font-mono font-bold text-xs text-[#062B52] bg-blue-50 px-2 py-0.5 rounded border border-blue-200">
                                {{ $tender->tender_number }}
                            </span>
                            <x-status-badge :status="$tender->tender_status" />
                        </div>

                        <h3 class="text-sm font-semibold text-slate-900 leading-snug">
                            <a href="{{ route('tenders.show', ['locale' => app()->getLocale(), 'slug' => $tender->slug]) }}" class="hover:text-[#0A66D6]">
                                {{ $tender->getTitle() }}
                            </a>
                        </h3>

                        <div class="grid grid-cols-2 gap-2 text-xs text-slate-500 pt-1">
                            <div>
                                <span class="block text-[11px] text-slate-400">Published</span>
                                <span class="font-medium text-slate-700">{{ $tender->published_date?->format('d M Y') }}</span>
                            </div>
                            <div>
                                <span class="block text-[11px] text-slate-400">Closing Date</span>
                                <strong class="text-slate-900 font-semibold">{{ $tender->closing_date?->format('d M Y') }}</strong>
                            </div>
                        </div>

                        <div class="pt-2 flex items-center justify-between border-t border-slate-100">
                            <span class="text-xs text-slate-500 capitalize">{{ $tender->category }}</span>
                            <a 
                                href="{{ route('tenders.show', ['locale' => app()->getLocale(), 'slug' => $tender->slug]) }}" 
                                class="inline-flex items-center text-xs font-semibold text-[#0A66D6] hover:underline"
                            >
                                <span>{{ __('ui.view') }} Tender Details</span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-slate-500 text-sm">
                        {{ __('ui.no_results') }}
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        @if($tenders->hasPages())
            <div class="py-2">
                {{ $tenders->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
