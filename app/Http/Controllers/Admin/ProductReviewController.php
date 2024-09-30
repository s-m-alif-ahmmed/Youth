<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\ProductReview;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ProductReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.product-review.index',[
                'product_reviews' => ProductReview::all(),
            ]);
        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        try {
            $user_id = Auth::user()->id;
            $product_id = Product::find($id);
            return view('website.home.product-detail',compact('user_id','product_id'));
        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'star' => 'required|integer|between:1,5',
                'product_review' => 'required',
            ]);

            $user_id = $request->user_id;
            $product_id = $request->product_id;

            // Check if the user has already reviewed the product
            $existingReview = ProductReview::where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->first();

            if ($existingReview) {
                return back()->with('message', 'You have already reviewed this product.');
            }else{
                ProductReview::createProductReview($request);
                return back()->with('message', 'Product Review send successfully.');
            }

        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);

            return view('admin.crud.product-review.detail', [
                'product_review' => ProductReview::find($decryptID),
            ]);

        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeProductReviewStatus($id)
    {
        try {
            $product_review = ProductReview::select('status')->where('id',$id)->first();
            if($product_review->status == 'active')
            {
                $status = 'inActive';
            }
            elseif($product_review->status == 'inActive')
            {
                $status = 'active';
            }
            ProductReview::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected product review status changed successfully.');
        } catch (DecryptException $e) {
            return abort(404);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            ProductReview::deleteProductReview($id);
            return back()->with('message','Product Review delete successfully.');
        } catch (DecryptException $e) {
            return abort(404);
        }
    }
}
