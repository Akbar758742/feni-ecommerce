<?php

namespace App\Models\Backend;

use App\Models\Backend\Product;
use App\Models\Backend\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
   public function subcategories():HasMany
{
    return $this->hasMany(SubCategory::class, 'category_id', 'id');
}

   public function products():HasMany
{
    return $this->hasMany(Product::class, 'category_id', 'id');
}

}
