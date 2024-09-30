<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductColor extends Model
{
    use HasFactory;

    private static $product_color, $product_colors;

    public static function createProductColor($request)
    {
        try {
            self::$product_color       = new ProductColor();
            self::saveBasicInfo(self::$product_color, $request);
            self::$product_color->save();
            return self::$product_color;
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function updateProductColor($request, $id)
    {
        try {
            self::$product_color = ProductColor::find($id);
            self::saveBasicInfo(self::$product_color, $request);
            self::$product_color->update();
            return self::$product_color;
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function deleteProductColor($id)
    {
        try {
            self::$product_color = ProductColor::find($id);
            self::$product_color->delete();
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }


    private static function saveBasicInfo($product_color, $request)
    {
        self::$product_color->name                   = $request->name;
    }

}
