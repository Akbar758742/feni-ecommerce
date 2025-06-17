<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SebastianBergmann\CodeUnit\FunctionUnit;

class FrontendController extends Controller
{
        public  function index()
        {
            
            return view('frontend.home');
            
        }
        public function productDetails()
        {
            return view('frontend.product-details');
        }
}
