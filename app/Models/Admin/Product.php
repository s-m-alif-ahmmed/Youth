<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    private static $product, $products;
    private static $image, $directory, $imageName, $imageUrl;
    protected $fillable = ['name'];


    public static function uploadImage($request)
    {
        try {
            self::$image = $request->file('image');
            self::$imageName = rand(10000, 20000).self::$image->getClientOriginalName();
            self::$directory = "admin/images/product/product/";
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;
            return self::$directory.self::$imageName;
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function createProduct($request)
    {
        try {
            self::$imageUrl      = self::uploadImage($request);
            self::$product       = new Product();
            self::saveBasicInfo(self::$product, $request, self::$imageUrl);
            self::$product->save();
            // Attach sizes and colors
            if ($request->has('product_size_id')) {
                self::$product->sizes()->attach($request->product_size_id);
            }
            return self::$product;
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function updateProduct($request, $id)
    {
        try {
            self::$product = Product::find($id);
            if($request->file('image'))
            {
                if(file_exists(self::$product->image)){
                    unlink(self::$product->image);
                }
                self::$imageUrl = self::uploadImage($request);
            }
            else{
                self::$imageUrl = self::$product->image;
            }
            // Sync sizes
            self::$product->sizes()->sync($request->input('product_size_id', []));

            self::saveBasicInfo(self::$product, $request, self::$imageUrl);
            self::$product->save();
            return self::$product;
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function deleteProduct($id)
    {
        try {
            self::$product = Product::find($id);
            if (file_exists(self::$product->image))
            {
                unlink(self::$product->image);
            }
            self::$product->delete();
        } catch (ModelNotFoundException $e) {
            return view('error_pages.error');
        }
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function($product){
            $product->product_slug = Str::slug($product->name, '-');
        });
        self::updating(function($product){
            $product->product_slug = Str::slug($product->name, '-');
        });
    }

    private static function saveBasicInfo($product, $request, $imageUrl)
    {
        self::$product->menu_id                        = $request->menu_id;
        self::$product->product_category_id            = $request->product_category_id;
        self::$product->product_brand_id               = $request->product_brand_id;
        self::$product->offer_id                       = $request->offer_id ?: null;
        self::$product->event_id                       = $request->event_id ?: null;
        self::$product->meta_title                     = $request->meta_title;
        self::$product->meta_description               = $request->meta_description;
        self::$product->name                           = $request->name;
        self::$product->stock                          = $request->stock;
        self::$product->discount                       = $request->discount;
        self::$product->regular_price                  = $request->regular_price;
        self::$product->selling_price                  = $request->selling_price;
        self::$product->description                    = $request->description;
        self::$product->image                          = $imageUrl;
        self::$product->alt                            = $request->alt;
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productBrand()
    {
        return $this->belongsTo(ProductBrand::class);
    }

    public function productSize()
    {
        return $this->belongsTo(ProductSize::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(ProductSize::class, 'product_size_product');
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function otherImages()
    {
        return $this->hasMany(OtherImage::class);
    }

    public function product_reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

}
