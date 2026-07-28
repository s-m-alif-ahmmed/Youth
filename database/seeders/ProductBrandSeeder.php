<?php

namespace Database\Seeders;

use App\Models\Admin\ProductBrand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductBrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            'Youth Exclusive',
            'Urban Culture',
            'Raw Denim Co.',
            'Apex Streetwear',
            'Vibe Edition',
        ];

        foreach ($brands as $brandName) {
            ProductBrand::updateOrCreate(
                ['name' => $brandName],
                [
                    'name'               => $brandName,
                    'product_brand_slug' => Str::slug($brandName, '-'),
                    'status'             => 'active',
                    'filter_status'      => 'active',
                ]
            );
        }
    }
}
