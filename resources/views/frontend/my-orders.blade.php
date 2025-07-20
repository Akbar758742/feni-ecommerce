@extends('frontend.master')
@section('title', 'Cart')
@section('main-content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">my orders</li>
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

                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="li-product-remove">date</th>
                                        <th class="cart-product-name">customer</th>


                                        <th class="li-product-price">order notes</th>

                                        <th class="li-product-quantity">Quantity</th>
                                        <th class="li-product-subtotal">Total amount</th>
                                    </tr>
                                </thead>
                                <tbody>



                                    @foreach ($orders as $order)


                                        <tr>


                                            <td class="li-product-name"><a href="#">{{ $order->date }}</a> </td>
                                            <td class="li-product-name"><a href="#">{{ $order->customer_name }}</a> </td>
                                            <td class="li-product-name"><a href="#">{{ $order->order_note }}</a> </td>
                                            <td class="li-product-name"><a href="#">{{ $order->total_quantity }}</a> </td>
                                            <td class="li-product-name"><a href="#">{{ $order->total_amount }}</a> </td>
                                          



                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>

                </div>
            </div>
        </div>
    </div>
    <!--Shopping Cart Area End-->
@endsection
