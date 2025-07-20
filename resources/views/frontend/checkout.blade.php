@extends('frontend.master')
@section('title', 'Checkout')
@section('main-content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Checkout</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!--Checkout Area Strat-->
    <div class="checkout-area pt-60 pb-30">
        <div class="container">
      @if (Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}</p>
            @elseif(Session::has('danger'))
                <p class="alert alert-danger">{{ Session::get('danger') }}</p>
            @endif

            <div class="row">
                <div class="col-lg-6 col-12">
                    <form id='checkout-form' method='post' action="{{ route('order.store') }}">
                        @csrf
                        <div class="checkbox-form">
                            <h3>shipping info Details</h3>

                            <div class="different-address">
                                <div class="ship-different-title">
                                    <h3>
                                        <label>Ship to a different address?</label>
                                        <input id="ship-box" type="checkbox">
                                    </h3>
                                </div>
                                <div id="ship-box-info" class="row" style="display: block;">

                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label> Name <span class="required">*</span></label>
                                            <input placeholder="" type="text" name="customer_name">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Company Name</label>
                                            <input placeholder="" type="text" name="company_name">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Address <span class="required">*</span></label>
                                            <input placeholder="Street address" type="text" name="customer_address">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Email Address <span class="required">*</span></label>
                                            <input placeholder="" type="email" name="customer_email">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label>Mobile<span class="required">*</span></label>
                                            <input type="text" name="customer_mobile">
                                        </div>
                                    </div>
                                </div>
                                <div class="order-notes">
                                    <div class="checkout-form-list">
                                        <label>Order Notes</label>
                                        <textarea id="checkout-mess" cols="30" rows="10"
                                            placeholder="Notes about your order, e.g. special notes for delivery." name="order_note"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="col-lg-6 col-12">
                    <div class="your-order">
                        <h3>Your order</h3>
                        <div class="your-order-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="cart-product-name">Product</th>
                                        <th class="cart-product-total">Total</th>
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

                                            $subtotal += $product->quantity * $unitPrice;
                                            $discount += $product->quantity * $discountAmount;
                                            $total += $product->quantity * $discountPrice;

                                        @endphp
                                        <tr class="cart_item">
                                            <td class="cart-product-name"> {{ $product->product->name }}<strong
                                                    class="product-quantity"> × {{ $product->quantity }}</strong></td>
                                            <td class="cart-product-total"><span
                                                    class="amount">${{ number_format($discountPrice, 2) }}</span></td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td><span class="amount">${{ number_format($subtotal, 2) }}</span></td>
                                    </tr>
                                    <tr class="cart-subtotal">
                                        <th>Discount</th>
                                        <td><span class="amount">-${{ number_format($discount, 2) }}</span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><strong><span class="amount">${{ number_format($total, 2) }}</span></strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <input type="hidden" name="total_amount" value="{{ number_format($total, 2) }}">
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div id="accordion">


                                    <div class="card">
                                        <div class="card-header" id="#payment-3">
                                            <h5 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    card paymentt
                                                </a>
                                            </h5>
                                        </div>

                                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                @if (Session::has('success'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ Session::get('success') }}
                                                    </div>
                                                @endif

                                                <strong>Name:</strong>
                                                <input type="input" class="form-control" name="name"
                                                    placeholder="Enter Name">
                                                <input type='hidden' name='stripeToken' id='stripe-token-id'>
                                                <input type="hidden" name="total_amount"
                                                    value="{{ number_format($total, 2, '.', '') }}">
                                                <br>
                                                <div id="card-element" class="form-control"></div>
                                                <button id='pay-btn' class="btn btn-success mt-3" type="button"
                                                    style="margin-top: 20px; width: 100%;padding: 7px;"
                                                    onclick="createToken()">PAY ${{ number_format($total, 2) }}
                                                </button>
                                                </form>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Checkout Area End-->
    @endsection

    @push('script')
        <script src="https://js.stripe.com/v3/"></script>
        <script type="text/javascript">
            var stripe = Stripe('{{ env('STRIPE_KEY') }}')
            var elements = stripe.elements();
            var cardElement = elements.create('card');
            cardElement.mount('#card-element');

            /*------------------------------------------
            --------------------------------------------
            Create Token Code
            --------------------------------------------
            --------------------------------------------*/
            function createToken() {
                document.getElementById("pay-btn").disabled = true;
                stripe.createToken(cardElement).then(function(result) {

                    if (typeof result.error != 'undefined') {
                        document.getElementById("pay-btn").disabled = false;
                        alert(result.error.message);
                    }

                    /* creating token success */
                    if (typeof result.token != 'undefined') {
                        document.getElementById("stripe-token-id").value = result.token.id;
                        document.getElementById('checkout-form').submit();
                    }
                });
            }
        </script>
    @endpush
