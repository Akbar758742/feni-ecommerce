@extends('frontend.master')
@section('title', 'Cart')
@section('main-content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!--Shopping Cart Area Strat-->
    <div class="Shopping-cart-area pt-60 pb-60">
        <div class="container">
            @if (Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}</p>
            @elseif(Session::has('danger'))
                <p class="alert alert-danger">{{ Session::get('danger') }}</p>
            @endif

            <div class="row">
                <div class="col-12">
                    <form action="{{ route('update.cart') }}" method="POST">
                        @csrf
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="li-product-remove">remove</th>
                                        <th class="cart-product-name">Product</th>
                                        <th class="li-product-price">Unit Price</th>
                                        <th class="li-product-quantity">Quantity</th>
                                        <th class="li-product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $total = 0;
                                        $subtotal = 0;
                                        $discount = 0;
                                    @endphp

                                    @foreach ($cart_product as $product)
                                        @php
                                            $unitPrice = $product->product->price;
                                            $unitDiscount = $product->product->discount;
                                            $discountAmount = ($unitPrice * $unitDiscount) / 100;
                                            $discountPrice = $unitPrice - $discountAmount;

                                            $subtotal += $product->quantity * $discountPrice;
                                            $discount += $product->quantity * $discountAmount;
                                            $total += $product->quantity * $unitPrice;

                                        @endphp

                                        <input type="hidden" name="carts[{{ $product->id }}]" value="{{ $product->id }}">

                                        <tr>
                                            <td class="li-product-remove"><a href="#"><i class="fa fa-times"></i></a>
                                            </td>

                                            <td class="li-product-name"><a href="#">{{ $product->product->name }}</a>
                                            </td>
                                            <td class="li-product-price"><span
                                                    class="amount">${{ number_format($discountPrice, 2) }}</span></td>
                                            <td class="quantity">
                                                <label>Quantity</label>
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" name="quantity[{{ $product->id }}]"
                                                        value="{{ $product->quantity }}" type="text">
                                                    <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                    <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                </div>
                                            </td>
                                            <td class="product-subtotal"><span
                                                    class="amount">${{ number_format($product->quantity * $discountPrice, 2) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="coupon-all">

                                    <div class="coupon2">
                                        <input class="button" name="update_cart" value="Update cart" type="submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Cart totals</h2>
                                <ul>

                                     <li>Total <span>{{ $total }}</span></li>
                                    <li>discount <span>-{{ number_format($discount, 2) }}</span></li>
                                    <li>Subtotal <span> ={{ number_format($subtotal, 2) }}</span></li>

                                </ul>
                                <a href="#">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--Shopping Cart Area End-->
@endsection
