<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class ProductBrand extends Model
{
    use HasFactory;

    private static $product_brand, $product_brands;
    protected $fillable = ['name'];

    public static function createProductBrand($request)
    {
        try {
            self::$product_brand       = new ProductBrand();
            self::saveBasicInfo(self::$product_brand, $request);
            self::$product_brand->save();
            return self::$product_brand;
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function updateProductBrand($request, $id)
    {
        try {
            self::$product_brand = ProductBrand::find($id);
            self::saveBasicInfo(self::$product_brand, $request);
            self::$product_brand->update();
            return self::$product_brand;
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function deleteProductBrand($id)
    {
        try {
            self::$product_brand = ProductBrand::find($id);
            self::$product_brand->delete();
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function($product_brand){
            $product_brand->product_brand_slug = Str::slug($product_brand->name, '-');
        });
        self::updating(function($product_brand){
            $product_brand->product_brand_slug = Str::slug($product_brand->name, '-');
        });
    }

    private static function saveBasicInfo($product_brand, $request)
    {
        self::$product_brand->name                   = $request->name;
    }

}
