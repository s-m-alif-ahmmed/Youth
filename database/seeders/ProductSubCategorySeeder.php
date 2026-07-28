<?php

namespace Database\Seeders;

use App\Models\Admin\Menu;
use App\Models\Admin\ProductCategory;
use App\Models\Admin\ProductSubCategory;
use Illuminate\Database\Seeder;

class ProductSubCategorySeeder extends Seeder
{
    public function run(): void
    {
        $tshirtCategory = ProductCategory::where('name', 'T-Shirts & Tanks')->first();
        $shirtCategory  = ProductCategory::where('name', 'Casual Shirts')->first();
        $jacketCategory = ProductCategory::where('name', 'Jackets & Hoodies')->first();
        $pantsCategory  = ProductCategory::where('name', 'Jeans & Cargo Pants')->first();

        $subCategories = [
            [
                'menu_id'             => $tshirtCategory?->menu_id,
                'product_category_id' => $tshirtCategory?->id,
                'name'                => 'Oversized Heavyweight Tees',
                'image'               => SeederHelper::getExistingImage('sub-category', 0, 'Oversized Tees'),
                'alt'                 => 'Oversized Heavyweight Tees',
                'status'              => 'active',
                'filter_status'       => 'active',
            ],
            [
                'menu_id'             => $tshirtCategory?->menu_id,
                'product_category_id' => $tshirtCategory?->id,
                'name'                => 'Graphic Printed Tees',
                'image'               => SeederHelper::getExistingImage('sub-category', 1, 'Graphic Printed Tees'),
                'alt'                 => 'Graphic Printed Tees',
                'status'              => 'active',
                'filter_status'       => 'active',
            ],
            [
                'menu_id'             => $shirtCategory?->menu_id,
                'product_category_id' => $shirtCategory?->id,
                'name'                => 'Cuban Collar Shirts',
                'image'               => SeederHelper::getExistingImage('sub-category', 0, 'Cuban Collar Shirts'),
                'alt'                 => 'Cuban Collar Shirts',
                'status'              => 'active',
                'filter_status'       => 'active',
            ],
            [
                'menu_id'             => $jacketCategory?->menu_id,
                'product_category_id' => $jacketCategory?->id,
                'name'                => 'Zip-Up Oversized Hoodies',
                'image'               => SeederHelper::getExistingImage('sub-category', 1, 'Zip-Up Hoodies'),
                'alt'                 => 'Zip-Up Oversized Hoodies',
                'status'              => 'active',
                'filter_status'       => 'active',
            ],
            [
                'menu_id'             => $pantsCategory?->menu_id,
                'product_category_id' => $pantsCategory?->id,
                'name'                => 'Tactical Cargo Pants',
                'image'               => SeederHelper::getExistingImage('sub-category', 0, 'Cargo Pants'),
                'alt'                 => 'Tactical Cargo Pants',
                'status'              => 'active',
                'filter_status'       => 'active',
            ],
        ];

        foreach ($subCategories as $subCat) {
            ProductSubCategory::updateOrCreate(['name' => $subCat['name']], $subCat);
        }
    }
}
