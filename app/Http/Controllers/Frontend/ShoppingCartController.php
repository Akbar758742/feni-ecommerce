<?php

namespace App\Http\Controllers\Frontend;

use Stripe\Charge;

use Stripe\Stripe;
use App\Models\Order;
// use Stripe\Climate\Order;
use App\Models\orderDetails;
use App\Models\shoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return redirect("user-login");
        }

        $cart = new shoppingCart();
        $cart->user_id = Auth::user()->id;
        $cart->product_id = $request->product_id;
        $cart->quantity = $request->quantity;
        $cart->save();
        return back()->with('success', 'Product added to cart successfully');
    }
    public function viewCart()
    {
        if (!Auth::check()) {
            return redirect("user-login");
        }
        $cart_product = shoppingCart::where('user_id', Auth::user()->id)->get();
        return view('frontend.cart', compact('cart_product'));
    }

    // public function removeCart($id)
    // {
    //     $cart = shoppingCart::find($id);
    //     $cart->delete();
    //     return back()->with('success', 'Product removed from cart successfully');
    // }

    public function myOrder()
    {
        if (!Auth::check()) {
            return redirect("user-login");
        }
        $orders = Order::where('customer_id', Auth::user()->id)->get();
        return view('frontend.my-orders', compact('orders'));
    }

    public function updateCart(Request $request)
    {
        foreach ($request->carts as $cart_id) {
            $cart = shoppingCart::find($cart_id);
            if ($cart) {
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
        DB::beginTransaction(); // Start a database transaction();
        try {

            // Validate the request
            $request->validate([
                'total_amount' => 'required|numeric',
                'stripeToken' => 'required'
            ]);

            // Convert to float and ensure it's numeric
            $amount = (float) $request->total_amount;

            Stripe::setApiKey(env('STRIPE_SECRET'));

            Charge::create([
                "amount" => (int) ($amount * 100), // Convert to cents and ensure integer
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
            ]);



            $cart = shoppingCart::where('user_id', Auth::user()->id)->get();
            $order = new Order();
            $order->date = date('d-m-y');
            $order->customer_id = Auth::user()->id;


            $order->customer_name = $request->customer_name;
            $order->company_name = $request->company_name;
            $order->customer_email = $request->customer_email;
            $order->customer_mobile = $request->customer_mobile;
            $order->order_note = $request->order_note;
            $order->customer_address = $request->customer_address;
            $order->total_amount = $request->total_amount;
            $order->total_quantity = 0;
            $order->save();


            $total = 0;
            $subtotal = 0;
            $discount = 0;
            $qty = 0;

            foreach ($cart as $product) {
                // $order->total_amount += $item->product->price * $item->quantity;
                $unitPrice = $product->product->price;
                $unitDiscount = $product->product->discount;
                $discountAmount = ($unitPrice * $unitDiscount) / 100;
                $discountPrice = $unitPrice - $discountAmount;

                $subtotal += $product->quantity * $unitPrice;
                $discount += $product->quantity * $discountAmount;
                $total += $product->quantity * $discountPrice;
                $qty += $product->quantity;
                $order->total_quantity += $product->quantity;

                $order_details = new orderDetails();
                $order_details->order_id = $order->id;
                $order_details->product_id = $product->product_id;
                $order_details->amount = $discountPrice;
                $order_details->price = $unitPrice;
                $order_details->quantity = $product->quantity;
                $order_details->save();


                $product->delete();
            }

            $order->total_quantity = $qty;
            $order->total_amount = $total;
            $order->save();

            DB::commit();
            return redirect('/')->with('success', 'Order placed successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect('/')->with('danger', 'Order placed unsuccessfully');
        }
    }
}
