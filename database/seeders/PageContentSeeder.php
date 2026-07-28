<?php

namespace Database\Seeders;

use App\Models\Admin\AboutPage;
use App\Models\Admin\PrivacyPolicy;
use App\Models\Admin\ReturnPolicy;
use App\Models\Admin\TermsAndCondition;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    public function run(): void
    {
        // About Page
        AboutPage::updateOrCreate(
            ['id' => 1],
            [
                'description' => '<h2>About YOUTH</h2><p>Welcome to <strong>YOUTH</strong>, Bangladesh\'s premier contemporary streetwear label. Founded with a vision to redefine urban fashion, we merge premium fabrics, precision tailoring, and bold graphic expressions.</p><p>Every garment in our line is designed locally and produced with meticulous attention to detail, ensuring comfort, long-lasting quality, and authentic street style for youth generation.</p>',
            ]
        );

        // Privacy Policy
        PrivacyPolicy::updateOrCreate(
            ['id' => 1],
            [
                'privacy_policy' => '<h2>Privacy Policy</h2><p>At YOUTH, we respect your personal privacy. We collect minimal customer information necessary to process your orders securely and improve your shopping experience.</p><p>Your data is protected under industry standard encryption and will never be shared with unapproved third parties.</p>',
            ]
        );

        // Return Policy
        ReturnPolicy::updateOrCreate(
            ['id' => 1],
            [
                'return_policy' => '<h2>Return & Exchange Policy</h2><p>We want you to love your YOUTH apparel. If you receive a defective item or need a size exchange:</p><ul><li>Return requests must be initiated within 7 days of order receipt.</li><li>Items must be unworn, unwashed, and in original packaging with tags intact.</li><li>Exchanges are subject to product stock availability.</li></ul>',
            ]
        );

        // Terms and Conditions
        TermsAndCondition::updateOrCreate(
            ['id' => 1],
            [
                'terms_and_condition' => '<h2>Terms & Conditions</h2><p>By browsing or placing an order on youthbd.com, you agree to comply with our store terms and conditions. All content, images, and brand designs belong exclusively to YOUTH.</p><p>Prices and product availability are subject to change without prior notice.</p>',
            ]
        );
    }
}
