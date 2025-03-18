<?php

namespace App\Http\Controllers;

use App\Models\CS_BillDetails;
use App\Models\CS_Cloths;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CS_DiscountReportController extends Controller
{

    /**
     * Generate a discount report view with filtered sales data.
     * Retrieves sales data where a discount was applied,
     * joins relevant tables to get item details, and filters data by date range if provided.
     */
    public function DiscountReport(Request $request)
    {
        $query = DB::table('sales as s')
            ->join('clothes_sizes_price_combination as cspc', 'cspc.id', '=', 's.item_id')
            ->join('clothes_sizes_combination as csc', 'csc.id', '=', 'cspc.combination_id')
            ->join('cloths as c', 'c.id', '=', 'csc.cloth_id')
            ->join('sizes as si', 'si.id', '=', 'csc.size_id')
            ->select('s.*', 'c.item_name', 'si.gender', 'si.common_formats')
            ->where('s.discount', '<>', 0);

        // Apply date range filter if provided
        if ($request->filled('date_range')) {
            $dates = explode(' - ', $request->date_range);

            // Ensure there are exactly two dates before applying filter
            if (count($dates) === 2) {
                try {
                    $startDate = Carbon::parse($dates[0])->startOfDay();
                    $endDate = Carbon::parse($dates[1])->endOfDay();

                    $query->whereBetween('s.created_at', [$startDate, $endDate]);
                } catch (\Exception $e) {
                    return redirect()->back()->with('error', 'Invalid date range format.');
                }
            }
        }

        $bills = $query->get();

        return view('dashboard/cs-sales-report/discount-report', [
            'bills' => $bills,
        ]);
    }

    /**
     * Filter discount report data and return as JSON.
     * Retrieves sales data with applied discounts, joins necessary tables,
     * and filters data by the provided date range.
     */
    public function filterDiscountReport(Request $request)
    {
        $query = DB::table('sales as s')
            ->join('clothes_sizes_price_combination as cspc', 'cspc.id', '=', 's.item_id')
            ->join('clothes_sizes_combination as csc', 'csc.id', '=', 'cspc.combination_id')
            ->join('cloths as c', 'c.id', '=', 'csc.cloth_id')
            ->join('sizes as si', 'si.id', '=', 'csc.size_id')
            ->select('s.*', 'c.item_name', 'si.gender', 'si.common_formats')
            ->where('s.discount', '<>', 0);


        // Apply date range filter if provided
        if ($request->has('date_range')) {
            $dates = explode(' - ', $request->date_range);
            $query->whereBetween('s.created_at', [$dates[0] . ' 00:00:00', $dates[1] . ' 23:59:59']);
        }

        return response()->json(['data' => $query->get()]);
    }


    /**
     * Export discount report data as a CSV file.
     * Retrieves sales data with applied discounts, joins necessary tables,
     * filters data based on date range if provided, and generates a downloadable CSV file.
     */
    public function exportDiscountReport(Request $request)
    {

        $query = DB::table('sales as s')
            ->join('clothes_sizes_price_combination as cspc', 'cspc.id', '=', 's.item_id')
            ->join('clothes_sizes_combination as csc', 'csc.id', '=', 'cspc.combination_id')
            ->join('cloths as c', 'c.id', '=', 'csc.cloth_id')
            ->join('sizes as si', 'si.id', '=', 'csc.size_id')
            ->select('s.*', 'c.item_name', 'si.gender', 'si.common_formats')
            ->where('s.discount', '<>', 0);


        if ($request->from_date != null && $request->to_date != null) {
            // Get from_date and to_date directly from the request
            $fromDate = $request->from_date . ' 00:00:00';
            $toDate = $request->to_date . ' 23:59:59';

            // Apply the whereBetween condition using from_date and to_date
            $query->whereBetween('s.created_at', [$fromDate, $toDate]);
        }


        $bills = $query->get();

        $response = new StreamedResponse(function () use ($bills) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Bill Number', 'Item Name', 'Size', 'Quantity', 'Price', 'Discount', 'Total', 'Created Date']);

            foreach ($bills as $bill) {
                fputcsv($handle, [
                    $bill->id,
                    $bill->item_name,
                    "{$bill->gender} ({$bill->common_formats})",
                    $bill->quantity,
                    $bill->price,
                    $bill->discount,
                    $bill->total,
                    $bill->created_at
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="discount-report.csv"');

        return $response;

    }

}
