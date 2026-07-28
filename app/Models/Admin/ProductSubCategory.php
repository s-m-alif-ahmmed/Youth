<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductSubCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        self::creating(function($subCategory){
            $subCategory->product_sub_category_slug = Str::slug($subCategory->name, '-');
        });
        self::updating(function($subCategory){
            $subCategory->product_sub_category_slug = Str::slug($subCategory->name, '-');
        });
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'product_sub_category_id');
    }
}
