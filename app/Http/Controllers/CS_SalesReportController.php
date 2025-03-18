<?php

namespace App\Http\Controllers;

use App\Models\CS_BillDetails;
use App\Models\CS_Cloths;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CS_SalesReportController extends Controller
{

    /**
     * Generate the daily sales report view.
     * Applies a date range filter if provided.
     */
    public function DailySalesReport(Request $request)
    {

        $query = CS_BillDetails::query();

        // Apply date range filter if provided
        if ($request->has('date_range')) {
            $dates = explode(' - ', $request->date_range);
            $query->whereBetween('created_at', [$dates[0] . ' 00:00:00', $dates[1] . ' 23:59:59']);
        }

        $bills = $query->get();

        return view('dashboard/cs-sales-report/baily-sales-report', [
            'bills' => $bills,
        ]);


    }

    /**
     * Filter the sales report based on the provided date range.
     * Returns the filtered data in JSON format.
     */
    public function filterSalesReport(Request $request)
    {
        $query = DB::table('bill_details as b')
            ->select(
                'b.id',
                'b.payment_method',
                'b.amount_received',
                'b.grand_total',
                'b.created_at'
            );

        // Apply date range filter if provided
        if ($request->has('date_range')) {
            $dates = explode(' - ', $request->date_range);
            $query->whereBetween('b.created_at', [$dates[0] . ' 00:00:00', $dates[1] . ' 23:59:59']);
        }

        return response()->json(['data' => $query->get()]);
    }


    /**
     * Export the sales report as a CSV file.
     * Applies date range filtering if provided.
     */
    public function exportSalesReport(Request $request)
    {

        $query = DB::table('bill_details as b')
            ->select(
                'b.id',
                'b.payment_method',
                'b.amount_received',
                'b.grand_total',
                'b.created_at'
            );



        if ($request->from_date != null && $request->to_date != null) {
            // Get from_date and to_date directly from the request
            $fromDate = $request->from_date . ' 00:00:00';
            $toDate = $request->to_date . ' 23:59:59';

            // Apply the whereBetween condition using from_date and to_date
            $query->whereBetween('b.created_at', [$fromDate, $toDate]);
        }


        $bills = $query->get();

        $response = new StreamedResponse(function () use ($bills) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Bill Number', 'Payment Method', 'Grand Total', 'Amount Received', 'Created Date']);

            foreach ($bills as $bill) {
                fputcsv($handle, [
                    $bill->id,
                    $bill->payment_method,
                    "{$bill->grand_total}",
                    $bill->amount_received,
                    $bill->created_at
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="daily-sales-report.csv"');

        return $response;

    }


}
