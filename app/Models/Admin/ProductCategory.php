<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    use HasFactory;

    private static $product_category, $product_categories;
    private static $image, $directory, $imageName, $imageUrl;
    protected $fillable = ['name', 'feature_image', 'feature_alt'];


    public static function uploadFeatureImage($request)
    {
        try {
            self::$image = $request->file('feature_image');
            self::$imageName = rand(10000, 20000).self::$image->getClientOriginalName();
            self::$directory = "admin/images/category/";
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;
            return self::$directory.self::$imageName;
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function createProductCategory($request)
    {
        try {
            self::$imageUrl = self::uploadFeatureImage($request);
            self::$product_category       = new ProductCategory();
            self::saveBasicInfo(self::$product_category, $request, self::$imageUrl);
            self::$product_category->save();
            return self::$product_category;
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function updateProductCategory($request, $id)
    {
        try {
            self::$product_category = ProductCategory::find($id);
            if($request->file('feature_image'))
            {
                if(file_exists(self::$product_category->feature_image)){
                    unlink(self::$product_category->feature_image);
                }
                self::$imageUrl = self::uploadFeatureImage($request);
            }
            else{
                self::$imageUrl = self::$product_category->feature_image;
            }

            self::saveBasicInfo(self::$product_category, $request, self::$imageUrl);
            self::$product_category->update();
            return self::$product_category;
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function deleteProductCategory($id)
    {
        try {
            self::$product_category = ProductCategory::find($id);
            if (file_exists(self::$product_category->feature_image))
            {
                unlink(self::$product_category->feature_image);
            }

            // Delete related designations
//            self::$product_category->productSubCategories()->delete();

            self::$product_category->delete();
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function($product_category){
            $product_category->product_category_slug = Str::slug($product_category->name, '-');
        });
        self::updating(function($product_category){
            $product_category->product_category_slug = Str::slug($product_category->name, '-');
        });
    }

    private static function saveBasicInfo($product_category, $request, $imageUrl)
    {
        self::$product_category->menu_id                = $request->menu_id;
        self::$product_category->name                   = $request->name;
        self::$product_category->feature_image          = $imageUrl;
        self::$product_category->feature_alt            = $request->feature_alt;
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

}
