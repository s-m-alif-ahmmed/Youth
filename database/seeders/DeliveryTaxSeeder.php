<?php

namespace Database\Seeders;

use App\Models\Admin\DeliveryTax;
use Illuminate\Database\Seeder;

class DeliveryTaxSeeder extends Seeder
{
    public function run(): void
    {
        $deliveryTaxes = [
            [
                'location'        => 'Inside Dhaka',
                'delivery_charge' => '60',
                'vat'             => 0,
            ],
            [
                'location'        => 'Outside Dhaka',
                'delivery_charge' => '120',
                'vat'             => 0,
            ],
        ];

        foreach ($deliveryTaxes as $tax) {
            DeliveryTax::updateOrCreate(['location' => $tax['location']], $tax);
        }
    }
}
