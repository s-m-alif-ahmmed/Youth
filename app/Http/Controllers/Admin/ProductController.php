<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Event;
use App\Models\Admin\Menu;
use App\Models\Admin\Offer;
use App\Models\Admin\OtherImage;
use App\Models\Admin\Product;
use App\Models\Admin\ProductBrand;
use App\Models\Admin\ProductCategory;
use App\Models\Admin\ProductSize;
use App\Models\Admin\ProductSubCategory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.product.index',[
                'products' => Product::all(),
            ]);
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.crud.product.create',[
                'product_categories' => ProductCategory::where('status', 'active')->latest()->get(),
                'product_brands' => ProductBrand::where('status', 'active')->latest()->get(),
                'product_sizes' => ProductSize::where('status', 'active')->latest()->get(),
                'menus' => Menu::where('status', 'active')->latest()->get(),
                'offers' => Offer::where('status', 'active')->latest()->get(),
                'events' => Event::where('status', 'active')->latest()->get(),
            ]);
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'menu_id' => 'required',
                'product_category_id' => 'required',
                'stock' => 'required|integer',
                'name' => 'required|string|max:255|unique:products',
                'meta_title' => 'required|string|max:255',
                'meta_description' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'alt' => 'required|string|max:255',
                'other_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'regular_price' => 'nullable|numeric',
                'selling_price' => 'required|numeric',
                'description' => 'required|string',
            ]);

            // Create the product
            $this->product = Product::createProduct($request);
            OtherImage::createProductOtherImage($request, $this->product->id);

            return redirect('/admin/product')->with('message', 'Product created successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $product_slug)
    {
        try {
            $product = Product::where('product_slug', $product_slug)->first();

            return view('admin.crud.product.detail',[
                'product' => $product,
                'product_sizes' => ProductSize::all(),
            ]);
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $dycryptId = Crypt::decryptString($id);
            $product = Product::where('id', $dycryptId)->firstOrFail();

            return view('admin.crud.product.edit', [
                'product' => $product,
                'product_categories' => ProductCategory::where('status', 'active')->latest()->get(),
                'product_brands' => ProductBrand::where('status', 'active')->latest()->get(),
                'product_sizes' => ProductSize::where('status', 'active')->latest()->get(),
                'offers' => Offer::where('status', 'active')->latest()->get(),
                'events' => Event::where('status', 'active')->latest()->get(),
                'menus' => Menu::where('status', 'active')->latest()->get(),
                'other_images' => OtherImage::all(),
            ]);
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validated = $request->validate([
                'menu_id' => 'required',
                'product_category_id' => 'required',
                'stock' => 'required|integer',
                'name' => 'required|string|max:255',
                'meta_title' => 'required|string|max:255',
                'meta_description' => 'required|string',
                'alt' => 'required|string|max:255',
                'regular_price' => 'nullable|numeric',
                'selling_price' => 'required|numeric',
                'description' => 'required|string',
            ]);
            Product::updateProduct($request, $id);
            if ($request->file('other_image'))
            {
                OtherImage::updateProductOtherImage($request, $id);
            }
            return redirect('/admin/product')->with('message','Product update successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Change Menu Status the specified resource.
     */
    public function changeProductStatus($id)
    {
        try {
            $status = Product::select('status')->where('id',$id)->first();
            if($status->status == 'active')
            {
                $status = 'inActive';
            }
            elseif($status->status == 'inActive')
            {
                $status = 'active';
            }
            Product::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected product status changed successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changePopularProductStatus($id)
    {
        try {
            $popular_status = Product::select('popular_status')->where('id',$id)->first();
            if($popular_status->popular_status == 'active')
            {
                $popular_status = 'inActive';
            }
            elseif($popular_status->popular_status == 'inActive')
            {
                $popular_status = 'active';
            }
            Product::where('id',$id)->update(['popular_status' => $popular_status ]);
            return back()->with('message','Selected product most selling status changed successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Change Status the specified resource.
     */
//    public function changeRelatedProductStatus($id)
//    {
//        try {
//            $related_status = Product::select('related_status')->where('id',$id)->first();
//            if($related_status->related_status == 'active')
//            {
//                $related_status = 'inActive';
//            }
//            elseif($related_status->related_status == 'inActive')
//            {
//                $related_status = 'active';
//            }
//            Product::where('id',$id)->update(['related_status' => $related_status ]);
//            return back()->with('message','Selected product related status changed successfully.');
//        } catch (DecryptException $e) {
//            return view('error_pages.error');
//        }
//    }

    /**
     * Dropdown the specified resource from storage.
     */
//    public function getSubCategoriesByCategory(Request $request)
//    {
//        $productCategoryId = $request->input('product_category_id');
//        $productSubCategories = ProductSubCategory::where('product_category_id', $productCategoryId)->get();
//
//        return response()->json($productSubCategories);
//    }

    /**
     * Dropdown the specified resource from storage.
     */
    public function getCategoriesIdByMenu(Request $request)
    {
        $menuId = $request->input('menu_id');
        $productCategories = ProductCategory::where('menu_id', $menuId)->get();

        return response()->json($productCategories);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Product::deleteProduct($id);
            OtherImage::deleteProductOtherImage($id);
            return redirect('/admin/product')->with('message','Product delete successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }
}
