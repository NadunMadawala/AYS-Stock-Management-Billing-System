<?php


namespace App\Http\Controllers;

use App\Models\CS_Category;
use App\Models\CS_ClothesSizes;

use App\Models\CS_Cloths;
use App\Models\CS_Colors;
use App\Models\CS_Combination;
use App\Models\CS_SizesPriceCombination;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;


class CS_ClothsController extends Controller
{

    /**
     * Display the form to add new cloths along with required dropdown data (sizes, categories, colors).
     */
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

    /**
     * Store a newly created cloth and its size combinations in the database.
     */
    public function store(Request $request)
    {

        // Validate incoming request data
        $validated = $request->validate([
            'model' => 'required|string|max:255',
            'color' => 'required|exists:colors,id',
            'category' => 'required|exists:categories,id',
            'specifications' => 'nullable|string',
            'chemicals.*.id' => 'required|exists:sizes,id',
            'chemicals.*.quantity' => 'required|numeric|min:0',
        ]);

        // Create the cloth entry in the database
        $cloth = CS_Cloths::create([
            'item_name' => $validated['model'],
            'color_id' => $validated['color'],
            'category_id' => $validated['category'],
            'description' => $validated['specifications'] ?? null,
        ]);

        // Loop through all submitted sizes and create a record for each size combination
        foreach ($request->chemicals as $sizeData) {
            CS_Combination::create([
                'cloth_id' => $cloth->id,
                'size_id' => $sizeData['id'],
                'quantity' => $sizeData['quantity'],
            ]);
        }

        // Redirect to the pricing form for this cloth
        return redirect()->route('clothes.pricing.create', $cloth->id);

    }


    /**
     * Display the pricing form for a specific cloth, including its size combinations.
     */
    public function createPricing($id)
    {

        // Retrieve cloth details along with color and category names
        $cloth = DB::select("SELECT c.*, co.color_name, co.color_code, ca.category_name
                     FROM cloths AS c
                     JOIN colors AS co ON co.id = c.color_id
                     JOIN categories AS ca ON ca.id = c.category_id
                     WHERE c.id = ?", [$id]);


        // Retrieve the sizes assigned to this cloth and their details
        $sizes = DB::select("SELECT cs.size_id, cs.quantity , s.gender,s.region,s.numeric_sizes,s.alpha_sizes,s.common_formats
                                    FROM clothes_sizes_combination AS cs
                                    JOIN sizes AS s ON s.id = cs.size_id
                                    WHERE cs.cloth_id =  ?", [$id]);

        // Show the pricing view with cloth and size data
        return view('dashboard.cs-cloths.add-pricing',[
            'cloth' => $cloth,
            'sizes' => $sizes,
        ]);
    }

    /**
     * Store or update pricing for each size combination of a specific cloth.
     */
    public function storePricing(Request $request, CS_Cloths $cloth)
    {
        // Loop through all submitted prices and update or create price records
        foreach ($request->prices as $index => $priceData) {
            // Find the matching size combination for this cloth
            $combination = DB::table('clothes_sizes_combination')
                ->where('cloth_id', $cloth->id)
                ->where('size_id', $priceData['size_id'])
                ->first();

            // If the combination exists, update or create the price record
            if ($combination) {
                CS_SizesPriceCombination::updateOrCreate(
                    ['combination_id' => $combination->id],
                    [
                        'purchase_price' => $priceData['dealer_price'],
                        'selling_price' => $priceData['selling_price'],
                        'updated_at' => now(),
                    ]
                );
            }
        }

        // Redirect back to main dashboard with success message
        return redirect()->route('clothes.list')->with('message', 'Product and pricing added successfully!');

    }

    /**
     * Retrieve and list all cloth items with their categories.
     * Paginate the results to show 10 cloths per page.
     */
    public function listAllClothsDetails()
    {

        // Fetch all cloths with their corresponding category names
        $cloths = DB::table('cloths as c')
            ->join('categories as ca', 'ca.id', '=', 'c.category_id')
            ->select('c.*', 'ca.category_name')
            ->paginate(10); // Adjust the number per page as needed

        // Return the view with cloths data
        return view('dashboard/cs-cloths/cloths-list', [
            'cloths' => $cloths
        ]);
    }

    /**
     * Display full details for a specific cloth, including its category, color, and size combinations with pricing.
     */
    public function showClothDetails($id)
    {
        // Retrieve cloth details including category name and color information
        $cloth = DB::table('cloths as c')
            ->join('categories as ca', 'ca.id', '=', 'c.category_id')
            ->join('colors as co', 'co.id', '=', 'c.color_id')
            ->select('c.*', 'ca.category_name', 'co.color_name', 'co.color_code')
            ->where('c.id', $id)
            ->first();

        // If the cloth is not found, redirect to the cloths list with an error message
        if (!$cloth) {
            return redirect()->route('clothes.index')->with('error', 'Cloth not found.');
        }

        // Retrieve all sizes associated with this cloth, including quantity and pricing details
        $sizes = DB::table('clothes_sizes_combination as cs')
            ->join('sizes as s', 's.id', '=', 'cs.size_id')
            ->leftJoin('clothes_sizes_price_combination as cspc', 'cspc.combination_id', '=', 'cs.id')
            ->select('s.gender','s.region','s.numeric_sizes','s.alpha_sizes','s.common_formats','cs.id as combination_id', 'cs.quantity', 'cspc.purchase_price', 'cspc.selling_price')
            ->where('cs.cloth_id', $id)
            ->get();

        // Return the view to display full cloth details along with size and pricing info
        return view('dashboard/cs-cloths/cloth-full-details', [
            'cloth' => $cloth,
            'sizes' => $sizes,
        ]);
    }


    public function clothsEdit($id) {

        $cloth = CS_Cloths::findOrFail($id);
        $categories = CS_Category::all();

        return view('dashboard/cs-cloths/edit-cloths', [
            'cloth' => $cloth,
            'categories' => $categories,
        ]);

    }

    public function clothsUpdate(Request $request, $id)
    {
        $cloth = CS_Cloths::findOrFail($id);

        $cloth->update([
            'item_name' => $request->item_name,
            'description' => $request->description,
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('clothes.list')->with('success', 'Cloth updated successfully!');
    }
}
