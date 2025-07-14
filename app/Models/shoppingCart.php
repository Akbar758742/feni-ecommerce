<?php

namespace App\Models;

use App\Models\Backend\Product;
use Illuminate\Database\Eloquent\Model;

class shoppingCart extends Model
{
    // protected $fillable = [
    //     'user_id',
    //     'product_id',
    //     'quantity',
    //     'price',
    //     'total_price',
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
