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
                'name' => 'Nike Air Max 270',
                'description' => 'The iconic Nike Air Max 270 with a large Air unit for extra comfort.',
                'slug' => 'nike',
                'price' => 180,
                'img' => 'https://pngimg.com/uploads/running_shoes/running_shoes_PNG5823.png'
            ],
            [
                'name' => 'Nike Air Zoom Pegasus 37',
                'description' => 'Responsive running shoe with React foam and Zoom Air cushioning.',
                'slug' => 'nike',
                'price' => 155,
                'img' => 'https://pngimg.com/uploads/running_shoes/running_shoes_PNG5816.png'
            ],
            [
                'name' => 'Nike Free RN 5.0',
                'description' => 'Ultra-flexible Nike Free RN 5.0 for a barefoot-like running experience.',
                'slug' => 'nike',
                'price' => 130,
                'img' => 'https://pngimg.com/uploads/running_shoes/running_shoes_PNG5819.png'
            ],
            [
                'name' => 'Nike Revolution 5',
                'description' => 'Lightweight running shoes with foam cushioning and breathable mesh.',
                'slug' => 'nike',
                'price' => 90,
                'img' => 'https://pngimg.com/uploads/running_shoes/running_shoes_PNG5820.png'
            ],
            [
                'name' => 'Nike Downshifter 10',
                'description' => 'Affordable performance with durable mesh and soft foam sole.',
                'slug' => 'nike',
                'price' => 75,
                'img' => 'https://pngimg.com/uploads/running_shoes/running_shoes_PNG5813.png'
            ],
            [
            'name' => 'Nike Air Max 270',
            'description' => 'The iconic Nike Air Max 270 with a large Air unit for extra comfort.',
            'slug' => 'nike',
            'price' => 180,
            'img' => 'https://pngimg.com/uploads/running_shoes/running_shoes_PNG5823.png'
        ],
            [
                'name' => 'Nike Air Zoom Pegasus 37',
                'description' => 'Responsive running shoe with React foam and Zoom Air cushioning.',
                'slug' => 'nike',
                'price' => 155,
                'img' => 'https://pngimg.com/uploads/running_shoes/running_shoes_PNG5816.png'
            ],
            [
                'name' => 'Nike Free RN 5.0',
                'description' => 'Ultra-flexible Nike Free RN 5.0 for a barefoot-like running experience.',
                'slug' => 'nike',
                'price' => 130,
                'img' => 'https://pngimg.com/uploads/running_shoes/running_shoes_PNG5819.png'
            ],
            [
                'name' => 'Nike Revolution 5',
                'description' => 'Lightweight running shoes with foam cushioning and breathable mesh.',
                'slug' => 'nike',
                'price' => 90,
                'img' => 'https://pngimg.com/uploads/running_shoes/running_shoes_PNG5820.png'
            ],
            [
                'name' => 'Nike Downshifter 10',
                'description' => 'Affordable performance with durable mesh and soft foam sole.',
                'slug' => 'nike',
                'price' => 75,
                'img' => 'https://pngimg.com/uploads/running_shoes/running_shoes_PNG5813.png'
            ],
        ];

        foreach ($products as $item) {
            Product::create($item);
        }
    }
}
