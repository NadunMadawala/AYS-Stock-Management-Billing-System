<?php

namespace App\Http\Controllers;

use App\Models\CS_Cloths;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CS_LowStockInAndOutReportsController extends Controller
{

    /**
     * Generates a report of stock items that have been added (stock-in) and sold (stock-out).
     *
     * This function retrieves data from multiple related tables: cloths, sizes, colors, and categories.
     * It applies optional date filtering if provided in the request, combines stock-in and stock-out
     * data using UNION, sorts by creation date, and returns the data to a Blade view for display.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function inAndOutStockReport(Request $request)
    {

        $stockInQuery = DB::table('cloths AS c')
            ->join('clothes_sizes_combination AS csc', 'csc.cloth_id', '=', 'c.id')
            ->join('sizes AS s', 's.id', '=', 'csc.size_id')
            ->join('colors AS cr', 'cr.id', '=', 'c.color_id')
            ->join('categories as ca', 'ca.id', '=', 'c.category_id')
            ->select(
                'c.item_name',
                'c.created_at AS created_at',
                'csc.quantity',
                's.common_formats',
                's.gender',
                'cr.color_name',
                'ca.category_name',
                DB::raw("'in' AS stock_status")
            );

        $stockOutQuery = DB::table('sales AS sa')
            ->join('clothes_sizes_combination AS csc', 'csc.id', '=', 'sa.item_id')
            ->join('cloths AS c', 'c.id', '=', 'csc.cloth_id')
            ->join('sizes AS s', 's.id', '=', 'csc.size_id')
            ->join('colors AS cr', 'cr.id', '=', 'c.color_id')
            ->join('categories as ca', 'ca.id', '=', 'c.category_id')
            ->select(
                'c.item_name',
                'sa.created_at AS created_at',
                'csc.quantity',
                's.common_formats',
                's.gender',
                'cr.color_name',
                'ca.category_name',
                DB::raw("'out' AS stock_status")
            );


        if ($request->has('date_range')) {
            $dates = explode(' - ', $request->date_range);

            $stockInQuery->whereBetween('c.created_at', [$dates[0] . ' 00:00:00', $dates[1] . ' 23:59:59']);
            $stockOutQuery->whereBetween('sa.created_at', [$dates[0] . ' 00:00:00', $dates[1] . ' 23:59:59']);
        }

        $finalQuery = $stockInQuery->union($stockOutQuery)
            ->orderBy('created_at')
            ->get();

        return view('dashboard.cs-stock-report.in-and-out-stock-report')->with(
            [
                'clothes' => $finalQuery,
            ]
        );
    }


    /**
     * Filters stock-in and stock-out report based on date range and returns JSON response.
     *
     * This function retrieves relevant data similarly to inAndOutStockReport but is designed
     * for AJAX requests. The filtered results are returned in JSON format for dynamic frontend updates.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterInAndOutStockReport(Request $request)
    {
        $stockInQuery = DB::table('cloths AS c')
            ->join('clothes_sizes_combination AS csc', 'csc.cloth_id', '=', 'c.id')
            ->join('sizes AS s', 's.id', '=', 'csc.size_id')
            ->join('colors AS cr', 'cr.id', '=', 'c.color_id')
            ->join('categories as ca', 'ca.id', '=', 'c.category_id')
            ->select(
                'c.item_name',
                'c.created_at AS created_at',
                'csc.quantity',
                's.common_formats',
                's.gender',
                'cr.color_name',
                'ca.category_name',
                DB::raw("'in' AS stock_status")
            );

        $stockOutQuery = DB::table('sales AS sa')
            ->join('clothes_sizes_combination AS csc', 'csc.id', '=', 'sa.item_id')
            ->join('cloths AS c', 'c.id', '=', 'csc.cloth_id')
            ->join('sizes AS s', 's.id', '=', 'csc.size_id')
            ->join('colors AS cr', 'cr.id', '=', 'c.color_id')
            ->join('categories as ca', 'ca.id', '=', 'c.category_id')
            ->select(
                'c.item_name',
                'sa.created_at AS created_at',
                'csc.quantity',
                's.common_formats',
                's.gender',
                'cr.color_name',
                'ca.category_name',
                DB::raw("'out' AS stock_status")
            );


        if ($request->has('date_range')) {
            $dates = explode(' - ', $request->date_range);

            $stockInQuery->whereBetween('c.created_at', [$dates[0] . ' 00:00:00', $dates[1] . ' 23:59:59']);
            $stockOutQuery->whereBetween('sa.created_at', [$dates[0] . ' 00:00:00', $dates[1] . ' 23:59:59']);
        }


        $finalQuery = $stockInQuery->union($stockOutQuery)
            ->orderBy('created_at')
            ->get();

        // Query stock-in items and stock-out items, filter by date range if provided, and return results as JSON
        return response()->json(['data' => $finalQuery]);
    }


    /**
     * Exports stock-in and stock-out report as a CSV file.
     *
     * This function fetches stock-in and stock-out data, applies date filters if provided,
     * formats the data as a CSV file with headers like Cloth Name, Category, Size, Color, Quantity,
     * Type, and Created Date, and streams the CSV file for download without storing it on the server.
     *
     * @param Request $request
     * @return StreamedResponse
     */
    public function exportInAndOutStockReport(Request $request)
    {
        $stockInQuery = DB::table('cloths AS c')
            ->join('clothes_sizes_combination AS csc', 'csc.cloth_id', '=', 'c.id')
            ->join('sizes AS s', 's.id', '=', 'csc.size_id')
            ->join('colors AS cr', 'cr.id', '=', 'c.color_id')
            ->join('categories as ca', 'ca.id', '=', 'c.category_id')
            ->select(
                'c.item_name',
                'c.created_at AS created_at',
                'csc.quantity',
                's.common_formats',
                's.gender',
                'cr.color_name',
                'ca.category_name',
                DB::raw("'in' AS stock_status")
            );

        $stockOutQuery = DB::table('sales AS sa')
            ->join('clothes_sizes_combination AS csc', 'csc.id', '=', 'sa.item_id')
            ->join('cloths AS c', 'c.id', '=', 'csc.cloth_id')
            ->join('sizes AS s', 's.id', '=', 'csc.size_id')
            ->join('colors AS cr', 'cr.id', '=', 'c.color_id')
            ->join('categories as ca', 'ca.id', '=', 'c.category_id')
            ->select(
                'c.item_name',
                'sa.created_at AS created_at',
                'csc.quantity',
                's.common_formats',
                's.gender',
                'cr.color_name',
                'ca.category_name',
                DB::raw("'out' AS stock_status")
            );


        if ($request->from_date != null && $request->to_date != null) {
            // Get from_date and to_date directly from the request
            $fromDate = $request->from_date . ' 00:00:00';
            $toDate = $request->to_date . ' 23:59:59';


            $stockInQuery->whereBetween('c.created_at', [$fromDate . ' 00:00:00', $toDate . ' 23:59:59']);
            $stockOutQuery->whereBetween('sa.created_at', [$fromDate . ' 00:00:00', $toDate . ' 23:59:59']);
        }

        $clothes = $stockInQuery->union($stockOutQuery)
            ->orderBy('created_at')
            ->get();

        // Query stock-in items and stock-out items, filter by date range if provided, and return results as a downloadable CSV file
        $response = new StreamedResponse(function () use ($clothes) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Cloth Name', 'Category', 'Size', 'Color', 'Quantity', 'Type', 'Created Date']);

            foreach ($clothes as $cloth) {
                fputcsv($handle, [
                    $cloth->item_name,
                    $cloth->category_name,
                    "{$cloth->gender} ({$cloth->common_formats})",
                    $cloth->color_name,
                    $cloth->quantity,
                    $cloth->stock_status,
                    $cloth->created_at
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="stock_in_and_out_report.csv"');

        return $response;
    }
}
