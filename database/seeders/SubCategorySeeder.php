<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Backend\SubCategory;

class SubCategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 5) as $categoryId) {
            for ($i = 1; $i <= 3; $i++) {
                SubCategory::create([
                    'name' => "SubCategory {$categoryId}-$i",
                    'category_id' => $categoryId,
                    'order' => $i,
                    'status' => 1,
                ]);
            }
        }
    }
}
