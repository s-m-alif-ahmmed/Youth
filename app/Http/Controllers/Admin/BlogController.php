<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use App\Models\Admin\BlogCategory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('admin.crud.blog.blog.manage',[
                'blogs' => Blog::all(),
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
            return view('admin.crud.blog.blog.index',[
                'blog_categories'    => BlogCategory::all(),
            ]);
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
            $blog = Blog::createBlog($request);
            return back()->with('message', 'Blog saved successfully.');
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
            $blog = Blog::find($decryptID);
            return view('admin.crud.blog.blog.detail',[
                'blog' => $blog,
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
            return view('admin.crud.blog.blog.edit',[
                'blog' => Blog::find($decryptID),
                'blog_categories' => BlogCategory::all(),
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
            $blog = Blog::updateBlog($request, $decryptID);
            return back()->with('message','Blog update successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }

    /**
     * Change Status the specified resource.
     */
    public function changeBlogStatus($id)
    {
        try {
            $blog = Blog::select('status')->where('id',$id)->first();
            if($blog->status == 'Publish')
            {
                $status = 'Draft';
            }
            elseif($blog->status == 'Draft')
            {
                $status = 'Publish';
            }
            Blog::where('id',$id)->update(['status' => $status ]);
            return back()->with('message','Selected blog status changed successfully.');
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
            Blog::deleteBlog($id);
            return back()->with('message','Blog delete successfully.');
        } catch (DecryptException $e) {
            return view('admin.error.error');
        }
    }
}
