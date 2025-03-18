<?php

namespace App\Http\Controllers;

use App\Models\CS_Cloths;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CS_StockReportsController extends Controller
{
    /**
     * Generates a report of the current stock of clothes.
     *
     * This function retrieves the current stock of clothes, optionally filters by a date range,
     * and then returns the result to be displayed on the 'current-stock-report' view.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function currentStockReport(Request $request)
    {
        $query = DB::table('cloths as c')
            ->join('clothes_sizes_combination as csc', 'csc.cloth_id', '=', 'c.id')
            ->join('sizes as s', 's.id', '=', 'csc.size_id')
            ->join('colors as cr', 'cr.id', '=', 'c.color_id')
            ->join('categories as ca', 'ca.id', '=', 'c.category_id')
            ->select(
                'c.item_name',
                'c.created_at',
                'csc.quantity',
                's.common_formats',
                's.gender',
                'cr.color_name',
                'ca.category_name'
            );

        // Apply date range filter if provided
        if ($request->has('date_range')) {
            $dates = explode(' - ', $request->date_range);
            $query->whereBetween('c.created_at', [$dates[0] . ' 00:00:00', $dates[1] . ' 23:59:59']);
        }

        $clothes = $query->get();

        return view('dashboard.cs-stock-report.current-stock-report', compact('clothes'));
    }

    /**
     * Filters the stock report based on the given criteria.
     *
     * This function allows filtering of the stock report based on the provided request parameters
     * and returns the filtered result as a JSON response.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterStockReport(Request $request)
    {
        $query = DB::table('cloths as c')
            ->join('clothes_sizes_combination as csc', 'csc.cloth_id', '=', 'c.id')
            ->join('sizes as s', 's.id', '=', 'csc.size_id')
            ->join('colors as cr', 'cr.id', '=', 'c.color_id')
            ->join('categories as ca', 'ca.id', '=', 'c.category_id')
            ->select(
                'c.item_name',
                'c.created_at',
                'csc.quantity',
                's.common_formats',
                's.gender',
                'cr.color_name',
                'ca.category_name'
            );

        if ($request->has('date_range')) {
            $dates = explode(' - ', $request->date_range);
            $query->whereBetween('c.created_at', [$dates[0] . ' 00:00:00', $dates[1] . ' 23:59:59']);
        }

        return response()->json(['data' => $query->get()]);
    }

    /**
     * Exports the stock report to a CSV file.
     *
     * This function retrieves the stock report data, optionally filters by date range, and then
     * streams the results as a CSV file for download.
     *
     * @param Request $request
     * @return StreamedResponse
     */
    public function exportStockReport(Request $request)
    {
        $query = DB::table('cloths as c')
            ->join('clothes_sizes_combination as csc', 'csc.cloth_id', '=', 'c.id')
            ->join('sizes as s', 's.id', '=', 'csc.size_id')
            ->join('colors as cr', 'cr.id', '=', 'c.color_id')
            ->join('categories as ca', 'ca.id', '=', 'c.category_id')
            ->select(
                'c.item_name',
                'ca.category_name',
                'csc.quantity',
                's.gender',
                's.common_formats',
                'cr.color_name',
                'c.created_at'
            );

        if ($request->from_date != null && $request->to_date != null) {
            // Get from_date and to_date directly from the request
            $fromDate = $request->from_date . ' 00:00:00';
            $toDate = $request->to_date . ' 23:59:59';

            // Apply the whereBetween condition using from_date and to_date
            $query->whereBetween('c.created_at', [$fromDate, $toDate]);
        }

        $clothes = $query->get();

        $response = new StreamedResponse(function () use ($clothes) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Cloth Name', 'Category', 'Size', 'Color', 'Quantity', 'Created Date']);

            foreach ($clothes as $cloth) {
                fputcsv($handle, [
                    $cloth->item_name,
                    $cloth->category_name,
                    "{$cloth->gender} ({$cloth->common_formats})",
                    $cloth->color_name,
                    $cloth->quantity,
                    $cloth->created_at
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="current_stock_report.csv"');

        return $response;
    }
}
