<?php

namespace Database\Seeders;

use App\Models\Admin\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Streetwear Fashion Trends',
            'Styling & Outfit Ideas',
            'Product Care & Fabric Guide',
            'Youth Culture & Stories',
        ];

        foreach ($categories as $name) {
            BlogCategory::updateOrCreate(
                ['name' => $name],
                [
                    'name'               => $name,
                    'blog_category_slug' => Str::slug($name),
                    'status'             => 'active',
                ]
            );
        }
    }
}
