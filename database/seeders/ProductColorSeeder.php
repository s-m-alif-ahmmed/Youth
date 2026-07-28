<?php

namespace Database\Seeders;

use App\Models\Admin\ProductColor;
use Illuminate\Database\Seeder;

class ProductColorSeeder extends Seeder
{
    public function run(): void
    {
        $colors = [
            ['name' => 'Pitch Black', 'status' => 'active'],
            ['name' => 'Off White', 'status' => 'active'],
            ['name' => 'Midnight Blue', 'status' => 'active'],
            ['name' => 'Crimson Red', 'status' => 'active'],
            ['name' => 'Olive Drab', 'status' => 'active'],
        ];

        foreach ($colors as $color) {
            ProductColor::updateOrCreate(['name' => $color['name']], $color);
        }
    }
}
