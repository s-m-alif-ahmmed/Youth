<?php

namespace App\Models\Admin;

use App\Models\Admin\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Comment extends Model
{
    use HasFactory;

    private static $comment, $comments;

    public static function createComment($request)
    {
        try {
            self::$comment = new Comment();
            self::saveBasicInfo(self::$comment, $request);
            self::$comment->save();
            return self::$comment;
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

//    public static function updateComment($request, $id)
//    {
//        try {
//            self::$comment = Comment::find($id);
//            self::saveBasicInfo(self::$comment, $request);
//            self::$comment->save();
//            return self::$comment;
//        } catch (ModelNotFoundException $e) {
//            abort(404);
//        }
//    }

    public static function deleteComment($id)
    {
        try {
            self::$comment = Comment::find($id);
            self::$comment->delete();
        } catch (ModelNotFoundException $e) {
            abort(404);
        }
    }

    private static function saveBasicInfo($comment, $request)
    {
        self::$comment->user_id            = $request->user_id;
        self::$comment->blog_id            = $request->blog_id;
        self::$comment->parent_id          = $request->parent_id;
        self::$comment->name               = $request->name;
        self::$comment->email              = $request->email;
        self::$comment->comment            = $request->comment;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

}
