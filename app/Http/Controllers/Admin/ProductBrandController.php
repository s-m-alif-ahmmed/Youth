<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductBrand;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

class ProductBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.product-brand.index',[
                'product_brands' => ProductBrand::all(),
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
            return view('admin.crud.product-brand.create');
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
            ProductBrand::createProductBrand($request);
            return back()->with('message','Brand create successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $product_brand_slug)
    {
        try {
            $product_brand = ProductBrand::where('product_brand_slug', $product_brand_slug)->first();

            return view('admin.crud.product-brand.detail',[
                'product_brand' => $product_brand,
            ]);
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $product_brand_slug)
    {
        try {

            return view('admin.crud.product-brand.edit', [
                'product_brand' => ProductBrand::where('product_brand_slug', $product_brand_slug)->first(),
            ]);
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $product_brand_slug)
    {
        try {
            ProductBrand::updateProductBrand($request, $product_brand_slug);
            return redirect('/admin/product-brand')->with('message','Brand update successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Change Menu Status the specified resource.
     */
    public function changeBrandFilterStatus($id)
    {
        try {
            $brand = ProductBrand::select('filter_status')->where('id',$id)->first();
            if($brand->filter_status == 'active')
            {
                $brand = 'inActive';
            }
            elseif($brand->filter_status == 'inActive')
            {
                $brand = 'active';
            }
            ProductBrand::where('id',$id)->update(['filter_status' => $brand ]);
            return back()->with('message','Selected brand filter status changed successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }
    /**
     * Change Status the specified resource.
     */

    public function changeBrandStatus($id)
    {
        try {
            $product_brand = ProductBrand::select('status')->where('id',$id)->first();
            if($product_brand->status == 'active')
            {
                $status = 'inActive';
            }
            elseif($product_brand->status == 'inActive')
            {
                $status = 'active';
            }
            ProductBrand::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected brand status changed successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            ProductBrand::deleteProductBrand($id);
            return back()->with('message','Brand delete successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }
}
