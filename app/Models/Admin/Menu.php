<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;


    private static $menu, $menus;
    private static $image, $directory, $imageName, $imageUrl;
    protected $fillable = ['name', 'image', 'alt'];


    public static function uploadImage($request)
    {
        try {
            self::$image = $request->file('image');
            self::$imageName = rand(10000, 20000).self::$image->getClientOriginalName();
            self::$directory = "admin/images/menu/";
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;
            return self::$directory.self::$imageName;
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function createMenu($request)
    {
        try {
            self::$imageUrl = self::uploadImage($request);
            self::$menu       = new Menu();
            self::saveBasicInfo(self::$menu, $request, self::$imageUrl);
            self::$menu->save();
            return self::$menu;
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function updateMenu($request, $id)
    {
        try {
            self::$menu = Menu::find($id);
            if($request->file('image'))
            {
                if(file_exists(self::$menu->image)){
                    unlink(self::$menu->image);
                }
                self::$imageUrl = self::uploadImage($request);
            }
            else{
                self::$imageUrl = self::$menu->image;
            }

            self::saveBasicInfo(self::$menu, $request, self::$imageUrl);
            self::$menu->update();
            return self::$menu;
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function deleteMenu($id)
    {
        try {
            self::$menu = Menu::find($id);
            if (file_exists(self::$menu->image))
            {
                unlink(self::$menu->image);
            }
            if (file_exists(self::$menu->image))
            {
                unlink(self::$menu->image);
            }

            // Delete related designations
//            self::$product_category->productSubCategories()->delete();

            // Delete subcategories and their images
            foreach (self::$menu->productCategories as $category) {
                if (file_exists($category->image)) {
                    unlink($category->image);
                }
                $category->delete();
            }

            self::$menu->delete();
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function($menu){
            $menu->menu_slug = Str::slug($menu->name, '-');
        });
        self::updating(function($menu){
            $menu->menu_slug = Str::slug($menu->name, '-');
        });
    }

    private static function saveBasicInfo($menu, $request, $imageUrl)
    {
        self::$menu->name           = $request->name;
        self::$menu->image          = $imageUrl;
        self::$menu->alt            = $request->alt;
    }

    public function productCategories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    public function productSubCategories()
    {
        return $this->hasMany(ProductSubCategory::class);
    }


    public function product()
    {
        return $this->hasMany(Product::class);
    }


}
