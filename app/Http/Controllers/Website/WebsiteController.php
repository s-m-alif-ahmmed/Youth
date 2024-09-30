<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\AboutPage;
use App\Models\Admin\Event;
use App\Models\Admin\Favourite;
use App\Models\Admin\HeroBanner;
use App\Models\Admin\Menu;
use App\Models\Admin\Offer;
use App\Models\Admin\OtherImage;
use App\Models\Admin\Product;
use App\Models\Admin\ProductBrand;
use App\Models\Admin\ProductCategory;
use App\Models\Admin\ProductReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hero_banners = HeroBanner::all();
        $offers = Offer::all();
        $events = Event::all();

        return view('website.home.home',[
            'product_categories' => ProductCategory::all(),
            'hero_banners' => $hero_banners,
            'offers' => $offers,
            'events' => $events,
        ]);
    }

    public function menu($menu_slug)
    {
        // Fetch the menu by its slug and make sure it's active
        $menu = Menu::where('menu_slug', $menu_slug)->where('status', 'active')->first();

        // If the menu doesn't exist, return an error view
        if (!$menu) {
            return view('error_pages.error');
        }

        // Fetch only the categories related to this specific menu
        $product_category = ProductCategory::where('menu_id', $menu->id)
            ->where('filter_status', 'active') // Ensure only active categories are fetched
            ->get();

        // Fetch products related to the specific menu
        $products = Product::where('menu_id', $menu->id)->whereNull('offer_id')->whereNull('event_id')->paginate(12);

        // Fetch all brands and favourites (if needed)
        $product_brands = ProductBrand::all();
        $favourites = Favourite::all();

        // Pass the relevant data to the view
        return view('website.home.menu', [
            'menu' => $menu,
            'products' => $products,
            'product_category' => $product_category,
            'product_brands' => $product_brands,
            'favourites' => $favourites,
        ]);
    }

    public function product($product_category_slug)
    {
        $product_categories = ProductCategory::all();
        $product_brands = ProductBrand::all();
        $favourites = Favourite::all();
        $product_category = ProductCategory::where('product_category_slug', $product_category_slug)->first();
        if (!$product_category) {
            return view('error_pages.error');
        }
        $products = Product::where('product_category_id', $product_category->id)->whereNull('offer_id')->whereNull('event_id')->paginate(12);

        return view('website.home.product',[
            'product_category' => $product_category,
            'products' => $products,
            'product_categories' => $product_categories,
            'product_brands' => $product_brands,
            'favourites' => $favourites,
        ]);
    }

    public function offerProduct($offer_slug)
    {
        $product_categories = ProductCategory::all();
        $product_brands = ProductBrand::all();
        $favourites = Favourite::all();

        // Retrieve the specific offer by its slug
        $offer_product = Offer::where('offer_slug', $offer_slug)->first();

        // Handle the case where no offer is found
        if ($offer_product) {
//             If the offer is found, retrieve the products associated with the offer
            $offer_products = Product::where('offer_id', $offer_product->id)->paginate(12);
        }

        return view('website.home.offer',[
            'offer_products' => $offer_products,
            'offer_product' => $offer_product,
            'product_category' => $product_categories,
            'product_brands' => $product_brands,
            'favourites' => $favourites,
        ]);
    }

    public function eventProduct($event_slug)
    {
        $product_categories = ProductCategory::all();
        $product_brands = ProductBrand::all();
        $favourites = Favourite::all();

        // Retrieve the specific offer by its slug
        $event_product = Event::where('event_slug', $event_slug)->where('status', 'active')->first();

        // Handle the case where no offer is found
        if ($event_product) {
//             If the offer is found, retrieve the products associated with the offer
            $event_products = Product::where('event_id', $event_product->id)->paginate(12);
        }

        return view('website.home.event',[
            'event_products' => $event_products,
            'event_product' => $event_product,
            'product_category' => $product_categories,
            'product_brands' => $product_brands,
            'favourites' => $favourites,
        ]);
    }


    public function allProduct()
    {
        $product_categories = ProductCategory::all();
        $product_brands = ProductBrand::all();
        $favourites = Favourite::all();
        $products = Product::where('status', 'active')->paginate(12);

        return view('website.home.shop',[
            'products' => $products,
            'product_category' => $product_categories,
            'product_brands' => $product_brands,
            'favourites' => $favourites,
        ]);
    }

    public function productDetail($product_slug)
    {
        $product = Product::where('product_slug', $product_slug)->with('product_reviews')->first();
        $other_images = OtherImage::where('product_id', $product->id)->get();
        $favourites = Favourite::all();
        $product->size = unserialize($product->size);

//      Share
        $shareButtons = \Share::page(
            url(url()->current()),
        )
            ->facebook()
            ->whatsapp()
            ->twitter()
            ->pinterest()
            ->linkedin();

        // Get all reviews for the specific product
        $product_reviews = ProductReview::where('product_id', $product->id)->get();

        // Fetch related products from the same category, excluding the current product
        $related_products = Product::query()->where('product_category_id', $product->product_category_id) // Updated column name
            ->where('status', 'active')
            ->where('popular_status', 'active')
            ->where('id', '!=', $product->id)
            ->take(12)
            ->latest()
            ->get();

        return view('website.home.product-detail',[
            'product' => $product,
            'other_images' => $other_images,
            'product_reviews' => $product_reviews,
            'favourites' => $favourites,
            'shareButtons' => $shareButtons,
            'related_products' => $related_products,
        ]);
    }

    public function error404()
    {
        return view('error_pages.error');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('website.dashboard.settings',[
            'user' => User::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function contact()
    {
        return view('website.home.contact');
    }

    /**
     * Update the specified resource in storage.
     */
    public function about()
    {
        return view('website.home.about',[
            'about_pages' => AboutPage::all(),
        ]);
    }



}
