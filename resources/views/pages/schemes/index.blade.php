@extends('layouts.app')

@section('title', __('ui.government_schemes'))

@section('breadcrumbs')
    <x-breadcrumbs :items="[
        ['label' => __('ui.government_schemes'), 'url' => '']
    ]" />
@endsection

@section('content')
<div class="py-8 sm:py-10 bg-slate-50 min-h-[75vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#062B52] tracking-tight">
                {{ __('ui.government_schemes') }}
            </h1>
            <p class="text-sm text-slate-600 mt-1">
                Welfare programs, capital infrastructure initiatives, and inclusive development schemes undertaken by the Department.
            </p>
            <div class="h-1 w-14 bg-[#0A66D6] mt-2 rounded"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($schemes as $scheme)
                <div class="bg-white rounded-lg border border-slate-200 overflow-hidden shadow-sm flex flex-col justify-between card-hover">
                    <div>
                        <div class="relative h-48 bg-slate-100 overflow-hidden">
                            <img 
                                src="{{ asset($scheme->image_path ?: 'assets/images/scheme-rural.svg') }}" 
                                alt="{{ $scheme->getTitle() }}"
                                class="w-full h-full object-cover" 
                            />
                            <div class="absolute top-3 right-3">
                                <x-status-badge :status="$scheme->scheme_status" />
                            </div>
                        </div>

                        <div class="p-5">
                            <h2 class="text-lg font-bold text-[#062B52] mb-2 leading-snug">
                                <a href="{{ route('schemes.show', ['locale' => app()->getLocale(), 'slug' => $scheme->slug]) }}" class="hover:text-[#0A66D6]">
                                    {{ $scheme->getTitle() }}
                                </a>
                            </h2>
                            
                            <p class="text-xs text-slate-600 line-clamp-3 mb-4 leading-relaxed">
                                {{ $scheme->getDescription() }}
                            </p>

                            <!-- Implementation Progress -->
                            <div class="space-y-1.5 bg-slate-50 p-3 rounded-md border border-slate-100 mb-3">
                                <div class="flex items-center justify-between text-xs font-semibold">
                                    <span class="text-slate-600">{{ __('ui.implementation_progress') }}</span>
                                    <span class="text-[#0A66D6] font-bold">{{ $scheme->progress_percentage }}%</span>
                                </div>
                                <div class="w-full h-2 bg-slate-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-[#0A66D6] rounded-full" style="width: {{ $scheme->progress_percentage }}%;"></div>
                                </div>
                            </div>

                            <!-- Financial Summary -->
                            <div class="flex justify-between items-center text-xs text-slate-500 pt-2 border-t border-slate-100">
                                <span>Budget: <strong class="text-slate-800">₹{{ number_format($scheme->financial_allocation / 10000000, 1) }} Cr</strong></span>
                                <span>Beneficiaries: <strong class="text-slate-800">{{ number_format($scheme->beneficiaries_count) }}+</strong></span>
                            </div>
                        </div>
                    </div>

                    <div class="px-5 py-3 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-slate-500">Updated {{ $scheme->published_at?->format('d M Y') }}</span>
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
</div>
@endsection
