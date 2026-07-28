<?php

namespace Database\Seeders;

use App\Models\Admin\Event;
use App\Models\Admin\Menu;
use App\Models\Admin\Offer;
use App\Models\Admin\OtherImage;
use App\Models\Admin\Product;
use App\Models\Admin\ProductBrand;
use App\Models\Admin\ProductCategory;
use App\Models\Admin\ProductColor;
use App\Models\Admin\ProductSize;
use App\Models\Admin\ProductSubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $menus         = Menu::all();
        $categories    = ProductCategory::all();
        $subCategories = ProductSubCategory::all();
        $brands        = ProductBrand::all();
        $sizes         = ProductSize::all();
        $colors        = ProductColor::all();
        $flashSaleOffer = Offer::where('offer_slug', 'flash-sale')->first();

        $productList = [
            [
                'name'              => 'Heavyweight Vintage Acid Wash Tee',
                'category_name'     => 'T-Shirts & Tanks',
                'sub_category_name' => 'Oversized Heavyweight Tees',
                'brand_name'        => 'Youth Exclusive',
                'regular_price'     => 1200,
                'selling_price'     => 950,
                'discount'          => '20%',
                'stock'             => 100,
                'popular_status'    => 'active',
                'related_status'    => 'active',
                'is_offer'          => true,
            ],
            [
                'name'              => 'Cyberpunk Cyber-Graph Oversized Tee',
                'category_name'     => 'T-Shirts & Tanks',
                'sub_category_name' => 'Graphic Printed Tees',
                'brand_name'        => 'Urban Culture',
                'regular_price'     => 1100,
                'selling_price'     => 890,
                'discount'          => '19%',
                'stock'             => 80,
                'popular_status'    => 'active',
                'related_status'    => 'active',
                'is_offer'          => false,
            ],
            [
                'name'              => 'Breathable Linen Cuban Collar Shirt',
                'category_name'     => 'Casual Shirts',
                'sub_category_name' => 'Cuban Collar Shirts',
                'brand_name'        => 'Vibe Edition',
                'regular_price'     => 1600,
                'selling_price'     => 1350,
                'discount'          => '15%',
                'stock'             => 60,
                'popular_status'    => 'active',
                'related_status'    => 'active',
                'is_offer'          => false,
            ],
            [
                'name'              => 'Heavy Fleece Zip-Up Streetwear Hoodie',
                'category_name'     => 'Jackets & Hoodies',
                'sub_category_name' => 'Zip-Up Oversized Hoodies',
                'brand_name'        => 'Youth Exclusive',
                'regular_price'     => 2800,
                'selling_price'     => 2250,
                'discount'          => '20%',
                'stock'             => 45,
                'popular_status'    => 'active',
                'related_status'    => 'active',
                'is_offer'          => true,
            ],
            [
                'name'              => 'Multi-Pocket Tactical Cargo Pants',
                'category_name'     => 'Jeans & Cargo Pants',
                'sub_category_name' => 'Tactical Cargo Pants',
                'brand_name'        => 'Raw Denim Co.',
                'regular_price'     => 2200,
                'selling_price'     => 1850,
                'discount'          => '16%',
                'stock'             => 70,
                'popular_status'    => 'active',
                'related_status'    => 'active',
                'is_offer'          => false,
            ],
            [
                'name'              => 'Minimalist Embroidered BoxyFit Tee',
                'category_name'     => 'T-Shirts & Tanks',
                'sub_category_name' => 'Oversized Heavyweight Tees',
                'brand_name'        => 'Apex Streetwear',
                'regular_price'     => 990,
                'selling_price'     => 790,
                'discount'          => '20%',
                'stock'             => 120,
                'popular_status'    => 'active',
                'related_status'    => 'active',
                'is_offer'          => false,
            ],
            [
                'name'              => 'Distressed Denim Trucker Jacket',
                'category_name'     => 'Jackets & Hoodies',
                'sub_category_name' => 'Zip-Up Oversized Hoodies',
                'brand_name'        => 'Raw Denim Co.',
                'regular_price'     => 3500,
                'selling_price'     => 2950,
                'discount'          => '15%',
                'stock'             => 35,
                'popular_status'    => 'active',
                'related_status'    => 'active',
                'is_offer'          => true,
            ],
            [
                'name'              => 'Relaxed Straight Fit Washed Jeans',
                'category_name'     => 'Jeans & Cargo Pants',
                'sub_category_name' => 'Tactical Cargo Pants',
                'brand_name'        => 'Raw Denim Co.',
                'regular_price'     => 2400,
                'selling_price'     => 1990,
                'discount'          => '17%',
                'stock'             => 55,
                'popular_status'    => 'active',
                'related_status'    => 'active',
                'is_offer'          => false,
            ],
        ];

        foreach ($productList as $index => $item) {
            $cat = $categories->where('name', $item['category_name'])->first() ?? $categories->first();
            $subCat = $subCategories->where('name', $item['sub_category_name'])->first() ?? $subCategories->first();
            $brand = $brands->where('name', $item['brand_name'])->first() ?? $brands->first();
            $menuId = $cat?->menu_id ?? $menus->first()?->id;

            $mainImage = SeederHelper::getExistingImage('product/product', $index, $item['name']);

            $product = Product::updateOrCreate(
                ['name' => $item['name']],
                [
                    'menu_id'                 => $menuId,
                    'product_category_id'     => $cat?->id,
                    'product_sub_category_id' => $subCat?->id,
                    'product_brand_id'        => $brand?->id,
                    'offer_id'                => $item['is_offer'] ? $flashSaleOffer?->id : null,
                    'meta_title'              => $item['name'] . ' | Youth Streetwear',
                    'meta_description'        => 'Buy ' . $item['name'] . ' online at Youth. Premium Bangladesh streetwear fashion with nationwide delivery.',
                    'name'                    => $item['name'],
                    'image'                   => $mainImage,
                    'alt'                     => $item['name'],
                    'stock'                   => $item['stock'],
                    'regular_price'           => $item['regular_price'],
                    'selling_price'           => $item['selling_price'],
                    'discount'                => $item['discount'],
                    'description'             => '<p>Experience supreme comfort and modern streetwear aesthetics with our <strong>' . $item['name'] . '</strong>. Crafted from premium high-gsm combed cotton with high-durability stitching.</p><ul><li>100% Premium Cotton / High Quality Material</li><li>Relaxed & Trendy Fit</li><li>Durable, Fade-Resistant Printing</li></ul>',
                    'product_slug'            => Str::slug($item['name']),
                    'status'                  => 'active',
                    'popular_status'          => $item['popular_status'],
                    'related_status'          => $item['related_status'],
                ]
            );

            // Attach Sizes
            if ($sizes->count() > 0) {
                $product->sizes()->sync($sizes->pluck('id')->toArray());
            }

            // Attach Colors
            if ($colors->count() > 0) {
                \DB::table('product_color_product')->where('product_id', $product->id)->delete();
                foreach ($colors as $col) {
                    \DB::table('product_color_product')->insert([
                        'product_id'       => $product->id,
                        'product_color_id' => $col->id,
                        'created_at'       => now(),
                        'updated_at'       => now(),
                    ]);
                }
            }

            // Attach Gallery Images
            OtherImage::where('product_id', $product->id)->delete();
            $galleryImages = SeederHelper::getExistingImages('product/other-images', 3);
            foreach ($galleryImages as $gImg) {
                OtherImage::create([
                    'product_id'  => $product->id,
                    'other_image' => $gImg,
                ]);
            }
        }
    }
}
