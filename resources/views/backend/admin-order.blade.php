@extends('backend.master')
@section('mainContent')
    <div class="container-fluid dashboard-content ">
        <div class="row">
            <!-- pageheader -->
            <!-- ============================================================== -->

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">

                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Tables</a></li>
                                <li class="breadcrumb-item active" aria-current="page">order</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- end pageheader -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- bordered table -->
            <!-- ============================================================== -->
            <div class="col-12">
                @if (Session::has('success'))
                    <p class="alert alert-success"> {{ Session::get('success') }}</p>
                @elseif(Session::has('danger'))
                    <p class="alert alert-danger">{{ Session::get('danger') }}</p>
                    <!-- here to 'withWarning()' -->
                @endif
                <div class="card table-card">

                    <div class="row">

                        <div class="col-6">
                            <h5 class="card-header">product list</h5>
                        </div>
                       
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
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
                        <div class="d-flex justify-content-center">
                            {{ $orders->links() }}
                        </div>

                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end bordered table -->
            <!-- ============================================================== -->
        </div>
    </div>
@endsection
