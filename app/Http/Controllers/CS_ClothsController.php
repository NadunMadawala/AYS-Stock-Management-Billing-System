<?php


namespace App\Http\Controllers;

use App\Models\CS_Category;
use App\Models\CS_ClothesSizes;

use App\Models\CS_Colors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class CS_ClothsController extends Controller
{

    public function index()
    {
        $sizes = CS_ClothesSizes::all();
        $cloths = CS_ClothesSizes::all();
        $categories = CS_Category::all();
        $colors = CS_Colors::all();

        return view('dashboard/cs-cloths/add-cloths', [
            'sizes' => $sizes,
            'cloths' => $cloths,
            'categories' => $categories,
            'colors' => $colors,
        ]);

    }

    public function store(Request $request)
    {
        // Validate and store cloth details
//        $cloth = Cloth::create($request->validated());
//
//        // Store sizes
//        foreach($request->chemicals as $sizeData) {
//            $cloth->sizes()->attach($sizeData['id'], ['quantity' => $sizeData['quantity']]);
//        }

        $c_id = 1;

        return redirect()->route('clothes.pricing.create', $c_id);
    }

    public function createPricing()
    {
        return view('dashboard.cs-cloths.add-pricing');
    }

    public function storePricing(Request $request, Cloth $cloth)
    {
        foreach($request->prices as $sizeId => $priceData) {
            $cloth->sizes()->updateExistingPivot($sizeId, [
                'dealer_price' => $priceData['dealer_price'],
                'selling_price' => $priceData['selling_price']
            ]);
        }

        return redirect()->route('clothes.index')->with('message', 'Product and pricing added successfully!');
    }
}
