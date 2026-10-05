@extends('layouts.app')

@section('title', __('ui.right_to_information'))

@section('breadcrumbs')
    <x-breadcrumbs :items="[
        ['label' => __('ui.right_to_information'), 'url' => '']
    ]" />
@endsection

@section('content')
<div class="py-8 sm:py-10 bg-slate-50 min-h-[75vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#062B52] tracking-tight">
                {{ __('ui.right_to_information') }}
            </h1>
            <p class="text-sm text-slate-600 mt-1">
                Proactive public disclosures and statutory facilitation under Section 4(1)(b) of the Right to Information Act.
            </p>
            <div class="h-1 w-14 bg-[#0A66D6] mt-2 rounded"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Main Content (8 cols) -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- 1. RTI Overview -->
                <section class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-[#062B52] pb-3 border-b border-slate-100 mb-3 flex items-center space-x-2">
                        <svg class="w-5 h-5 text-[#0A66D6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ __('ui.rti_information') }}</span>
                    </h2>
                    <p class="text-sm text-slate-700 leading-relaxed">
                        The Right to Information Act empowers every citizen to obtain timely access to records, decisions, tender appraisals, and expenditure details maintained by public authorities. The Department of Public Infrastructure is fully committed to upholding maximum proactive transparency, publishing over 85% of operational data online voluntarily.
                    </p>
                </section>

                <!-- 2. Voluntary Proactive Disclosures (17 Manuals) -->
                <section class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-[#062B52] pb-3 border-b border-slate-100 mb-4 flex items-center space-x-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ __('ui.voluntary_disclosures') }} (Section 4(1)(b))</span>
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <div class="p-3 bg-slate-50 rounded border border-slate-100">
                            <span class="font-bold text-slate-900 block mb-1">Manual 1: Particulars of Organization</span>
                            <span class="text-slate-500">Functions, administrative duties and organizational chart.</span>
                        </div>
                        <div class="p-3 bg-slate-50 rounded border border-slate-100">
                            <span class="font-bold text-slate-900 block mb-1">Manual 2: Powers of Officers</span>
                            <span class="text-slate-500">Financial, technical sanction and administrative powers.</span>
                        </div>
                        <div class="p-3 bg-slate-50 rounded border border-slate-100">
                            <span class="font-bold text-slate-900 block mb-1">Manual 3: Decision Making Process</span>
                            <span class="text-slate-500">Supervision channels and standard operating workflows.</span>
                        </div>
                        <div class="p-3 bg-slate-50 rounded border border-slate-100">
                            <span class="font-bold text-slate-900 block mb-1">Manual 4: Norms for Discharge of Functions</span>
                            <span class="text-slate-500">Turnaround times and citizen delivery charters.</span>
                        </div>
                        <div class="p-3 bg-slate-50 rounded border border-slate-100">
                            <span class="font-bold text-slate-900 block mb-1">Manual 5: Acts, Regulations and Rules</span>
                            <span class="text-slate-500">Manuals and codes used by engineering divisions.</span>
                        </div>
                        <div class="p-3 bg-slate-50 rounded border border-slate-100">
                            <span class="font-bold text-slate-900 block mb-1">Manual 11: Budgetary Allocations</span>
                            <span class="text-slate-500">Plans, proposed expenditures and disbursement reports.</span>
                        </div>
                    </div>
                </section>

                <!-- 3. RTI Procedures & How to Apply -->
                <section class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-[#062B52] pb-3 border-b border-slate-100 mb-4 flex items-center space-x-2">
                        <svg class="w-5 h-5 text-[#0A66D6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ __('ui.rti_procedures') }}</span>
                    </h2>

                    <ol class="space-y-3 text-xs text-slate-700 list-decimal list-inside">
                        <li class="pl-1">
                            <strong>Submit Application:</strong> Address your request in writing or electronically through the State RTI Online portal to the Central Public Information Officer (CPIO).
                        </li>
                        <li class="pl-1">
                            <strong>Fee Deposit:</strong> Pay statutory application fee of INR 10 via Indian Postal Order (IPO), Demand Draft, or digital payment gateway. Below Poverty Line (BPL) cardholders are exempt from application fees.
                        </li>
                        <li class="pl-1">
                            <strong>Disposal Timeline:</strong> Information shall be provided within 30 days of receipt (or 48 hours where liberty or life is concerned).
                        </li>
                        <li class="pl-1">
                            <strong>Appeals:</strong> If information is not received or dissatisfied with the response, an appeal may be filed within 30 days before the First Appellate Authority (FAA).
                        </li>
                    </ol>
                </section>

                <!-- 4. Useful Downloads -->
                <section class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-[#062B52] pb-3 border-b border-slate-100 mb-4 flex items-center space-x-2">
                        <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ __('ui.useful_downloads') }}</span>
                    </h2>

                    <div class="space-y-3">
                        <div class="p-3 bg-slate-50 rounded border border-slate-200 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <div>
                                    <span class="text-xs font-semibold text-slate-900 block">Proactive Disclosure Manual (Section 4-1-b).pdf</span>
                                    <span class="text-[11px] text-slate-500">Complete Statutory Manual &bull; 1.6 MB &bull; PDF</span>
                                </div>
                            </div>
                            <a href="{{ asset('storage/documents/RTI_Proactive_Disclosure_Manual.pdf') }}" target="_blank" class="px-3 py-1 bg-[#0A66D6] hover:bg-blue-700 text-white text-xs font-semibold rounded transition">
                                Download
                            </a>
                        </div>
                    </div>
                </section>

            </div>

            <!-- Right Sidebar: Officers & Contacts (4 cols) -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Central Public Information Officer (CPIO) -->
                <div class="bg-white rounded-lg border border-slate-200 p-5 shadow-sm">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-[#0A66D6] bg-blue-50 px-2 py-0.5 rounded">
                        Designated Authority
                    </span>
                    <h3 class="text-sm font-bold text-[#062B52] mt-2 mb-3">
                        {{ __('ui.public_information_officer') }} (CPIO)
                    </h3>
                    <div class="text-xs space-y-1.5 text-slate-700">
                        <p class="font-bold text-slate-900">Dr. Vivek Narang</p>
                        <p class="text-slate-500">Deputy Secretary (Public Works & Disclosures)</p>
                        <p>Block 4, 2nd Floor, Secretariat Complex</p>
                        <p>Phone: +91-11-2309-8822</p>
                        <p class="text-[#0A66D6]">Email: cpio.infrastructure@example.gov.in</p>
                    </div>
                </div>

                <!-- First Appellate Authority (FAA) -->
                <div class="bg-white rounded-lg border border-slate-200 p-5 shadow-sm">
                    <span class="text-[11px] font-bold uppercase tracking-wider text-amber-800 bg-amber-50 px-2 py-0.5 rounded">
                        Appellate Forum
                    </span>
                    <h3 class="text-sm font-bold text-[#062B52] mt-2 mb-3">
                        First Appellate Authority (FAA)
                    </h3>
                    <div class="text-xs space-y-1.5 text-slate-700">
                        <p class="font-bold text-slate-900">Smt. Meenakshi Sundaram, IAS</p>
                        <p class="text-slate-500">Special Secretary (Infrastructure Development)</p>
                        <p>Room 304, Main Secretariat Wing</p>
                        <p>Phone: +91-11-2309-8803</p>
                        <p class="text-[#0A66D6]">Email: faa.infrastructure@example.gov.in</p>
                    </div>
                </div>

                <!-- Citizen Facilitation Center -->
                <div class="bg-[#062B52] text-white rounded-lg p-5">
                    <h3 class="text-sm font-bold mb-2">RTI Facilitation Counter</h3>
                    <p class="text-xs text-slate-300 leading-relaxed mb-3">
                        Visit the Ground Floor Public Facilitation Counter for physical RTI form collection and fee deposition.
                    </p>
                    <span class="text-[11px] text-amber-300 block">Timings: 10:00 AM - 13:00 PM (Working Days)</span>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
