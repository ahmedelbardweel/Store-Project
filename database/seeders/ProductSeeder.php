<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // ----------- الهواتف الذكية -----------
            [
                'name' => 'iPhone 15 Pro Max',
                'description' => 'هاتف iPhone 15 Pro Max الجديد بشاشة 6.7 بوصة، معالج قوي وكاميرا احترافية، يدعم شبكات 5G.',
                'slug' => 'smartphone',
                'price' => 1449,
                'img' => 'https://images.pexels.com/photos/7889465/pexels-photo-7889465.jpeg'
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'description' => 'هاتف سامسونج جالاكسي S24 Ultra، شاشة كبيرة، معالج حديث وكاميرا بدقة عالية.',
                'slug' => 'smartphone',
                'price' => 1250,
                'img' => 'https://images.pexels.com/photos/4042807/pexels-photo-4042807.jpeg'
            ],
            [
                'name' => 'Google Pixel 8 Pro',
                'description' => 'هاتف جوجل بيكسل 8 برو بكاميرا ذكية وتقنيات الذكاء الاصطناعي.',
                'slug' => 'smartphone',
                'price' => 999,
                'img' => 'https://images.pexels.com/photos/607812/pexels-photo-607812.jpeg'
            ],

            // ----------- اللابتوبات -----------
            [
                'name' => 'MacBook Pro 16" M3 Max',
                'description' => 'ماك بوك برو 16 إنش مع معالج M3 Max، أداء قوي ورسوميات متقدمة.',
                'slug' => 'laptop',
                'price' => 3499,
                'img' => 'https://images.pexels.com/photos/18105/pexels-photo.jpg'
            ],

            // ----------- الأجهزة اللوحية -----------
            [
                'name' => 'Samsung Galaxy Tab S9',
                'description' => 'تابلت سامسونج بشاشة 11 بوصة ودعم S Pen وذاكرة واسعة.',
                'slug' => 'tablet',
                'price' => 899,
                'img' => 'https://images.pexels.com/photos/633409/pexels-photo-633409.jpeg'
            ],

            // ----------- الساعات الذكية -----------
            [
                'name' => 'Apple Watch Ultra 2',
                'description' => 'ساعة ذكية مقاومة للماء، شاشة متطورة وبطارية طويلة.',
                'slug' => 'wearables',
                'price' => 849,
                'img' => 'https://images.pexels.com/photos/267394/pexels-photo-267394.jpeg'
            ],
            [
                'name' => 'Rolex Submariner',
                'description' => 'ساعة يد فاخرة مقاومة للماء حتى 300م، تصميم كلاسيكي.',
                'slug' => 'watch',
                'price' => 12900,
                'img' => 'https://images.pexels.com/photos/190819/pexels-photo-190819.jpeg'
            ],

            // ----------- سماعات الرأس -----------
            [
                'name' => 'Sony WH-1000XM5',
                'description' => 'سماعات لاسلكية بإلغاء ضجيج وميكروفون عالي الجودة.',
                'slug' => 'headphones',
                'price' => 379,
                'img' => 'https://images.pexels.com/photos/374870/pexels-photo-374870.jpeg'
            ],

            // ----------- الكاميرات -----------
            [
                'name' => 'Canon EOS R6 Mark II',
                'description' => 'كاميرا احترافية بعدسة 24.2MP وتصوير 4K.',
                'slug' => 'camera',
                'price' => 2299,
                'img' => 'https://images.pexels.com/photos/51383/camera-lens-lens-camera-photography-51383.jpeg'
            ],
            [
                'name' => 'GoPro HERO12 Black',
                'description' => 'كاميرا أكشن صغيرة مقاومة للماء، تصوير احترافي.',
                'slug' => 'camera',
                'price' => 399,
                'img' => 'https://images.pexels.com/photos/51383/camera-lens-lens-camera-photography-51383.jpeg'
            ],

            // ----------- الأحذية -----------
            [
                'name' => 'Nike Air Force 1',
                'description' => 'حذاء رياضي بتصميم مريح مناسب لجميع الأنشطة.',
                'slug' => 'shoes',
                'price' => 120,
                'img' => 'https://images.pexels.com/photos/19090/pexels-photo.jpg'
            ],
            [
                'name' => 'Adidas Ultraboost',
                'description' => 'حذاء جري خفيف ومريح بتقنية BOOST.',
                'slug' => 'shoes',
                'price' => 150,
                'img' => 'https://images.pexels.com/photos/2529148/pexels-photo-2529148.jpeg'
            ],

            // ----------- الكتب -----------
            [
                'name' => 'The Lean Startup (كتاب)',
                'description' => 'كتاب يشرح منهجية اللين لريادة الأعمال.',
                'slug' => 'book',
                'price' => 32,
                'img' => 'https://images.pexels.com/photos/46274/pexels-photo-46274.jpeg'
            ],

            // ----------- الألعاب -----------
            [
                'name' => 'PlayStation 5',
                'description' => 'جهاز ألعاب بلايستيشن 5 مع جرافيكس 4K.',
                'slug' => 'gaming',
                'price' => 559,
                'img' => 'https://images.pexels.com/photos/1298601/pexels-photo-1298601.jpeg'
            ],

            // ----------- الأجهزة المنزلية -----------
            [
                'name' => 'Dyson V15 Detect',
                'description' => 'مكنسة كهربائية ذكية بتقنية كشف الغبار.',
                'slug' => 'home',
                'price' => 649,
                'img' => 'https://images.pexels.com/photos/38325/vacuum-cleaner-carpet-cleanup-housework-38325.jpeg'
            ],
            [
                'name' => 'Dyson Airwrap Styler',
                'description' => 'جهاز تصفيف الشعر الاحترافي من دايسون.',
                'slug' => 'beauty',
                'price' => 579,
                'img' => 'https://images.pexels.com/photos/373831/pexels-photo-373831.jpeg'
            ],

            // ----------- الأكسسوارات والإلكترونيات -----------
            [
                'name' => 'Logitech MX Master 3S',
                'description' => 'ماوس لاسلكي احترافي بتصميم مريح.',
                'slug' => 'accessories',
                'price' => 129,
                'img' => 'https://images.pexels.com/photos/461077/pexels-photo-461077.jpeg'
            ],
            [
                'name' => 'Amazon Kindle Paperwhite',
                'description' => 'قارئ كتب إلكترونية مقاوم للماء.',
                'slug' => 'electronics',
                'price' => 149,
                'img' => 'https://images.pexels.com/photos/159711/pexels-photo-159711.jpeg'
            ],
        ];

        foreach ($products as $item) {
            Product::create($item);
        }
    }
}
