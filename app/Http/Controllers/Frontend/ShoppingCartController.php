<?php

namespace App\Http\Controllers\Frontend;

use App\Models\shoppingCart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    public function addToCart(Request $request)
        {
            if(!Auth::check())
            {
                return redirect("user-login");
            }

            $cart=new shoppingCart();
            $cart->user_id=Auth::user()->id;
            $cart->product_id=$request->product_id;
            $cart->quantity=$request->quantity;
            $cart->save();
            return back()->with('success','Product added to cart successfully');



        }
    public function viewCart()
    {
        if(!Auth::check()) {
        return redirect("user-login");
    }
        $cart_product=shoppingCart::where('user_id',Auth::user()->id)->get();
        return view('frontend.cart' ,compact('cart_product'));
    }
}
