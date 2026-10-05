<?php

namespace App\Http\Controllers;

use App\Models\FinancialDisclosure;
use Illuminate\Http\Request;

class FinancialDisclosureController extends Controller
{
    public function index(Request $request)
    {
        $query = FinancialDisclosure::published();

        if ($fy = $request->input('year')) {
            if ($fy !== 'all') {
                $query->where('financial_year', $fy);
            }
        }

        if ($q = $request->input('quarter')) {
            if ($q !== 'all') {
                $query->where('quarter', $q);
            }
        }

        if ($cat = $request->input('category')) {
            if ($cat !== 'all') {
                $query->where('project_category', $cat);
            }
        }

        $records = $query->latest('financial_year')->latest('quarter')->get();

        $totalReceipts = $records->sum('fund_receipts');
        $totalExpenditure = $records->sum('expenditure');
        $totalAllocation = $records->sum('project_allocation');

        $years = FinancialDisclosure::published()->distinct()->pluck('financial_year');
        $categories = FinancialDisclosure::published()->distinct()->pluck('project_category');

        return view('pages.financial.index', compact(
            'records', 'totalReceipts', 'totalExpenditure', 'totalAllocation', 'years', 'categories'
        ));
    }
}
