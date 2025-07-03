<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{  use HasFactory;
   public function images():HasMany
   {
       return $this->hasMany(Upload::class, 'product_id', 'id');
   }
    public function firstImage():HasOne
   {
       return $this->hasOne(Upload::class, 'product_id', 'id')->oldestOfMany();
   }
}
