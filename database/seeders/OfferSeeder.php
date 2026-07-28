<?php

namespace Database\Seeders;

use App\Models\Admin\Offer;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    public function run(): void
    {
        $offers = [
            [
                'name'         => 'Flash Sale',
                'offer_slug'   => 'flash-sale',
                'image'        => SeederHelper::getExistingImage('offer', 0, 'Flash Sale Banner'),
                'alt'          => 'Flash Sale Offer Banner',
                'status'       => 'active',
                'first_status' => 'active',
            ],
            [
                'name'         => 'End of Season Sale',
                'offer_slug'   => 'season-sale',
                'image'        => SeederHelper::getExistingImage('offer', 0, 'End of Season Sale Banner'),
                'alt'          => 'End of Season Sale Banner',
                'status'       => 'active',
                'first_status' => 'off',
            ],
        ];

        foreach ($offers as $offer) {
            Offer::updateOrCreate(['offer_slug' => $offer['offer_slug']], $offer);
        }
    }
}
