@extends('frontend.master')
@section('title', 'Login')
@section('main-content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Login Register</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- Begin Login Content Area -->
    <div class="page-section mb-60">
        <div class="container">
            <div class="row">
                @if (Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}</p>
                @elseif(Session::has('danger'))
                    <p class="alert alert-danger">{{ Session::get('danger') }}</p>
                @endif
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                    <!-- Login Form s-->
                    <form action="{{ route('user.login') }}" method="POST">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Login</h4>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email Address*</label>
                                    <input class="mb-0" type="email" name="email" placeholder="Email Address">
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Password</label>
                                    <input class="mb-0" name="password" type="password" placeholder="Password">
                                </div>
                                <div class="col-md-8">
                                    <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input type="checkbox" id="remember_me">
                                        <label for="remember_me">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                    <a href="#"> Forgotten pasward?</a>
                                </div>
                                <div class="col-md-12">
                                    <button class="register-button mt-0">Login</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                    <form action="{{ route('user.register') }}" method="POST">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Register</h4>
                            <div class="row">

                                <div class="col-md-6 col-12 mb-20">
                                    <label>Name</label>
                                    <input class="mb-0" type="text" name="name" placeholder="Name">
                                </div>
                                <div class="col-md-6 col-12 mb-20">
                                    <label>mobile</label>
                                    <input class="mb-0" type="text" name="mobile" placeholder="Name">
                                </div>
                                <div class="col-md-12 mb-20">
                                    <label>Email Address*</label>
                                    <input class="mb-0" type="email" name="email" placeholder="Email Address">
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Password</label>
                                    <input class="mb-0" name="password" type="password" placeholder="Password">
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Confirm Password</label>
                                    <input class="mb-0" type="password" name="confirm_password"
                                        placeholder="Confirm Password">
                                </div>
                                <div class="col-12">
                                    <button class="register-button mt-0">Register</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content Area End Here -->
@endsection
