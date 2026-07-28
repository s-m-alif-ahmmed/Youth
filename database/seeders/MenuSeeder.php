<?php

namespace Database\Seeders;

use App\Models\Admin\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            [
                'name'   => 'Summer Collection',
                'image'  => SeederHelper::getExistingImage('menu', 0, 'Summer Collection'),
                'alt'    => 'Summer Collection',
                'status' => 'active',
            ],
            [
                'name'   => 'Winter Collection',
                'image'  => SeederHelper::getExistingImage('menu', 1, 'Winter Collection'),
                'alt'    => 'Winter Collection',
                'status' => 'active',
            ],
            [
                'name'   => 'Streetwear Exclusive',
                'image'  => SeederHelper::getExistingImage('menu', 2, 'Streetwear Exclusive'),
                'alt'    => 'Streetwear Exclusive',
                'status' => 'active',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::updateOrCreate(['name' => $menu['name']], $menu);
        }
    }
}
