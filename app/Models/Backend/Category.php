<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   public function subcategories()
{
    return $this->hasMany(SubCategory::class, 'category_id', 'id');
}
}
