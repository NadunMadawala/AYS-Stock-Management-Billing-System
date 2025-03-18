<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class CS_MainDashboardController extends Controller
{
    public function viewMainDashboard()
    {

        $currentDate = date('Y-m-d');
        $currentMonth = date('Y-m');

        $total_Sales = DB::table('bill_details')
            ->where('created_at', 'like', $currentDate . '%') // Proper string concatenation
            ->sum('grand_total');

        $total_Sales_month = DB::table('bill_details')
            ->where('created_at', 'like', $currentMonth . '%') // Proper string concatenation
            ->sum('grand_total');



        return view('dashboard.cs-main-dashboard.dashboard')->with(
            [
                'total_Sales' => $total_Sales,
                'total_Sales_month' => $total_Sales_month,
            ]
        );
    }

    public function viewRegisterPage()
    {
        return view('dashboard.admin.register-page');
    }


}
