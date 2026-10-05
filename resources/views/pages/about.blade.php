@extends('layouts.app')

@section('title', __('ui.about_us'))

@section('breadcrumbs')
    <x-breadcrumbs :items="[
        ['label' => __('ui.about_us'), 'url' => '']
    ]" />
@endsection

@section('content')
<div class="py-8 sm:py-10 bg-slate-50 min-h-[75vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#062B52] tracking-tight">
                {{ __('ui.about_department') }}
            </h1>
            <p class="text-sm text-slate-600 mt-1">
                Apex government authority entrusted with capital asset development, public road connectivity, and sustainable infrastructure.
            </p>
            <div class="h-1 w-14 bg-[#0A66D6] mt-2 rounded"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Left: Main Content (8 cols) -->
            <div class="lg:col-span-8 space-y-6">
                
                <section class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm space-y-4">
                    <h2 class="text-lg font-bold text-[#062B52] pb-2 border-b border-slate-100">
                        Our Mission & Vision
                    </h2>
                    <p class="text-sm text-slate-700 leading-relaxed">
                        {{ __('ui.about_description') }}
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div class="p-4 bg-blue-50/70 border border-blue-100 rounded-md">
                            <h3 class="text-xs font-bold text-[#0A66D6] uppercase tracking-wider mb-1">Our Vision</h3>
                            <p class="text-xs text-slate-700 leading-relaxed">
                                To establish world-class, climate-resilient, and universally accessible public physical and digital infrastructure that empowers all citizens equally.
                            </p>
                        </div>
                        <div class="p-4 bg-emerald-50/70 border border-emerald-100 rounded-md">
                            <h3 class="text-xs font-bold text-emerald-800 uppercase tracking-wider mb-1">Our Mission</h3>
                            <p class="text-xs text-slate-700 leading-relaxed">
                                Complete transparency in public spending, strict enforcement of technical standards, and proactive digital citizen disclosures across all projects.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Core Mandates -->
                <section class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-[#062B52] pb-2 border-b border-slate-100 mb-4">
                        Key Responsibilities
                    </h2>
                    <ul class="space-y-3 text-xs text-slate-700">
                        <li class="flex items-start space-x-2">
                            <span class="text-[#0A66D6] font-bold">&bull;</span>
                            <span><strong>Highways & Arterial Corridors:</strong> Planning, 4-lane widening, maintenance, and bridge engineering across state road corridors.</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-[#0A66D6] font-bold">&bull;</span>
                            <span><strong>Public Administrative Complexes:</strong> Construction and energy retrofitting of civil court complexes, hospitals, and secretariats.</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-[#0A66D6] font-bold">&bull;</span>
                            <span><strong>Rural Connectivity:</strong> Execution of all-weather bituminous and concrete pavements linking remote farming communities.</span>
                        </li>
                        <li class="flex items-start space-x-2">
                            <span class="text-[#0A66D6] font-bold">&bull;</span>
                            <span><strong>Quality Assurance & Social Audits:</strong> Independent laboratory core sampling, drone video logging, and public grievance disposal.</span>
                        </li>
                    </ul>
                </section>

                <!-- Citizen Charter Download -->
                <section class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center space-x-3">
                        <svg class="w-8 h-8 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900">Department Citizen Charter 2026</h3>
                            <p class="text-xs text-slate-500">Service delivery timelines, grievance procedures, and official officer directories.</p>
                        </div>
                    </div>
                    <a href="{{ asset('storage/documents/Citizen_Charter_2026.pdf') }}" target="_blank" class="px-4 py-2 bg-[#0A66D6] hover:bg-blue-700 text-white text-xs font-semibold rounded shadow-sm transition whitespace-nowrap">
                        Download Charter
                    </a>
                </section>

            </div>

            <!-- Right Sidebar: Leadership (4 cols) -->
            <div class="lg:col-span-4 space-y-6">
                
                <div class="bg-white rounded-lg border border-slate-200 p-5 shadow-sm">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500 pb-3 border-b border-slate-100 mb-4">
                        Departmental Leadership
                    </h3>

                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center font-bold text-sm shrink-0">
                                PS
                            </div>
                            <div class="text-xs">
                                <span class="font-bold text-slate-900 block">Shri K. Ramanathan, IAS</span>
                                <span class="text-slate-500">Principal Secretary</span>
                                <span class="text-[11px] text-[#0A66D6] block">ps.infrastructure@example.gov.in</span>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center font-bold text-sm shrink-0">
                                CE
                            </div>
                            <div class="text-xs">
                                <span class="font-bold text-slate-900 block">Er. Sandeep Mukherjee</span>
                                <span class="text-slate-500">Engineer-in-Chief (Highways)</span>
                                <span class="text-[11px] text-[#0A66D6] block">einc.highways@example.gov.in</span>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center font-bold text-sm shrink-0">
                                CE
                            </div>
                            <div class="text-xs">
                                <span class="font-bold text-slate-900 block">Er. Sunita Deshmukh</span>
                                <span class="text-slate-500">Chief Engineer (Buildings & Design)</span>
                                <span class="text-[11px] text-[#0A66D6] block">ce.buildings@example.gov.in</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-[#031C36] text-white rounded-lg p-5">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-amber-300 mb-2">Notice for Rebranding</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        This prototype portal is designed with a completely generic architecture. All department titles, official names, statistics, and organizational data can be swapped seamlessly in the environment configuration and database.
                    </p>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
