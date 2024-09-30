<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Menu;
use App\Models\Admin\ProductCategory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.product-category.index',[
                'product_categories' => ProductCategory::all(),
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
            $menus = Menu::all();
            return view('admin.crud.product-category.create',[
                'menus' => $menus,
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
            ProductCategory::createProductCategory($request);
            return redirect('/admin/product-category')->with('message','Category create successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $product_category_slug)
    {
        try {
            $product_category = ProductCategory::where('product_category_slug', $product_category_slug)->first();

            return view('admin.crud.product-category.detail',[
                'product_category' => $product_category,
            ]);
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $product_category_slug)
    {
        try {
            $product_category = ProductCategory::where('product_category_slug', $product_category_slug)->first();
            $menus = Menu::all();
            return view('admin.crud.product-category.edit', [
                'product_category' => $product_category,
                'menus' => $menus,
            ]);
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $product_category_slug)
    {
        try {
            ProductCategory::updateProductCategory($request, $product_category_slug);
            return redirect('/admin/product-category')->with('message','Category update successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Change Menu Status the specified resource.
     */
    public function changeCategoryFilterStatus($id)
    {
        try {
            $filter = ProductCategory::select('filter_status')->where('id',$id)->first();
            if($filter->filter_status == 'active')
            {
                $filter = 'inActive';
            }
            elseif($filter->filter_status == 'inActive')
            {
                $filter = 'active';
            }
            ProductCategory::where('id',$id)->update(['filter_status' => $filter ]);
            return back()->with('message','Selected category menu filter status changed successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Change Status the specified resource.
     */

    public function changeCategoryStatus($id)
    {
        try {
            $product_category = ProductCategory::select('status')->where('id',$id)->first();
            if($product_category->status == 'active')
            {
                $status = 'inActive';
            }
            elseif($product_category->status == 'inActive')
            {
                $status = 'active';
            }
            ProductCategory::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected category status changed successfully.');
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
            ProductCategory::deleteProductCategory($id);
            return redirect('/admin/product-category')->with('message','Category delete successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }
}
