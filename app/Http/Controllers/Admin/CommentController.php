<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use App\Models\Admin\Comment;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function blogCommentManage()
    {
        try {
            $comments = Comment::with('parent')->get();
            return view('admin.crud.blog.comment.index', compact('comments'));
        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        try {
            $user_id = Auth::user()->id;
            $blog_id = Blog::find($id);
            return view('website.home.details',compact('user_id','blog_id'));
        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Comment::createComment($request);
            return back()->with('comment', 'Comment send successfully.');
        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function blogCommentDetail(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);

            return view('admin.crud.blog.comment.detail', [
                'comment' => Comment::find($decryptID),
            ]);

        } catch (DecryptException $e) {
            return abort(404);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $decryptID = Crypt::decryptString($id);

            return view('website.blog.details', [
                'comment' => Comment::find($decryptID),
            ]);
        } catch (DecryptException $e) {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Assuming the comment ID is already decrypted
            $comment = Comment::find($id);

            if (!$comment) {
                return abort(404); // Comment not found
            }

            // Check if the authenticated user is the owner of the comment
            if (auth()->user()->id !== $comment->user_id) {
                return abort(403); // Unauthorized
            }

            // Update the comment
            $comment->comment = $request->input('comment');
            $comment->save();

            return back()->with('comment', 'Comment updated successfully.');
        } catch (DecryptException $e) {
            return abort(404);
        }
    }


    /**
     * Change Status the specified resource.
     */
    public function changeBlogCommentStatus($id)
    {
        try {
            $comment = Comment::select('status')->where('id',$id)->first();
            if($comment->status == 'active')
            {
                $commentStatus = 'inActive';
            }
            elseif($comment->status == 'inActive')
            {
                $commentStatus = 'active';
            }
            Comment::where('id',$id)->update(['status' => $commentStatus ]);
            return back()->with('comment','Selected comment status changed successfully.');
        } catch (DecryptException $e) {
            return abort(404);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Comment::deleteComment($id);
            return back()->with('comment','Comment delete successfully.');
        } catch (DecryptException $e) {
            return abort(404);
        }
    }
}
