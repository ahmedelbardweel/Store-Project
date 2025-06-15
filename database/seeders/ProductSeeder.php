<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'iPhone 15 Pro Max',
                'description' => 'هاتف ذكي حديث من أبل بشاشة Super Retina XDR وكاميرا ثلاثية.',
                'slug' => 'phone',
                'price' => 1099,
                'img' => 'https://images.unsplash.com/photo-1512499617640-c2f999018b72?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Tesla Model S',
                'description' => 'سيارة كهربائية فاخرة بمدى طويل وتسارع عالي وتقنيات ذكية.',
                'slug' => 'car',
                'price' => 90000,
                'img' => 'https://images.unsplash.com/photo-1503736334956-4c8f8e92946d?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Rolex Submariner',
                'description' => 'ساعة فاخرة مقاومة للماء، أيقونة في عالم الساعات السويسرية.',
                'slug' => 'watch',
                'price' => 12500,
                'img' => 'https://images.unsplash.com/photo-1516574187841-cb9cc2ca948b?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Modern Sofa',
                'description' => 'كنبة عصرية مريحة بتصميم أنيق ولون رمادي يناسب جميع الديكورات.',
                'slug' => 'furniture',
                'price' => 799,
                'img' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'The Lean Startup',
                'description' => 'كتاب مميز حول تطوير المشاريع الناشئة باستخدام منهجية اللين.',
                'slug' => 'book',
                'price' => 29,
                'img' => 'https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Kids Teddy Bear',
                'description' => 'دبدوب للأطفال من قماش قطني عالي الجودة وصديق للبيئة.',
                'slug' => 'toy',
                'price' => 19,
                'img' => 'https://images.unsplash.com/photo-1612831810112-3c8282b9ae93?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Nike Air Max',
                'description' => 'حذاء رياضي أصلي من نايك بتقنية الهواء وألوان شبابية.',
                'slug' => 'clothes',
                'price' => 120,
                'img' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=800&q=80'
            ],
            [
                'name' => 'Sony WH-1000XM4',
                'description' => 'سماعات رأس لاسلكية بإلغاء ضجيج احترافي وجودة صوت فائقة.',
                'slug' => 'electronics',
                'price' => 349,
                'img' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=800&q=80'
            ],
        ];

        foreach ($products as $item) {
            Product::create($item);
        }

        // توليد منتجات إضافية تلقائية متنوعة (إن أردت عدد أكبر)
        for ($i = 1; $i <= 20; $i++) {
            Product::create([
                'name' => "منتج عشوائي رقم $i",
                'description' => 'منتج افتراضي للتجربة وعرض التصميم.',
                'slug' => 'random',
                'price' => rand(10, 1000),
                'img' => 'https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=800&q=80',
            ]);
        }
    }
}
