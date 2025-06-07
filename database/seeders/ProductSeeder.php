<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // إذا تشغّل أكثر من مرة، نمسح الجدول أولًا
        \DB::table('products')->truncate();

        // هنا قائمة 8 سلج فقط
        $slugs = [
            'car',
            'clothes',
            'watch',
            'electronics',
            'furniture',
            'book',
            'phone',
            'toy'
        ];

        // مصفوفة صور مشتركة لكل السلج
        $images = [
            // صور سيارات
            'https://images.unsplash.com/photo-1517949908114-8772002a5f24?auto=format&fit=crop&w=600&q=80',
            // صور ألبسة
            'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=600&q=80',
            // صور ساعات
            'https://images.unsplash.com/photo-1516574187841-cb9cc2ca948b?auto=format&fit=crop&w=600&q=80',
            // صور إلكترونيات
            'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=600&q=80',
            // صور أثاث
            'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=600&q=80',
            // صور كتب
            'https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?auto=format&fit=crop&w=600&q=80',
            // صور هواتف
            'https://images.unsplash.com/photo-1512499617640-c2f999018b72?auto=format&fit=crop&w=600&q=80',
            // صور ألعاب
            'https://images.unsplash.com/photo-1612831810112-3c8282b9ae93?auto=format&fit=crop&w=600&q=80',
        ];

        $descriptions = [
            'High quality and durable product.',
            'Stylish design suitable for all users.',
            'Enhanced performance with latest technology.',
            'Comfortable and ergonomic.',
            'Perfect gift for special occasions.',
            'Made from premium materials.',
            'Easy to use and maintain.',
            'Top-rated by our customers.'
        ];

        $totalProducts = 0;

        // نولّد لكل slug 25 منتجًا
        foreach ($slugs as $slug) {
            for ($i = 1; $i <= 25; $i++) {
                Product::create([
                    'name'        => ucfirst($slug) . " Product {$i}",
                    'description' => $descriptions[array_rand($descriptions)],
                    'slug'        => $slug, // كل المنتجات تحت هذا slug
                    'price'       => rand(10, 500),
                    'img'         => $images[array_rand($images)],
                ]);
                $totalProducts++;
            }
        }

        echo "Added {$totalProducts} products under " . count($slugs) . " slugs successfully!";
    }
}
