@extends('website.master')

@section('title')
    Youth | Wishlist
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
                                        <li class="nav-link border rounded-2 m-2 p-2">
                                            <span class="side-menu__label text-white">My Orders</span>
                                        </li>
                                    </a>
                                    <a class="nav-item text-decoration-none text-white" data-bs-toggle="slide" href="{{ route('user.wishlist') }}">
                                        <li class="nav-link border bg-white rounded-2 m-2 p-2">
                                            <span class="side-menu__label text-black">My wishlist</span>
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
                <div class="col-md-9 ">
                    <div class="card px-2" style="background-color: #212529;">
                        <div class="row">
                            <div class="col-md-12 py-2">
                                <h2 class="text-center mb-3 text-white">My Wishlist</h2>
                            </div>
                        </div>
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th scope="col">Sl</th>
                                <th scope="col"> Image</th>
                                <th scope="col"> Name</th>
                                <th scope="col"> Price</th>
                                <th scope="col">Wishlist</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($favourites->sortByDesc('create_at') as $favourite)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <a href="{{ route('home.product.detail', $favourite->product->product_slug) }}">
                                            <img src="{{ asset($favourite->product->image) }}" alt="{{$favourite->product->image}}" class="img-fluid" style="height: 60px; width: auto;" />
                                        </a>
                                    </td>
                                    <td>
                                        <a class="text-white text-decoration-none" href="{{ route('home.product.detail', $favourite->product->product_slug) }}">
                                            {{ $favourite->product->name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $favourite->product->selling_price }} Tk
                                    </td>
                                    <td>
                                        @if(Auth::check())
                                            @if($favourite)
                                                <form action="{{ route('favourite.destroy', $favourite->id )}}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="text-danger bg-transparent border-0 p-0 m-0" type="submit">
                                                        <i class="fa fa-heart"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('favourite.store') }}" method="POST">
                                                    @csrf
                                                    @method('POST')

                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                                    <button type="submit" class="btn bg-transparent p-0 m-0">
                                                        <i class="fa fa-heart text-black"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <form action="{{ route('favourite.store') }}" method="POST">
                                                @csrf
                                                @method('POST')

                                                <input type="hidden" name="user_id" />
                                                <input type="hidden" name="product_id" />
                                                <button type="submit" class="btn bg-transparent p-0 m-0">
                                                    <i class="fa-regular fa-heart text-black"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
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

