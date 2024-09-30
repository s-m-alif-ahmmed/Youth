<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ProductSize extends Model
{
    use HasFactory;

    private static $product_size, $product_sizes;

    public static function createProductSize($request)
    {
        try {
            self::$product_size       = new ProductSize();
            self::saveBasicInfo(self::$product_size, $request);
            self::$product_size->save();
            return self::$product_size;
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function updateProductSize($request, $id)
    {
        try {
            self::$product_size = ProductSize::find($id);
            self::saveBasicInfo(self::$product_size, $request);
            self::$product_size->update();
            return self::$product_size;
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function deleteProductSize($id)
    {
        try {
            self::$product_size = ProductSize::find($id);
            self::$product_size->delete();
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }


    private static function saveBasicInfo($product_size, $request)
    {
        self::$product_size->type_name              = $request->type_name;
        self::$product_size->name                   = $request->name;
    }

}
