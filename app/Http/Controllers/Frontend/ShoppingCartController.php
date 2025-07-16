<?php

namespace App\Http\Controllers\Frontend;

use Stripe\Charge;

use Stripe\Stripe;
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
         if (!Auth::check()) {
        return redirect("user-login");
    }
    $cart_product = shoppingCart::where('user_id', Auth::user()->id)->get();
    return view('frontend.cart', compact('cart_product'));
    }

    public function updateCart(Request $request)
    {
        foreach($request->carts as $cart_id){
            $cart = shoppingCart::find($cart_id);
            if($cart) {
                $cart->quantity = $request->quantity[$cart_id];
                $cart->save();
            }

        }
        return back()->with('success', 'Cart updated successfully');





    }

    public function checkout()
    {
        if (!Auth::check()) {
            return redirect("user-login");
        }
        $cart_product = shoppingCart::where('user_id', Auth::user()->id)->get();
        return view('frontend.checkout', compact('cart_product'));
    }

    public function orderStore(Request $request)
    {
         Stripe::setApiKey(env('STRIPE_SECRET'));

        Charge::create ([
                "amount" => $request->total_amount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);



        // $cart = shoppingCart::where('user_id', Auth::user()->id)->get();
        // foreach ($cart as $item) {
        //     $order = new Order();
        //     $order->user_id = Auth::user()->id;
        //     $order->product_id = $item->product_id;
        //     $order->quantity = $item->quantity;
        //     $order->save();
        //     $item->delete();
        // }
        // return redirect('/')->with('success', 'Order placed successfully');
        // dd($request->all());
    }



}
