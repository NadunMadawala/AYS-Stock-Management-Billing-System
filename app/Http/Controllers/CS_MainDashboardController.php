<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class CS_MainDashboardController extends Controller
{
    public function viewMainDashboard()
    {
        $allChemicals = DB::table('chemicals')
            ->select('*')
            ->get();

        //  dd($allElectorateDetails);
        return view('dashboard.cs-main-dashboard.dashboard')->with(
            [
                //'allElectorateDetails' => $allChemicals,
            ]
        );
    }

    public function viewRegisterPage()
    {
        return view('dashboard.admin.register-page');
    }


}
