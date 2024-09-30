<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Event;
use App\Models\Admin\Favourite;
use App\Models\Admin\Menu;
use App\Models\Admin\Offer;
use App\Models\Admin\Product;
use App\Models\Admin\ProductBrand;
use App\Models\Admin\ProductCategory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;

class FilterController extends Controller
{
    public function sortProductsShop(Request $request)
    {
        $sort = $request->get('sort_by');
        $products = Product::query();

        $product_categories = ProductCategory::all();
        $product_brands = ProductBrand::all();
        $favourites = Favourite::all();

        switch ($sort) {
            case 'highest_price':
                $products = $products->orderBy('selling_price', 'desc');
                break;
            case 'lowest_price':
                $products = $products->orderBy('selling_price', 'asc');
                break;
            default:
                $products = $products->orderBy('created_at', 'desc');
                break;
        }

        $products = $products->paginate(12);

        return view('website.home.shop',[
            'product_categories' => $product_categories,
            'product_brands' => $product_brands,
            'favourites' => $favourites,
        ],compact('products'));
    }

    public function sortProductsOffer(Request $request, $offer_slug)
    {
        $searchQuery = $request->input('search');
        $sort = $request->get('sort_by');

        $product_categories = ProductCategory::all();
        $product_brands = ProductBrand::all();
        $favourites = Favourite::all();

        // Retrieve the specific offer by its slug
        $offer_product = Offer::where('offer_slug', $offer_slug)->first();

        if (!$offer_product) {
            return view('error_pages.error');
        }

        $offer_product_query = Product::where('offer_id', $offer_product->id);

        switch ($sort) {
            case 'highest_price':
                $offer_product_query->orderBy('selling_price', 'desc');
                break;
            case 'lowest_price':
                $offer_product_query->orderBy('selling_price', 'asc');
                break;
            default:
                $offer_product_query->orderBy('created_at', 'desc');
                break;
        }

        $offer_products = $offer_product_query->paginate(12);

        return view('website.home.offer', [
            'product_categories' => $product_categories,
            'product_brands' => $product_brands,
            'favourites' => $favourites,
            'offer_product' => $offer_product,
            'offer_products' => $offer_products,
        ]);
    }

    public function sortProductsEvent(Request $request, $offer_slug)
    {
        $searchQuery = $request->input('search');
        $sort = $request->get('sort_by');

        $product_categories = ProductCategory::all();
        $product_brands = ProductBrand::all();
        $favourites = Favourite::all();

        // Retrieve the specific offer by its slug
        $event_product = Event::where('event_slug', $event_slug)->first();

        if (!$event_product) {
            return view('error_pages.error');
        }

        $event_product_query = Product::where('event_id', $event_product->id);

        switch ($sort) {
            case 'highest_price':
                $event_product_query->orderBy('selling_price', 'desc');
                break;
            case 'lowest_price':
                $event_product_query->orderBy('selling_price', 'asc');
                break;
            default:
                $event_product_query->orderBy('created_at', 'desc');
                break;
        }

        $event_products = $event_product_query->paginate(12);

        return view('website.home.event', [
            'product_categories' => $product_categories,
            'product_brands' => $product_brands,
            'favourites' => $favourites,
            'event_product' => $event_product,
            'event_products' => $event_products,
        ]);
    }

    public function sortProductsSearch(Request $request)
    {
        $sort = $request->get('sort_by');
        $searchQuery = $request->input('search');

        $product_categories = ProductCategory::all();
        $product_brands = ProductBrand::all();
        $favourites = Favourite::all();

        $products = Product::query();

        if ($searchQuery) {
            $products->where(function ($query) use ($searchQuery) {
                $query->where('name', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('description', 'LIKE', '%' . $searchQuery . '%');
            });
        }

        switch ($sort) {
            case 'highest_price':
                $products->orderBy('selling_price', 'desc');
                break;
            case 'lowest_price':
                $products->orderBy('selling_price', 'asc');
                break;
            default:
                $products->orderBy('created_at', 'desc');
                break;
        }

        $searchProducts = $products->paginate(12);

        return view('website.home.search', [
            'product_categories' => $product_categories,
            'product_brands' => $product_brands,
            'favourites' => $favourites,
            'searchProducts' => $searchProducts,
            'searchQuery' => $searchQuery,
        ]);
    }

    public function sortProducts(Request $request, $product_category_slug)
    {
        // Fetch the product category by its slug
        $product_category = ProductCategory::where('product_category_slug', $product_category_slug)->first();

        // If the product category doesn't exist, return an error view
        if (!$product_category) {
            return view('error_pages.error', ['message' => 'Product category not found']);
        }

        // Start the query to fetch products related to the specific category
        $productsQuery = Product::where('product_category_id', $product_category->id)->where('status', 'active');

        // Apply sorting based on the selected option
        $sort_by = request()->query('sort_by');
        if ($sort_by == 'highest_price') {
            $productsQuery->orderBy('selling_price', 'desc');
        } elseif ($sort_by == 'lowest_price') {
            $productsQuery->orderBy('selling_price', 'asc');
        }

        // Paginate the products after applying the sort order
        $products = $productsQuery->paginate(12);

        // Fetch all brands and favourites (if needed)
        $product_brands = ProductBrand::all();
        $favourites = Favourite::all();

        // Pass the relevant data to the view
        return view('website.home.product', [
            'products' => $products,
            'product_category' => $product_category,
            'product_brands' => $product_brands,
            'favourites' => $favourites,
        ]);
    }


    public function sortMenuProducts(Request $request, $menu_slug)
    {
        $sort = $request->get('sort_by');

        $product_brands = ProductBrand::all();
        $favourites = Favourite::all();
        $menus = Menu::all();

        $menu = Menu::where('menu_slug', $menu_slug)->where('status', 'active')->first();

        // Fetch only the categories related to this specific menu
        $product_category = ProductCategory::where('menu_id', $menu->id)->get();

        if (!$menu) {
            return redirect()->route('website.home.menu', ['menu_slug' => $menu_slug])->with('error', 'Menu not found.');
        }

        $productsQuery = Product::where('menu_id', $menu->id);

        if ($sort == 'highest_price') {
            $productsQuery->orderBy('selling_price', 'desc');
        } elseif ($sort == 'lowest_price') {
            $productsQuery->orderBy('selling_price', 'asc');
        } elseif ($sort == 'all') {
            $productsQuery->orderBy('created_at', 'desc');
        }

        $products = $productsQuery->paginate(12);

        return view('website.home.menu', [
            'product_category' => $product_category,
            'product_brands' => $product_brands,
            'favourites' => $favourites,
            'menus' => $menus,
            'menu' => $menu,
            'products' => $products,
        ]);
    }

//    Price Range Filter

    public function filterByMenuPrice(Request $request, $menu_slug)
    {
        $product_brands = ProductBrand::all();
        $favourites = Favourite::all();

        // Fetch the menu by its slug and make sure it's active
        $menu = Menu::where('menu_slug', $menu_slug)->where('status', 'active')->first();
        $product_category = ProductCategory::where('menu_id', $menu->id)->get();

        // If the menu doesn't exist, return an error view
        if (!$menu) {
            return view('error_pages.error');
        }

        // Initialize the query for products
        $productsQuery = Product::where('menu_id', $menu->id)
            ->where('status', 'active');

        // Apply price filter if present
        if ($request->has('min_price') && $request->has('max_price')) {
            $productsQuery->whereBetween('selling_price', [$request->min_price, $request->max_price]);
        }

        // Fetch paginated products
        $products = $productsQuery->paginate(12);

        return view('website.home.price.menu',[
            'menu' => $menu,
            'favourites' => $favourites,
            'product_brands' => $product_brands,
            'product_category' => $product_category,
        ],compact('products'));

    }

    public function filterByCategoryPrice(Request $request, $product_category_slug)
    {
        $product_brands = ProductBrand::all();
        $favourites = Favourite::all();
        $product_categories = ProductCategory::all();
        $product_category = ProductCategory::where('product_category_slug', $product_category_slug)->first();

        // Start the query
        $category_products = Product::where('product_category_id', $product_category->id);

        // Apply price filter if present
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $category_products->whereBetween('selling_price', [$request->min_price, $request->max_price]);
        }

        // Fetch paginated products
        $products = $category_products->paginate(12);

        return view('website.home.price.category', compact('product_categories', 'product_category', 'product_brands', 'favourites', 'products'));
    }


    public function filterOfferProductsByPrice($offer_slug, Request $request)
    {
        $product_categories = ProductCategory::all();
        $product_brands = ProductBrand::all();
        $favourites = Favourite::all();

        $offer_product = Offer::where('offer_slug', $offer_slug)->first();

        // Start the query
        $offer_products = Product::where('offer_id', $offer_product->id);

        // Apply price filter if present
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $offer_products->whereBetween('selling_price', [$request->min_price, $request->max_price]);
        }

        // Fetch paginated products
        $products = $offer_products->paginate(12);

        return view('website.home.price.offer', compact('product_categories','product_brands', 'favourites', 'products', 'offer_products', 'offer_product'));
    }

    public function filterEventProductsByPrice($event_slug, Request $request)
    {
        $product_categories = ProductCategory::all();
        $product_brands = ProductBrand::all();
        $favourites = Favourite::all();

        $event_product = Event::where('event_slug', $event_slug)->first();

        // Start the query
        $event_products = Product::where('event_id', $event_product->id);

        // Apply price filter if present
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $event_products->whereBetween('selling_price', [$request->min_price, $request->max_price]);
        }

        // Fetch paginated products
        $products = $event_products->paginate(12);

        return view('website.home.price.event', compact('product_categories','product_brands', 'favourites', 'products', 'event_products', 'event_product'));
    }

    public function filterByPrice(Request $request)
    {
        $product_categories = ProductCategory::all();
        $product_brands = ProductBrand::all();
        $favourites = Favourite::all();

        // Start the query
        $query = Product::query();

        // Apply price filter if present
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereBetween('selling_price', [$request->min_price, $request->max_price]);
        }

        // Fetch paginated products
        $products = $query->paginate(12);

        return view('website.home.price.shop', compact('product_categories','product_brands', 'favourites', 'products'));
    }

}


