<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    private static $blog, $blogs, $image, $directory, $imageName, $imageUrl;

    public static function uploadImage($request)
    {
        try {
            self::$image = $request->file('image');
            self::$imageName = rand(10000, 20000).self::$image->getClientOriginalName();
            self::$directory = "admin/images/blog/";
            self::$image->move(self::$directory, self::$imageName);
            self::$imageUrl = self::$directory.self::$imageName;
            return self::$directory.self::$imageName;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function createBlog($request)
    {
        try {
            self::$imageUrl = self::uploadImage($request);
            self::$blog = new Blog();
            self::saveBasicInfo(self::$blog, $request, self::$imageUrl);
            self::$blog->save();
            return self::$blog;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function updateBlog($request, $id)
    {
        try {
            self::$blog = Blog::find($id);
            if($request->file('image'))
            {
                if(file_exists(self::$blog->image)){
                    unlink(self::$blog->image);
                }
                self::$imageUrl = self::uploadImage($request);
            }
            else{
                self::$imageUrl = self::$blog->image;
            }
            self::saveBasicInfo(self::$blog, $request, self::$imageUrl);
            self::$blog->save();
            return self::$blog;
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    public static function deleteBlog($id)
    {
        try {
            self::$blog = Blog::find($id);
            if (file_exists(self::$blog->image))
            {
                unlink(self::$blog->image);
            }
            self::$blog->delete();
        } catch (ModelNotFoundException $e) {
            return view('admin.error.error');
        }
    }

    private static function saveBasicInfo($blog, $request, $imageUrl)
    {
        $blog->category_id            = $request->category_id;
        $blog->meta_title             = $request->meta_title;
        $blog->meta_description       = $request->meta_description;
        $blog->title                  = $request->title;
        $blog->image                  = $imageUrl;
        $blog->alt                    = $request->alt;
        $blog->short_description      = $request->short_description;
        $blog->description            = $request->description;
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function($blog){
            $blog->slug = Str::slug($blog->title, '-');
        });
        self::updating(function($blog){
            $blog->slug = Str::slug($blog->title, '-');
        });
    }

    public function blog_category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
    public function blog_categories()
    {
        return $this->belongsTo(BlogCategory::class);
    }

}
