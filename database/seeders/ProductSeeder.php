<?php

namespace Database\Seeders;

use Illuminate\Support\Str;

use App\Models\Backend\Upload;
use App\Models\Backend\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {
            $product = Product::create([
                'name' => "Product $i",
                'description' => fake()->paragraph(),
                'short_description' => fake()->sentence(),
                'long_description' => fake()->paragraph(3),
                'product_details' => fake()->paragraph(2),
                'delivery_policy' => fake()->sentence(),
                'discount' => rand(0, 50),
                'return_policy' => fake()->sentence(),
                'price' => fake()->randomFloat(2, 100, 5000),
                'quantity' => rand(1, 100),
                'category_id' => 1, // Make sure you have categories and sub_categories seeded!
                'sub_category_id' => 1,
                'status' => true,
                'order' => $i,
            ]);
        }
        // Add a related file upload
        for ($j = 1; $j <= 9; $j++) {
            Upload::create([
                'file_path' => "uploads/file/product-image-" . rand(1, 6) . '.jpg',
                'product_id' => $product->id,
            ]);
        }
    }
}
