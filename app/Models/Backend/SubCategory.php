<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SubCategory extends Model
{
   use HasFactory;
   public function category():BelongsTo
   {
       return $this->belongsTo(Category::class);
   }
}
