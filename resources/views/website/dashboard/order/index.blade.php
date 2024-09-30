@extends('website.master')

@section('title')
    Youth | Order History
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
                                <h2 class="text-center mb-3 my-2 text-white">Order History</h2>
                            </div>
                        </div>
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">Sl</th>
                                <th scope="col">Tracking Id</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders->sortByDesc('create_at') as $order)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <a class="text-decoration-none" href="{{ route('order.detail.products', $order->tracking_id) }}">
                                            #{{ $order->tracking_id }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $order->istimate_total ?? $order->order_total }} Tk
                                    </td>
                                    <td>{{$order->status}}</td>
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
