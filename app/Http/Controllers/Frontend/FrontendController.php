<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Backend\Product;
use App\Models\Backend\Category;
use App\Http\Controllers\Controller;
use SebastianBergmann\CodeUnit\FunctionUnit;

class FrontendController extends Controller
{
        public  function index()
        {
            $categories=Category::with('products')->withCount('products')->where('status',1)->get();

            return view('frontend.home',compact('categories'));

        }
        public function productDetails($id)

        {
            $product=Product::find($id);
            return view('frontend.product-details',compact('product'));
        }
}
