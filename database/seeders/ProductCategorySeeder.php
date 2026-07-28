<?php

namespace Database\Seeders;

use App\Models\Admin\Menu;
use App\Models\Admin\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $summerMenu = Menu::where('name', 'Summer Collection')->first();
        $winterMenu = Menu::where('name', 'Winter Collection')->first();
        $exclusiveMenu = Menu::where('name', 'Streetwear Exclusive')->first();

        $categories = [
            [
                'menu_id'       => $summerMenu?->id,
                'name'          => 'T-Shirts & Tanks',
                'feature_image' => SeederHelper::getExistingImage('category', 0, 'T-Shirts & Tanks'),
                'feature_alt'   => 'T-Shirts & Tanks',
                'page_image'    => SeederHelper::getExistingImage('category', 1, 'T-Shirts & Tanks Banner'),
                'page_alt'      => 'T-Shirts & Tanks Banner',
                'status'        => 'active',
            ],
            [
                'menu_id'       => $summerMenu?->id,
                'name'          => 'Casual Shirts',
                'feature_image' => SeederHelper::getExistingImage('category', 2, 'Casual Shirts'),
                'feature_alt'   => 'Casual Shirts',
                'page_image'    => SeederHelper::getExistingImage('category', 3, 'Casual Shirts Banner'),
                'page_alt'      => 'Casual Shirts Banner',
                'status'        => 'active',
            ],
            [
                'menu_id'       => $winterMenu?->id,
                'name'          => 'Jackets & Hoodies',
                'feature_image' => SeederHelper::getExistingImage('category', 4, 'Jackets & Hoodies'),
                'feature_alt'   => 'Jackets & Hoodies',
                'page_image'    => SeederHelper::getExistingImage('category', 5, 'Jackets & Hoodies Banner'),
                'page_alt'      => 'Jackets & Hoodies Banner',
                'status'        => 'active',
            ],
            [
                'menu_id'       => $winterMenu?->id,
                'name'          => 'Jeans & Cargo Pants',
                'feature_image' => SeederHelper::getExistingImage('category', 6, 'Jeans & Cargo Pants'),
                'feature_alt'   => 'Jeans & Cargo Pants',
                'page_image'    => SeederHelper::getExistingImage('category', 7, 'Jeans & Cargo Pants Banner'),
                'page_alt'      => 'Jeans & Cargo Pants Banner',
                'status'        => 'active',
            ],
            [
                'menu_id'       => $exclusiveMenu?->id,
                'name'          => 'Streetwear Accessories',
                'feature_image' => SeederHelper::getExistingImage('category', 0, 'Streetwear Accessories'),
                'feature_alt'   => 'Streetwear Accessories',
                'page_image'    => SeederHelper::getExistingImage('category', 1, 'Accessories Banner'),
                'page_alt'      => 'Accessories Banner',
                'status'        => 'active',
            ],
        ];

        foreach ($categories as $cat) {
            ProductCategory::updateOrCreate(['name' => $cat['name']], $cat);
        }
    }
}
