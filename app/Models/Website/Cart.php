<?php

namespace App\Models\Website;

use App\Models\Admin\Product;
use App\Models\Admin\ProductColor;
use App\Models\Admin\ProductSize;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;

    private static $cart, $carts;

    public static function createCart($request)
    {
        try {
            self::$cart = new Cart();
            self::saveBasicInfo(self::$cart, $request);
            self::$cart->save();
            return self::$cart;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateCart($request, $id)
    {
        try {
            self::$cart = Cart::find($id);
            self::saveBasicInfo(self::$cart, $request);
            self::$cart->save();
            return self::$cart;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteCart($id)
    {
        try {
            self::$cart = Cart::find($id);
            self::$cart->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    private static function saveBasicInfo($cart, $request)
    {
        $cart->user_id                = $request->user_id;
        $cart->product_id             = $request->product_id;
        $cart->quantity               = $request->quantity;
        // Check if product_size_id is present and assign it, otherwise set it to null
        $cart->product_size_id = $request->has('product_size_id') ? $request->product_size_id : null;

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productSize()
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id');
    }

}
