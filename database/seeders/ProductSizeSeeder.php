<?php

namespace Database\Seeders;

use App\Models\Admin\ProductSize;
use Illuminate\Database\Seeder;

class ProductSizeSeeder extends Seeder
{
    public function run(): void
    {
        $sizes = [
            ['type_name' => 'Clothing', 'name' => 'S', 'status' => 'active'],
            ['type_name' => 'Clothing', 'name' => 'M', 'status' => 'active'],
            ['type_name' => 'Clothing', 'name' => 'L', 'status' => 'active'],
            ['type_name' => 'Clothing', 'name' => 'XL', 'status' => 'active'],
            ['type_name' => 'Clothing', 'name' => 'XXL', 'status' => 'active'],
        ];

        foreach ($sizes as $size) {
            ProductSize::updateOrCreate(['name' => $size['name']], $size);
        }
    }
}
