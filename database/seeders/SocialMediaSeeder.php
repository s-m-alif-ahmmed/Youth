<?php

namespace Database\Seeders;

use App\Models\Admin\SocialMedia;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    public function run(): void
    {
        $socials = [
            [
                'name'       => 'Facebook',
                'link'       => 'https://facebook.com',
                'icon'       => 'fa-brands fa-facebook-f',
                'color'      => '#ffffff',
                'back_color' => '#1877f2',
                'status'     => 'active',
            ],
            [
                'name'       => 'Instagram',
                'link'       => 'https://instagram.com',
                'icon'       => 'fa-brands fa-instagram',
                'color'      => '#ffffff',
                'back_color' => '#e4405f',
                'status'     => 'active',
            ],
            [
                'name'       => 'Twitter',
                'link'       => 'https://twitter.com',
                'icon'       => 'fa-brands fa-x-twitter',
                'color'      => '#ffffff',
                'back_color' => '#000000',
                'status'     => 'active',
            ],
            [
                'name'       => 'YouTube',
                'link'       => 'https://youtube.com',
                'icon'       => 'fa-brands fa-youtube',
                'color'      => '#ffffff',
                'back_color' => '#ff0000',
                'status'     => 'active',
            ],
        ];

        foreach ($socials as $social) {
            SocialMedia::updateOrCreate(['name' => $social['name']], $social);
        }
    }
}
