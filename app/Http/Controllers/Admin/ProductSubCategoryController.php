<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Menu;
use App\Models\Admin\ProductCategory;
use App\Models\Admin\ProductSubCategory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

class ProductSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.product-sub-category.index',[
                'product_sub_categories' => ProductSubCategory::all(),
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
            return view('admin.crud.product-sub-category.create',[
                'menus' => Menu::all(),
                'product_categories' => ProductCategory::all(),
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
            ProductSubCategory::createProductSubCategory($request);
            return redirect('/admin/product-sub-category')->with('message','Sub Category create successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $product_sub_category_slug)
    {
        try {
            $product_sub_category = ProductSubCategory::where('product_sub_category_slug', $product_sub_category_slug)->first();

            return view('admin.crud.product-sub-category.detail',[
                'product_sub_category' => $product_sub_category,
            ]);
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $product_sub_category_slug)
    {
        try {
            $product_sub_category = ProductSubCategory::where('product_sub_category_slug', $product_sub_category_slug)->first();

            return view('admin.crud.product-sub-category.edit', [
                'product_sub_category' => $product_sub_category,
                'product_category' => ProductCategory::all(),
                'menus' => Menu::all(),
            ]);
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $product_sub_category_slug)
    {
        try {
            ProductSubCategory::updateProductSubCategory($request, $product_sub_category_slug);
            return redirect('/admin/product-sub-category')->with('message','Sub Category update successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Change Menu Status the specified resource.
     */
    public function changeSubCategoryFilterStatus($id)
    {
        try {
            $filter = ProductSubCategory::select('filter_status')->where('id',$id)->first();
            if($filter->filter_status == 'active')
            {
                $filter = 'inActive';
            }
            elseif($filter->filter_status == 'inActive')
            {
                $filter = 'active';
            }
            ProductSubCategory::where('id',$id)->update(['filter_status' => $filter ]);
            return back()->with('message','Selected sub category menu status changed successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }
    /**
     * Change Status the specified resource.
     */

    public function changeSubCategoryStatus($id)
    {
        try {
            $product_sub_category = ProductSubCategory::select('status')->where('id',$id)->first();
            if($product_sub_category->status == 'active')
            {
                $status = 'inActive';
            }
            elseif($product_sub_category->status == 'inActive')
            {
                $status = 'active';
            }
            ProductSubCategory::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected sub category status changed successfully.');
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
            ProductSubCategory::deleteProductSubCategory($id);
            return redirect('/admin/product-sub-category')->with('message','Sub Category delete successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }
}
