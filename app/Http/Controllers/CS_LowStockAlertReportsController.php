<?php

namespace App\Http\Controllers;

use App\Models\CS_Cloths;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CS_LowStockAlertReportsController extends Controller
{

    public function currentStockReport(Request $request)
    {
        return view('dashboard.cs-stock-report.low-stock-alert-report')->with(
            [
                //'allElectorateDetails' => $allChemicals,
            ]
        );
    }

}
