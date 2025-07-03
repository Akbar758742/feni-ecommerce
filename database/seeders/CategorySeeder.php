<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Backend\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Category::create([
                'name' => "Category $i",
                'order' => $i,
                'status' => 1,
            ]);
        }
    }
}
