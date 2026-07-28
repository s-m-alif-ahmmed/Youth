<?php

namespace Database\Seeders;

use App\Models\Admin\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        $coupons = [
            [
                'code'            => 'YOUTH10',
                'name'            => '10% Off Welcome Voucher',
                'max_uses'        => 500,
                'max_uses_user'   => 1,
                'type'            => 'percent',
                'discount_amount' => 10,
                'min_amount'      => 1000.00,
                'starts_at'       => now(),
                'expires_at'      => now()->addMonths(6),
                'status'          => 'active',
            ],
            [
                'code'            => 'FLAT200',
                'name'            => 'Flat 200 BDT Discount',
                'max_uses'        => 200,
                'max_uses_user'   => 1,
                'type'            => 'fixed',
                'discount_amount' => 200,
                'min_amount'      => 1500.00,
                'starts_at'       => now(),
                'expires_at'      => now()->addMonths(3),
                'status'          => 'active',
            ],
        ];

        foreach ($coupons as $c) {
            Coupon::updateOrCreate(['code' => $c['code']], $c);
        }
    }
}
