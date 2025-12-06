<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Electronics
            [
                'category_id' => 1,
                'name' => 'Wireless Headphones',
                'slug' => 'wireless-headphones',
                'description' => 'Premium wireless headphones with noise cancellation',
                'price' => 2999.00,
                'stock' => 50,
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'category_id' => 1,
                'name' => 'Smartphone',
                'slug' => 'smartphone',
                'description' => 'Latest generation smartphone with advanced features',
                'price' => 15999.00,
                'stock' => 30,
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'category_id' => 1,
                'name' => 'Laptop',
                'slug' => 'laptop',
                'description' => 'High-performance laptop for work and gaming',
                'price' => 45999.00,
                'stock' => 15,
                'is_featured' => false,
                'status' => 'active',
            ],
            // Clothing
            [
                'category_id' => 2,
                'name' => 'Denim Jacket',
                'slug' => 'denim-jacket',
                'description' => 'Classic denim jacket for all seasons',
                'price' => 1299.00,
                'stock' => 100,
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'category_id' => 2,
                'name' => 'Running Shoes',
                'slug' => 'running-shoes',
                'description' => 'Comfortable running shoes with cushioned sole',
                'price' => 2499.00,
                'stock' => 75,
                'is_featured' => true,
                'status' => 'active',
            ],
            // Books
            [
                'category_id' => 3,
                'name' => 'Laravel Development Book',
                'slug' => 'laravel-development-book',
                'description' => 'Complete guide to Laravel web development',
                'price' => 899.00,
                'stock' => 200,
                'is_featured' => false,
                'status' => 'active',
            ],
            [
                'category_id' => 3,
                'name' => 'Fiction Novel',
                'slug' => 'fiction-novel',
                'description' => 'Bestselling fiction novel',
                'price' => 599.00,
                'stock' => 150,
                'is_featured' => false,
                'status' => 'active',
            ],
            // Home & Garden
            [
                'category_id' => 4,
                'name' => 'Coffee Maker',
                'slug' => 'coffee-maker',
                'description' => 'Automatic coffee maker with timer',
                'price' => 3499.00,
                'stock' => 40,
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'category_id' => 4,
                'name' => 'Garden Tools Set',
                'slug' => 'garden-tools-set',
                'description' => 'Complete set of essential garden tools',
                'price' => 1799.00,
                'stock' => 60,
                'is_featured' => false,
                'status' => 'active',
            ],
            // Sports & Outdoors
            [
                'category_id' => 5,
                'name' => 'Yoga Mat',
                'slug' => 'yoga-mat',
                'description' => 'Premium non-slip yoga mat',
                'price' => 699.00,
                'stock' => 120,
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'category_id' => 5,
                'name' => 'Camping Tent',
                'slug' => 'camping-tent',
                'description' => '4-person waterproof camping tent',
                'price' => 5999.00,
                'stock' => 25,
                'is_featured' => false,
                'status' => 'active',
            ],
            // Toys & Games
            [
                'category_id' => 6,
                'name' => 'Board Game',
                'slug' => 'board-game',
                'description' => 'Fun family board game',
                'price' => 1299.00,
                'stock' => 80,
                'is_featured' => false,
                'status' => 'active',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}