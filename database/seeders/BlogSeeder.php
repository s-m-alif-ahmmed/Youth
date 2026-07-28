<?php

namespace Database\Seeders;

use App\Models\Admin\Blog;
use App\Models\Admin\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = BlogCategory::all();

        $blogs = [
            [
                'title'             => 'The Ultimate Guide to Oversized Streetwear Fit in 2026',
                'category_name'     => 'Streetwear Fashion Trends',
                'short_description' => 'Master the art of wearing oversized tees, hoodies, and cargo pants with clean proportions and effortless confidence.',
                'description'       => '<p>Oversized streetwear remains a powerhouse in urban fashion. In this guide, we break down how to choose the right shoulder drop, sleeve length, and fabric weight so your silhouette stays intentional and high-fashion rather than sloppy.</p><p>Key rule: Balance oversized tops with clean tapered or relaxed straight bottoms for an aesthetically pleasing visual harmony.</p>',
            ],
            [
                'title'             => '5 Essential Jackets Every Urban Wardrobe Needs This Winter',
                'category_name'     => 'Styling & Outfit Ideas',
                'short_description' => 'From acid-washed denim truckers to heavy fleece zip hoodies, discover the versatile outer layers for everyday street looks.',
                'description'       => '<p>Winter layering is where streetwear shines brightest. Mix texture, contrast colors, and elevate basic tees with high-impact jackets engineered for warmth and modern street credibility.</p>',
            ],
            [
                'title'             => 'How to Maintain Heavyweight Cotton Tees & Prevent Print Cracking',
                'category_name'     => 'Product Care & Fabric Guide',
                'short_description' => 'Extend the lifespan of your favorite graphic tees with these essential washing and storage techniques.',
                'description'       => '<p>High quality streetwear apparel deserves proper care. Always wash inside out with cold water, avoid harsh bleach, and line dry in shade to preserve vibrant screen prints and prevent collar stretching.</p>',
            ],
        ];

        foreach ($blogs as $index => $b) {
            $cat = $categories->where('name', $b['category_name'])->first() ?? $categories->first();
            $slug = Str::slug($b['title']);
            $img = SeederHelper::getExistingImage('blog', $index, $b['title']);

            Blog::updateOrCreate(
                ['title' => $b['title']],
                [
                    'category_id'       => $cat?->id,
                    'meta_title'        => $b['title'] . ' | Youth Blog',
                    'meta_description'  => $b['short_description'],
                    'image'             => $img,
                    'alt'               => $b['title'],
                    'title'             => $b['title'],
                    'short_description' => $b['short_description'],
                    'description'       => $b['description'],
                    'slug'              => $slug,
                    'status'            => 'Publish',
                ]
            );
        }
    }
}
