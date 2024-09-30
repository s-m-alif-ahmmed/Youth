<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\ProductBrand;
use App\Models\Admin\ProductCategory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
    public function searchResult(Request $request)
    {
        try {
            $searchQuery = $request->input('search');
            $product_categories = ProductCategory::all();
            $product_brands = ProductBrand::all();

            if ($searchQuery) {
                $searchProducts = Product::where('name', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('description', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('selling_price', 'LIKE', '%' . $searchQuery . '%')
                    ->latest()
                    ->paginate(12)
                    ->appends(['search' => $searchQuery]); // Appends search query to pagination

                if ($searchProducts->isEmpty()) {
                    return redirect()->back()->with('message', 'No matching result found.');
                } else {
                    return view('website.home.search', [
                        'product_categories' => $product_categories,
                        'product_brands' => $product_brands,
                        'searchProducts' => $searchProducts,
                    ]);
                }
            } else {
                return redirect()->back()->with('search_message', 'Please enter a search query.');
            }
        } catch (DecryptException $e) {
            return abort(404);
        }
    }


}
