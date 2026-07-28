<?php

namespace Database\Seeders;

use App\Models\Admin\Product;
use App\Models\Admin\ProductReview;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductReviewSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('role', 'user')->first() ?? User::first();
        $products = Product::all();

        if ($user && $products->count() > 0) {
            foreach ($products->take(4) as $product) {
                ProductReview::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'user_id'    => $user->id,
                    ],
                    [
                        'product_id'     => $product->id,
                        'user_id'        => $user->id,
                        'star'           => rand(4, 5),
                        'product_review' => 'Amazing heavy quality fabric and perfect fitting! Will definitely order again from Youth.',
                        'status'         => 'active',
                    ]
                );
            }
        }
    }
}
