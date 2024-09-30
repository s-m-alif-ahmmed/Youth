@extends('website.master')

@section('title')
    Youth | Order Details
@endsection

@section('content')

    {{--cart--}}
    @include('website.includes.cart')

    <section class="py-5">
        <div class="container">

            <div class="row">
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
                                        <li class="nav-link border rounded-2 m-2 p-2">
                                            <span class="side-menu__label text-white">My Cart</span>
                                        </li>
                                    </a>
                                    <a class="nav-item text-decoration-none text-white" data-bs-toggle="slide" href="{{ route('order.detail') }}">
                                        <li class="nav-link border bg-white rounded-2 m-2 p-2">
                                            <span class="side-menu__label text-black">My Orders</span>
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
                    <div class="card px-2" style="background-color: #212529;">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="text-center text-white mb-3 my-2">Order Details</h2>
                            </div>
                        </div>
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col"> Name</th>
                                <th scope="col">Size</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order_details->sortByDesc('create_at') as $product)
                                <tr>
                                    <td>
                                        <a class="text-decoration-none text-white" href="{{ route('home.product.detail', $product->product->product_slug) }}">
                                            {{ $product->product->name }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($product->product_size_id)
                                            {{$product->productSize->name}}
                                        @endif
                                    </td>
                                    <td>{{$product->quantity}} Pcs</td>
                                    <td>{{$product->product->selling_price}} Tk</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

