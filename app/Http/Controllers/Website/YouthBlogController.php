<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use App\Models\Admin\BlogCategory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;

class YouthBlogController extends Controller
{
    public function blogCategory($blog_category_slug){
        try {
            $category = BlogCategory::where('blog_category_slug', $blog_category_slug)->where('status', 'active')->first();

            if (!$category) {
                return abort(404);
            }

            $blogs = Blog::where('category_id', $category->id)->where('status', 'Publish')->paginate(12);
            $categories = BlogCategory::where('status', 'active')->get();

            return view('website.home.blog.blogs', [
                'categories' => $categories,
                'blogs' => $blogs,
                'category' => $category,
            ]);
        } catch (\Exception $e) {
            return abort(404);
        }
    }

    public function blog(){
        try {
            $blog_categories = BlogCategory::all();
            $blogs = Blog::where('status', 'Publish')->paginate(12);
            return view('website.home.blog.index',[
                'blog_categories' => $blog_categories,
                'blogs' => $blogs,
            ]);
        }catch (DecryptException $e) {
            return abort(404);
        }
    }

    public function blogDetail($slug){
        try {
            $blog_categories = BlogCategory::all();
            $blog = Blog::where('slug', $slug)->first();

          //  Share
        $shareButtons = \Share::page(
            url(url()->current()),
        )
            ->facebook()
            ->whatsapp()
            ->twitter()
            ->pinterest()
            ->linkedin();

            return view('website.home.blog.details',[
                'blog_categories' => $blog_categories,
                'blog' => $blog,
                'shareButtons' => $shareButtons,
            ]);
        }catch (DecryptException $e) {
            return abort(404);
        }
    }
}
