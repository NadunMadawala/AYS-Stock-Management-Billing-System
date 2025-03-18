<?php


namespace App\Http\Controllers;

use App\Models\CS_BillDetails;
use App\Models\CS_Cloths;

use App\Models\CS_Combination;
use App\Models\CS_Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class CS_ItemSellingController extends Controller
{
    public function index()
    {

        $cloth = DB::table('cloths')
            ->select(
                'cspc.id',
                'cloths.item_name',
                'cloths.category_id',
                'cspc.selling_price',
                's.gender','s.region','s.numeric_sizes','s.alpha_sizes','s.common_formats','cat.category_name'
            )
            ->join('clothes_sizes_combination as cs', 'cs.cloth_id', '=', 'cloths.id')
            ->join('sizes as s', 's.id', '=', 'cs.size_id')  // Join the sizes table
            ->join('categories as cat', 'cat.id', '=', 'cloths.category_id')  // Join the categories table
            ->leftJoin('clothes_sizes_price_combination as cspc', 'cspc.combination_id', '=', 'cs.id')
            ->whereNotNull('cspc.selling_price') // Only fetch records where selling_price is not null
            ->get();

        return view('dashboard/cs-item-selling/item-selling',[
            'cloth' => $cloth,
        ]);

    }

    public function searchItems(Request $request)
    {
        $query = $request->get('query');
        $items = CS_Cloths::where('name', 'like', '%' . $query . '%')->get();

        return response()->json($items);
    }

    public function completeSale(Request $request)
    {

        $bill = CS_BillDetails::create([
            'payment_method' => $request->payment_method,
            'grand_total' => $request->grand_total,
            'amount_received' => $request->amount_received,
            'created_at' => now(),
        ]);

        foreach ($request['items'] as $item) {

            CS_Sales::create([
                'bill_id' => $bill->id,
                'item_id' => $item['id'],
                'price' => $item['price'],
                'discount' => $item['discount'],
                'quantity' => $item['quantity'],
                'total' => $item['total'],
                'created_at' => now(),
            ]);

        }

        return response()->json(['message' => 'Sale completed successfully']);
    }
}
