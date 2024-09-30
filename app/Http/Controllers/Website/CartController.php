<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Website\Cart;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Log;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $carts = Cart::where('user_id', auth()->id())->get();
            $productCount = $carts->count();

            return view('website.home.add-cart',[
                'carts' => $carts,
            ],compact('productCount'));
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    public function store(Request $request)
    {
        try {
            $userId = $request->user_id;
            $productId = $request->product_id;
            $quantity = $request->quantity;
            $product_size_id = $request->product_size_id;

            $product = Product::find($productId);

            // Validate quantity and conditionally validate color and size
            $validated = $request->validate([
                'quantity' => 'required|integer|min:1',
                'product_size_id' => $product->sizes->isNotEmpty() ? 'required' : 'nullable',
            ], [
                'product_size_id.required' => 'Please select a size.',
            ]);

            // Check if the product exists
            if (!$product) {
                return back()->withErrors(['message' => 'Product not found.'])->withInput();
            }
            // Check if the product quantity is greater than 0
            if ($quantity <= 0) {
                return back()->withErrors(['quantity' => 'This product is stock out.'])->withInput();
            }
            // Check if the requested quantity is greater than the available stock
            if ($quantity > $product->stock) {
                return back()->withErrors(['quantity' => 'Requested quantity exceeds available stock.'])->withInput();
            }

            // Check if the product already exists in the cart
            $cart = Cart::where('user_id', $userId)
                ->where('product_id', $productId)
                ->where('product_size_id', $product_size_id)
                ->first();

            if ($cart) {
                // If product exists in cart with the same color and size, update the quantity
                $newQuantity = $cart->quantity + $quantity;

                // Check if the new quantity exceeds the available stock
                if ($newQuantity > $product->stock) {
                    return back()->withErrors(['quantity' => 'Total quantity in cart exceeds available stock.'])->withInput();
                }

                $cart->quantity = $newQuantity;
                $cart->save();
            } else {
                // If product does not exist in cart with the same color and size, create a new cart item
                Cart::createCart($request);
            }

            return redirect('/youth/cart/show')->with('message', 'Product added to cart successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    public function buyNow(Request $request)
    {
        try {
            $validated = $request->validate([
                'quantity' => 'required|min:1',
            ]);

            $userId = $request->user_id;
            $productId = $request->product_id;
            $quantity = $request->quantity;
            $product_size_id = $request->product_size_id;

            $product = Product::find($productId);

            // Check if the product exists
            if (!$product) {
                return back()->withErrors(['message' => 'Product not found.'])->withInput();
            }
            // Check if the product quantity is greater than 0
            if ($quantity <= 0) {
                return back()->withErrors(['quantity' => 'This product is stock out.'])->withInput();
            }
            // Check if the requested quantity is greater than the available stock
            if ($quantity > $product->stock) {
                return back()->withErrors(['quantity' => 'Requested quantity exceeds available stock.'])->withInput();
            }

            // Check if the product already exists in the cart
            $cart = Cart::where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if ($cart) {
                // If product exists in cart, update the quantity
                $cart->quantity += $quantity;
                if ($cart->product_size_id)
                    $cart->product_size_id = $product_size_id;
                else
                $cart->save();
            } else {
                // If product does not exist in cart, create a new cart item
                Cart::createCart($request);
            }

            return redirect('/youth/order/information')->with('message', 'Product added to cart successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateQuantity(Request $request, $id)
    {
        \Log::info('Received request: ', $request->all());

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        \Log::info('Received product_id: ' . $product_id);
        \Log::info('Received quantity: ' . $quantity);

        $cart = Cart::find($id);
        if ($cart) {
            $cart->quantity = $quantity;
            $cart->save();
            return back()->with('message','Product quantity updated successfully.');
        } else {
            return back()->with('message','Product Cart item not found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Cart::deleteCart($id);
            return back()->with('message','Product removed from cart successfully.');
        } catch (DecryptException $e) {
            return view('error_pages.error');
        }
    }
}
