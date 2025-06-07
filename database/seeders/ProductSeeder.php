<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $clothes_names = [
            'Men\'s T-shirt', 'Classic Shirt', 'Winter Jacket', 'Jeans Pants', 'Sports Shorts',
            'Summer Dress', 'Cotton Skirt', 'Women\'s Coat', 'Formal Blouse', 'Abaya',
            'Kids Suit', 'Kids T-shirt', 'Kids Pants', 'Kids Jacket', 'Girls Dress'
        ];

        $watch_names = [
            'Classic Watch', 'Sports Watch', 'Smart Watch', 'Metal Watch',
            'Leather Watch', 'Luxury Watch (Men)', 'Luxury Watch (Women)', 'Casual Watch',
            'Colorful Kids Watch', 'Water Resistant Watch'
        ];

        $clothes_images = [
            'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1542068829-1115f7259450?auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1530845641042-dc43f27f8d05?auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1503341455253-b2e723bb3dbb?auto=format&fit=crop&w=600&q=80',
        ];

        $watch_images = [
            'https://images.unsplash.com/photo-1516574187841-cb9cc2ca948b?auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1465101162946-4377e57745c3?auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1530845641042-dc43f27f8d05?auto=format&fit=crop&w=600&q=80',
            'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=600&q=80',
        ];

        $descriptions = [
            'Made from high quality materials. Modern and comfortable design for everyday use.',
            'Elegant design suitable for all occasions. Available in multiple sizes.',
            'Trendy clothing made from 100% cotton, comfortable all day long.',
            'Suitable for sports and outdoor activities. Durable and easy to wash.',
            'Water-resistant watch, 1-year warranty, modern design.',
            'Premium materials and various colors.',
            'Ideal for gifts and special occasions.',
            'Secure closure, easy to wear and remove.',
        ];

        $brands = ['Adidas', 'Nike', 'Zara', 'H&M', 'Casio', 'Rolex', 'G-Shock', 'Swatch', 'Diesel', 'Omega'];

        $genders = ['Men', 'Women', 'Kids'];

        $total_products = 0;

        // Add clothes products
        for ($i = 1; $i <= 200; $i++) {
            $name = $clothes_names[array_rand($clothes_names)];
            $brand = $brands[array_rand($brands)];
            $img = $clothes_images[array_rand($clothes_images)];
            $desc = $descriptions[array_rand($descriptions)];
            $gender = $genders[array_rand($genders)];
            $slug = 'clothes-' . $i;
            $price = rand(20, 200);

            Product::create([
                'name'        => $name . " ($brand) $gender",
                'description' => $desc,
                'slug'        => $slug,
                'price'       => $price,
                'img'         => $img,
            ]);
            $total_products++;
        }

        // Add watches products
        for ($i = 1; $i <= 120; $i++) {
            $name = $watch_names[array_rand($watch_names)];
            $brand = $brands[array_rand($brands)];
            $img = $watch_images[array_rand($watch_images)];
            $desc = $descriptions[array_rand($descriptions)];
            $gender = $genders[array_rand($genders)];
            $slug = 'watch-' . $i;
            $price = rand(40, 800);

            Product::create([
                'name'        => $name . " ($brand) $gender",
                'description' => $desc,
                'slug'        => $slug,
                'price'       => $price,
                'img'         => $img,
            ]);
            $total_products++;
        }

        echo "Added $total_products products (clothes and watches) successfully!";
    }
}
