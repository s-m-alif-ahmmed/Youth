@extends('website.master')

@section('title')
    Shopping Cart
@endsection

@section('content')

    <section class="h-100 gradient-custom">
        <div class="container py-5">
            @if(session('message'))
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center text-black py-1">{{ session('message') }}</p>
                </div>
            </div>
            @endif
            @if($errors->has('quantity'))
            <div class="row">
                <div class="col-md-12">
                    <x-input-error :messages="$errors->get('quantity')" class="my-1 text-black" />
                </div>
            </div>
            @endif
            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-3">
                    <!--APP-SIDEBAR-->
                    <div class="sticky mb-3">
                        <div class="app-sidebar card" style="background-color: #212529;">
                            <div class="main-sidemenu">
                                <ul class="side-menu ps-0">
                                    <a class="nav-item text-decoration-none text-white" href="{{route('dashboard')}}">
                                        <li class="nav-link border rounded-2 m-2 p-2">
                                            <span class="side-menu__label text-white">Profile</span>
                                        </li>
                                    </a>
                                    <a class="nav-item text-decoration-none text-white" data-bs-toggle="slide" href="{{ route('profile.edit') }}">
                                        <li class="nav-link border rounded-2 m-2 p-2">
                                            <span class="side-menu__label text-white">Settings</span>
                                        </li>
                                    </a>
                                    <a class="nav-item text-decoration-none text-white" data-bs-toggle="slide" href="{{ route('home.product.cart') }}" target="_blank">
                                        <li class="nav-link border bg-white rounded-2 m-2 p-2">
                                            <span class="side-menu__label text-black">My Cart</span>
                                        </li>
                                    </a>
                                    <a class="nav-item text-decoration-none text-white" data-bs-toggle="slide" href="{{ route('order.detail') }}">
                                        <li class="nav-link border rounded-2 m-2 p-2">
                                            <span class="side-menu__label text-white">My Orders</span>
                                        </li>
                                    </a>
                                    <a class="nav-item text-decoration-none text-white" data-bs-toggle="slide" href="{{ route('user.wishlist') }}">
                                        <li class="nav-link border rounded-2 m-2 p-2">
                                            <span class="side-menu__label text-white">My wishlist</span>
                                        </li>
                                    </a>
                                </ul>
                                <div class="slide-right" id="slide-right">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/APP-SIDEBAR-->
                </div>
                <div class="col-md-9">
                    <div class="card mb-4" style="background-color: #212529;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-12">
                                    <div class="py-5 px-2">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h1 class="fw-bold mb-0 text-white">Shopping Cart</h1>
                                            <h6 class="mb-0 text-white">{{$productCount}} items</h6>
                                        </div>
                                        @if($carts)
                                            @foreach($carts as $cart)
                                                <div style="border: 1px solid #ffffff !important; box-sizing: border-box !important;">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">

                                                    </div>
                                                </div>
                                                <div class="row mt-2 mb-4 d-flex align-items-center">
                                                    <div class="col-sm-6 col-md-2 col-lg-2 col-xl-2 col-6 pt-1">
                                                        <a href="{{ route('home.product.detail', $cart->product->product_slug) }}">
                                                            <img
                                                                src="{{ asset($cart->product->image) }}"
                                                                class="img-fluid rounded-3 cart-img" alt="{{ $cart->alt }}">
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-6 pt-1 float-start">
                                                        <h6 class="text-white" style="font-size: 14px;">{{ $cart->product->productCategory->name }}</h6>
                                                        <a class="text-decoration-none" href="{{ route('home.product.detail', $cart->product->product_slug) }}">
                                                            <h6 class="text-white" style="font-size: 16px;">{{ $cart->product->name }}</h6>
                                                        </a>
                                                        @if($cart->product->offer_id)
                                                        <h6 class="text-white" style="font-size: 14px;">Offer: {{ optional($cart->product->offer)->name ?? '' }}</h6>
                                                        @endif
                                                        @if($cart->product->event_id)
                                                        <h6 class="text-white" style="font-size: 14px;">Event: {{ optional($cart->product->event)->name ?? '' }}</h6>
                                                        @endif
                                                        @if($cart->product_size_id)
                                                            <h6 class="text-white" style="font-size: 14px;">Size: {{ optional($cart->productSize)->name ?? '' }}</h6>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6 col-6  d-flex justify-content-center py-2">
                                                        <form action="{{ route('cart.update.quantity', $cart->id) }}" method="post">
                                                            @csrf

                                                            <div class="d-flex cart-box">
                                                                <div class="d-flex border bg-white pt-1" style="height: 39px; margin-top: 5px;">
                                                                    <button type="button" class="btn bg-white border-0 decrease-btn" onclick="updateQuantity(this, -1, '{{ $cart->id }}')">
                                                                        <i class="fas fa-minus bg-white text-dark"></i>
                                                                    </button>
                                                                    <input id="quantity_{{ $cart->id }}" min="1" max="{{ $cart->product->stock }}" name="quantity" value="{{ $cart->quantity }}" type="number" class="form-control form-control-sm border-0 quantity input-focus" style="width: 50px;" data-cart-id="{{ $cart->id }}" />
                                                                    <button type="button" class="btn bg-white border-0 increase-btn" onclick="updateQuantity(this, 1, '{{ $cart->id }}')">
                                                                        <i class="fas fa-plus bg-white text-dark"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="text-center">
                                                                    <input type="submit" class="btn p-2 m-1 rounded-0" value="update" style="font-size: 16px; background-color: #0a58ca; color: white;" />
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>

                                                    <div class="col-sm-6 col-md-2 col-xl-2 col-lg-2 col-6 d-flex justify-content-between">
                                                        <h6 class="mb-0 mt-1 ms-3 text-white">৳ {{$cart->product->selling_price}} </h6>
                                                        <a href="{{ route('cart.delete', $cart->id) }}" class="text-muted mt-1">
                                                            <i class="fas fa-times text-white me-2"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                        <hr class="my-4">

                                        <div class="float-start">
                                            <a href="{{ route('home') }}" class="text-white" style="font-size: 16px;">
                                                <i class="fas fa-long-arrow-alt-left me-2 text-white"></i>
                                                Back to home
                                            </a>
                                        </div>
                                        <div class="float-end">
                                            @if(count($carts) <= 0)
                                            @else
                                                <a href="{{ route('home.product.checkout') }}" class="text-white" style="font-size: 16px;">
                                                    Checkout
                                                    <i class="fas fa-long-arrow-alt-right me-2 text-white"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <style>
        .increase-btn{
            margin: -2px 5px 0 -38px;
        }

        .decrease-btn{
            margin: -1px 0 0 0;
        }

        .cart-img{
            height: 100px;
            width: 100px;
        }
        @media screen and (min-width: 100px) and (max-width: 576px){
            .cart-img{
                height: 80px;
                width: 80px;
            }

            .cart-box{
                margin: 0 0 0 20px !important;
            }
        }

    </style>

    <script>
        function updateQuantity(element, change, productId) {
            var inputField = $(element).siblings('input[name="quantity"]');
            var currentQuantity = parseInt(inputField.val());
            var newQuantity = currentQuantity + change;

            if (newQuantity < 0) {
                newQuantity = 0;
            }

            inputField.val(newQuantity);

        }

    </script>

@endsection


