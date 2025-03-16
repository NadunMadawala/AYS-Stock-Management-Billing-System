<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\SMS_Chemical;
use Carbon\Carbon;

class CS_ItemSellingController extends Controller
{
    public function index()
    {
        return view('dashboard/cs-item-selling/item-selling');

    }
}
