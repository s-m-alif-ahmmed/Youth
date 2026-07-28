<?php

namespace Database\Seeders;

use App\Models\Admin\LogoAddress;
use Illuminate\Database\Seeder;

class LogoAddressSeeder extends Seeder
{
    public function run(): void
    {
        $favicon = SeederHelper::getExistingImage('Logo', 0, 'Favicon');
        $logo = SeederHelper::getExistingImage('Logo', 1, 'Logo');
        $footerLogo = SeederHelper::getExistingImage('Logo', 2, 'Footer Logo');

        LogoAddress::updateOrCreate(
            ['id' => 1],
            [
                'favicon'      => $favicon,
                'fav_alt'      => 'Youth Icon',
                'logo'         => $logo,
                'alt'          => 'Youth Brand Logo',
                'footer_image' => $footerLogo,
                'footer_alt'   => 'Youth Footer Logo',
                'address'      => '<p>Holding No: 35/1, Block: B, Lane: 2, Gopta Road, Near Farid Store, Pathantuli, Narayangonj 1400</p>',
                'gmail'        => 'youthbd21@gmail.com',
                'number'       => '01813074038',
                'slogan'       => '<p><strong>YOUTH</strong> is a premium Bangladesh-based streetwear brand creating bold, statement-making apparel for today\'s fashion enthusiasts.</p>',
            ]
        );
    }
}
