<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BlogCategory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.blog.category.manage',[
                'blog_categories' => BlogCategory::all(),
            ]);
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.crud.blog.category.index');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $blog_category = BlogCategory::createBlogCategory($request);
            return back()->with('message', 'Blog Category saved successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            $blog_category = BlogCategory::find($decryptID);
            return view('admin.crud.blog.category.detail',[
                'blog_category' => $blog_category,
            ]);
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            $blog_category = BlogCategory::find($decryptID);
            return view('admin.crud.blog.category.edit',[
                'blog_category' => $blog_category,
            ]);
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);
            $blog_category = BlogCategory::updateBlogCategory($request, $decryptID);
            return back()->with('message','Blog update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeBlogCategoryStatus($id)
    {
        try {
            $blog_category = BlogCategory::select('status')->where('id',$id)->first();
            if($blog_category->status == 'active')
            {
                $status = 'inActive';
            }
            elseif($blog_category->status == 'inActive')
            {
                $status = 'active';
            }
            BlogCategory::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected blog category status changed successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            BlogCategory::deleteBlogCategory($id);
            return back()->with('message','Blog category delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
}
