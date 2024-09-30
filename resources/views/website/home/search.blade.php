@extends('website.master')

@section('title')
    Products
@endsection

@section('content')

    {{--cart--}}
    @include('website.includes.cart')

    <section class="py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="container">
                        <div class="row">

                            <div class="col-md-12">
                                <p class="fs-5 fw-bold">Category</p>
                                <ul class="navbar-nav">
                                    @foreach($product_categories as $category)
                                        @if($category->status == 'active')
                                            @if($category->filter_status == 'active')
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('home.product', $category->product_category_slug) }}">
                                                    {{ $category->name }}
                                                </a>
                                            </li>
                                           @endif
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="container-fluid">
                        @if(session('message'))
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center text-black py-1">{{ session('message') }}</p>
                            </div>
                        </div>
                        @endif
                        @if(session('search_message'))
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center text-black py-2">{{ session('search_message') }}</p>
                            </div>
                        </div>
                        @endif
                        <div class="row" id="product-list">
                            @foreach($searchProducts as $product)
                                @if($product->status == 'active')
                                <div class="col-md-3 py-3">
                                    <div class="card border-0">
                                        <div class="card-header p-0 position-relative">
                                            <a href="{{ route('home.product.detail', $product->product_slug) }}">
                                                <img class="img-fluid object-fit-cover w-100" src="{{ asset( $product->image ) }}" alt="{{ $product->alt }}" style="height: 400px; ">
                                                @if($product->stock == 0)
                                                    <div class="position-absolute top-50 start-50 translate-middle w-100 h-100 d-flex justify-content-center align-items-center bg-dark bg-opacity-50 text-white">
                                                        <span class="fs-1">Stock Out</span>
                                                    </div>
                                                @endif
                                            </a>
                                        </div>
                                        <div class="card-body px-1 pb-0 my-0">
                                            <div class="d-flex justify-content-between">
                                                <div class="">
                                                    <a class="text-decoration-none text-black pb-2" href="{{ route('home.product.detail', $product->product_slug) }}">
                                                        {{ $product->name }}
                                                    </a>
                                                    <p>
                                                        ৳ {{ $product->selling_price }} tk
                                                        @if($product->regular_price)
                                                        (
                                                        <span class="text-decoration-line-through" style="font-size: 12px;">
                                                            ৳ {{ $product->regular_price }} tk
                                                        </span>
                                                        )
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="">
                                                    <form action="">
                                                        <a href="" class="pe-1">
                                                            <i class="fa-regular fa-heart text-black"></i>
                                                        </a>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="justify-content-between">
                                            @if($product->offer_id)
                                                <p class="float-start offer-ribbon">
                                                    {{$product->offer->name}}
                                                </p>
                                            @endif
                                            @if($product->event_id)
                                                <p class="float-start offer-ribbon">
                                                    {{$product->event->name}}
                                                </p>
                                            @endif
                                            <a class="btn btn-sm btn-dark text-white float-end" href="{{ route('home.product.detail', $product->product_slug) }}" >
                                                Read More
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                @endif
                            @endforeach

                            <div class="pagination-simple col-md-12 pt-5">
                                {{ $searchProducts->links('pagination::bootstrap-5') }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

{{--    <style>--}}
{{--        .active>.page-link, .page-link.active {--}}
{{--            z-index: 3;--}}
{{--            color: var(--bs-pagination-active-color);--}}
{{--            background-color: #212529;--}}
{{--            border-color: #212529;--}}
{{--        }--}}
{{--    </style>--}}


@endsection

