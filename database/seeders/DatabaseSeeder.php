<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            LogoAddressSeeder::class,
            SocialMediaSeeder::class,
            DeliveryTaxSeeder::class,
            MenuSeeder::class,
            ProductCategorySeeder::class,
            ProductSubCategorySeeder::class,
            ProductBrandSeeder::class,
            ProductSizeSeeder::class,
            ProductColorSeeder::class,
            HeroBannerSeeder::class,
            OfferSeeder::class,
            EventSeeder::class,
            ProductSeeder::class,
            BlogCategorySeeder::class,
            BlogSeeder::class,
            PageContentSeeder::class,
            CouponSeeder::class,
            ProductReviewSeeder::class,
            CommentSeeder::class,
        ]);
    }
}
