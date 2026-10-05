@extends('layouts.app')

@section('title', __('ui.financial_disclosures'))

@section('breadcrumbs')
    <x-breadcrumbs :items="[
        ['label' => __('ui.financial_disclosures'), 'url' => '']
    ]" />
@endsection

@section('content')
<div class="py-8 sm:py-10 bg-slate-50 min-h-[75vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#062B52] tracking-tight">
                {{ __('ui.financial_disclosures') }}
            </h1>
            <p class="text-sm text-slate-600 mt-1">
                Statutory quarterly disclosures of budgetary receipts, capital expenditures, and project allocations.
            </p>
            <div class="h-1 w-14 bg-[#0A66D6] mt-2 rounded"></div>
        </div>

        <!-- Summary Metric Strip -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
            <!-- Total Receipts -->
            <div class="bg-white rounded-lg border border-slate-200 p-5 shadow-sm">
                <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">{{ __('ui.fund_receipts') }}</span>
                <span class="block text-2xl sm:text-3xl font-extrabold text-[#062B52]">
                    ₹{{ number_format($totalReceipts / 10000000, 2) }} Cr
                </span>
                <span class="text-[11px] text-slate-400 mt-1 block">Aggregated across filtered periods</span>
            </div>

            <!-- Total Expenditure -->
            <div class="bg-white rounded-lg border border-slate-200 p-5 shadow-sm">
                <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">{{ __('ui.expenditure') }}</span>
                <span class="block text-2xl sm:text-3xl font-extrabold text-emerald-700">
                    ₹{{ number_format($totalExpenditure / 10000000, 2) }} Cr
                </span>
                <span class="text-[11px] text-slate-400 mt-1 block">Capital and maintenance execution</span>
            </div>

            <!-- Total Project Allocation -->
            <div class="bg-white rounded-lg border border-slate-200 p-5 shadow-sm">
                <span class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">{{ __('ui.project_allocation') }}</span>
                <span class="block text-2xl sm:text-3xl font-extrabold text-[#0A66D6]">
                    ₹{{ number_format($totalAllocation / 10000000, 2) }} Cr
                </span>
                <span class="text-[11px] text-slate-400 mt-1 block">Sanctioned scheme commitments</span>
            </div>
        </div>

        <!-- Filter Toolbar -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm p-4 sm:p-5 mb-6">
            <form action="{{ route('financial.index', ['locale' => app()->getLocale()]) }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-3.5">
                
                <div>
                    <label for="year" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('ui.financial_year') }}</label>
                    <select name="year" id="year" class="w-full py-2 px-3 border border-slate-300 rounded-md text-xs sm:text-sm bg-white" onchange="this.form.submit()">
                        <option value="all">{{ __('ui.all') }} Years</option>
                        @foreach($years as $fy)
                            <option value="{{ $fy }}" {{ request('year') == $fy ? 'selected' : '' }}>FY {{ $fy }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="quarter" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('ui.quarter') }}</label>
                    <select name="quarter" id="quarter" class="w-full py-2 px-3 border border-slate-300 rounded-md text-xs sm:text-sm bg-white" onchange="this.form.submit()">
                        <option value="all">{{ __('ui.all') }} Quarters</option>
                        <option value="Q1" {{ request('quarter') === 'Q1' ? 'selected' : '' }}>Q1 (Apr - Jun)</option>
                        <option value="Q2" {{ request('quarter') === 'Q2' ? 'selected' : '' }}>Q2 (Jul - Sep)</option>
                        <option value="Q3" {{ request('quarter') === 'Q3' ? 'selected' : '' }}>Q3 (Oct - Dec)</option>
                        <option value="Q4" {{ request('quarter') === 'Q4' ? 'selected' : '' }}>Q4 (Jan - Mar)</option>
                    </select>
                </div>

                <div>
                    <label for="category" class="block text-xs font-semibold text-slate-700 mb-1">{{ __('ui.category') }}</label>
                    <select name="category" id="category" class="w-full py-2 px-3 border border-slate-300 rounded-md text-xs sm:text-sm bg-white" onchange="this.form.submit()">
                        <option value="all">{{ __('ui.all') }} Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full py-2 px-4 bg-[#0A66D6] hover:bg-blue-700 text-white font-semibold text-xs sm:text-sm rounded-md transition shadow-sm">
                        Filter Statements
                    </button>
                </div>

            </form>
        </div>

        <!-- Disclosures Accessible Table -->
        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-left text-xs sm:text-sm" aria-label="Financial Disclosures Table">
                    <thead class="bg-[#062B52] text-white">
                        <tr>
                            <th scope="col" class="py-3.5 px-4 font-semibold w-28">{{ __('ui.financial_year') }}</th>
                            <th scope="col" class="py-3.5 px-3 font-semibold w-24">{{ __('ui.quarter') }}</th>
                            <th scope="col" class="py-3.5 px-4 font-semibold">{{ __('ui.category') }}</th>
                            <th scope="col" class="py-3.5 px-4 font-semibold text-right">{{ __('ui.fund_receipts') }}</th>
                            <th scope="col" class="py-3.5 px-4 font-semibold text-right">{{ __('ui.expenditure') }}</th>
                            <th scope="col" class="py-3.5 px-4 font-semibold text-right">{{ __('ui.project_allocation') }}</th>
                            <th scope="col" class="py-3.5 px-4 font-semibold">{{ __('ui.remarks') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @forelse($records as $rec)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="py-3.5 px-4 font-mono font-bold text-slate-900 whitespace-nowrap">
                                    {{ $rec->financial_year }}
                                </td>
                                <td class="py-3.5 px-3 font-semibold text-[#0A66D6] whitespace-nowrap">
                                    {{ $rec->quarter }}
                                </td>
                                <td class="py-3.5 px-4 font-medium text-slate-800">
                                    {{ $rec->project_category }}
                                </td>
                                <td class="py-3.5 px-4 font-mono text-right text-slate-900 whitespace-nowrap">
                                    ₹{{ number_format($rec->fund_receipts / 10000000, 2) }} Cr
                                </td>
                                <td class="py-3.5 px-4 font-mono text-right text-emerald-700 font-semibold whitespace-nowrap">
                                    ₹{{ number_format($rec->expenditure / 10000000, 2) }} Cr
                                </td>
                                <td class="py-3.5 px-4 font-mono text-right text-[#062B52] font-semibold whitespace-nowrap">
                                    ₹{{ number_format($rec->project_allocation / 10000000, 2) }} Cr
                                </td>
                                <td class="py-3.5 px-4 text-xs text-slate-600 max-w-xs">
                                    {{ $rec->getRemarks() }}
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
        </div>

        <!-- Download Audited Statement -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center space-x-3">
                <svg class="w-8 h-8 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                <div>
                    <h3 class="text-sm font-bold text-[#062B52]">Comprehensive Audited Financial Statement (Q3 2025-26)</h3>
                    <p class="text-xs text-slate-600">Official statement with fund utilization certificates and CAG compliance endorsement.</p>
                </div>
            </div>
            <a 
                href="{{ asset('storage/documents/Quarterly_Financial_Report_Q3.pdf') }}" 
                target="_blank"
                class="inline-flex items-center px-4 py-2 bg-[#0A66D6] hover:bg-blue-700 text-white text-xs font-semibold rounded shadow-sm transition whitespace-nowrap"
            >
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                <span>Download Audited PDF</span>
            </a>
        </div>

    </div>
</div>
@endsection
