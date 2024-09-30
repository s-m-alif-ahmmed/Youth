<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    use HasFactory;

    private static $blog_category, $blog_categories;

    public static function createBlogCategory($request)
    {
        try {
            self::$blog_category       = new BlogCategory();
            self::saveBasicInfo(self::$blog_category, $request);
            self::$blog_category->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }

    }

    public static function updateBlogCategory($request, $id)
    {
        try {
            self::$blog_category = BlogCategory::find($id);
            self::saveBasicInfo(self::$blog_category, $request);
            self::$blog_category->save();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteBlogCategory($id)
    {
        try {
            self::$blog_category = BlogCategory::find($id);
            self::$blog_category->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function($blog_category){
            $blog_category->blog_category_slug = Str::slug($blog_category->name, '-');
        });
        self::updating(function($blog_category){
            $blog_category->blog_category_slug = Str::slug($blog_category->name, '-');
        });
    }


    private static function saveBasicInfo($blog_category, $request)
    {
        self::$blog_category->name       = $request->name;
    }

    public function blogs()
    {
        return $this->belongsToMany(Blog::class);
    }
    public function blog()
    {
        return $this->belongsToMany(Blog::class);
    }

    public function blogCategories()
    {
        return $this->belongsToMany(Blog::class);
    }

    public function blog_categories()
    {
        return $this->belongsToMany(Blog::class);
    }

    public function blog_category()
    {
        return $this->belongsToMany(Blog::class);
    }


}
