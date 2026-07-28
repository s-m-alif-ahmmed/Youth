<?php

namespace Database\Seeders;

use App\Models\Admin\Blog;
use App\Models\Admin\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('role', 'user')->first() ?? User::first();
        $blog = Blog::first();

        if ($user && $blog) {
            Comment::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'blog_id' => $blog->id,
                ],
                [
                    'user_id'   => $user->id,
                    'blog_id'   => $blog->id,
                    'parent_id' => null,
                    'name'      => $user->name,
                    'email'     => $user->email,
                    'comment'   => 'Super helpful fashion tips! Loved the advice on oversized silhouettes.',
                    'status'    => 'active',
                ]
            );
        }
    }
}
