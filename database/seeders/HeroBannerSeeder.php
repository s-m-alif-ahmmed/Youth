<?php

namespace Database\Seeders;

use App\Models\Admin\HeroBanner;
use Illuminate\Database\Seeder;

class HeroBannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'image'        => SeederHelper::getExistingImage('hero-banner', 0, 'Summer Drop Banner 2026'),
                'alt'          => 'Summer Drop Banner 2026',
                'status'       => 'active',
                'first_status' => 'active',
            ],
            [
                'image'        => SeederHelper::getExistingImage('hero-banner', 1, 'Premium Streetwear Collection Banner'),
                'alt'          => 'Premium Streetwear Collection Banner',
                'status'       => 'active',
                'first_status' => 'off',
            ],
        ];

        foreach ($banners as $banner) {
            HeroBanner::updateOrCreate(['alt' => $banner['alt']], $banner);
        }
    }
}
