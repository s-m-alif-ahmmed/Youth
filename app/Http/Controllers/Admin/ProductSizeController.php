<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductSize;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.product-size.index',[
                'product_sizes' => ProductSize::all(),
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
            return view('admin.crud.product-size.create');
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
            ProductSize::createProductSize($request);
            return redirect('/admin/product-size')->with('message','Size create successfully.');
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
            $decryptID = Crypt::decryptString($id);
            return view('admin.crud.product-size.edit', [
                'product_size' => ProductSize::where('id', $decryptID)->first(),
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
            ProductSize::updateProductSize($request, $id);
            return redirect('/admin/product-size')->with('message','Size update successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Change Status the specified resource.
     */

    public function changeSizeStatus($id)
    {
        try {
            $product_size = ProductSize::select('status')->where('id',$id)->first();
            if($product_size->status == 'active')
            {
                $status = 'inActive';
            }
            elseif($product_size->status == 'inActive')
            {
                $status = 'active';
            }
            ProductSize::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected size status changed successfully.');
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
            ProductSize::deleteProductSize($id);
            return back()->with('message','Size delete successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }
}
