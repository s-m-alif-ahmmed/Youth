@extends('website.master')

@section('title')
    Youth | {{ $product_category->name }}
@endsection

@section('content')

    {{--cart--}}
    @include('website.includes.cart')

    <section class="py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-2 col-lg-3 col-12">
                    <div class="container">
                        <div class="row my-2">
                            <form action="{{ route('home.product.filter.category.price', $product_category->product_category_slug) }}" method="GET">

                                <div class="card shadow border-0">
                                    <div class="price-card p-0 m-0">
                                        <div class="card-header border-0 p-0 m-0">
                                            <p class="fw-bold fs-5 text-center pt-2 m-0">Price Range</p>
                                        </div>
                                        <div class="card-body m-0 pb-0">
                                            <div class="d-flex justify-content-center w-100">
                                                <div class="wrapper">
                                                    <div class="price-input">
                                                        <div class="field">
                                                            <div class="col-12 text-center">
                                                                <div class="" style="color: #bdbbbb">
                                                                    Min
                                                                </div>
                                                                <div class="">
                                                                    <input type="number" class="input-min" value="100" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="separator">
                                                            <p>-</p>
                                                        </div>
                                                        <div class="field">
                                                            <div class="col-12 text-center">
                                                                <label class="" style="color: #bdbbbb">
                                                                    Max
                                                                </label>
                                                                <div class="">
                                                                    <input type="number" class="input-max" value="1000" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="slider">
                                                        <div class="progress"></div>
                                                    </div>
                                                    <div class="range-input">
                                                        <input type="range" class="range-min" name="min_price" min="0" max="10000" value="100" step="1">
                                                        <input type="range" class="range-max" name="max_price" min="0" max="10000" value="1000" step="1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer border-0 p-0 m-0">
                                            <div class="text-end pb-3 pe-3">
                                                <input type="submit" value="Apply" class="btn btn-sm fw-bold text-capitalize shadow" style="background-color: #ffffff; margin: 10px 0 0 0; padding: 5px 10px 5px 10px; color: black; border-radius: 10px; font-size: 16px;" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>

                        <style>
                            .price-input {
                                width: 100%;
                                display: flex;
                            }

                            @media screen and (min-width: 768px) and (max-width: 992px){
                                .price-input{
                                    justify-content: center;
                                }
                            }

                            .price-input .field {
                                display: flex;
                                width: 100%;
                                height: 20px;
                                align-items: center;
                            }
                            .field input {
                                width: 100%;
                                height: 100%;
                                outline: none;
                                font-size: 16px;
                                border-radius: 5px;
                                text-align: center;
                                border: 1px solid rgba(204, 204, 204, 0.8);
                                background-color: rgba(218, 218, 218, 0.8);
                                -moz-appearance: textfield;
                            }
                            input[type="number"]::-webkit-outer-spin-button,
                            input[type="number"]::-webkit-inner-spin-button {
                                -webkit-appearance: none;
                            }
                            .price-input .separator {
                                width: 100px;
                                display: flex;
                                font-size: 20px;
                                align-items: center;
                                justify-content: center;
                                padding: 7px 0 0 0;
                            }
                            .slider {
                                height: 5px;
                                position: relative;
                                background: #ddd;
                                border-radius: 5px;
                            }
                            .slider .progress {
                                height: 100%;
                                /*left: 25%;*/
                                /*right: 25%;*/
                                position: absolute;
                                border-radius: 5px;
                                background: #17a2b8;
                            }
                            .range-input {
                                position: relative;
                            }
                            .range-input input {
                                position: absolute;
                                width: 100%;
                                height: 5px;
                                top: -5px;
                                background: none;
                                pointer-events: none;
                                -webkit-appearance: none;
                                -moz-appearance: none;
                            }
                            input[type="range"]::-webkit-slider-thumb {
                                height: 17px;
                                width: 17px;
                                border-radius: 50%;
                                background: #17a2b8;
                                pointer-events: auto;
                                -webkit-appearance: none;
                                box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
                            }
                            input[type="range"]::-moz-range-thumb {
                                height: 17px;
                                width: 17px;
                                border: none;
                                border-radius: 50%;
                                background: #17a2b8;
                                pointer-events: auto;
                                -moz-appearance: none;
                                box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
                            }

                        </style>

                        <script>
                            const rangeInput = document.querySelectorAll(".range-input input"),
                                priceInput = document.querySelectorAll(".price-input input"),
                                range = document.querySelector(".slider .progress");
                            let priceGap = 1;

                            priceInput.forEach((input) => {
                                input.addEventListener("input", (e) => {
                                    let minPrice = parseInt(priceInput[0].value),
                                        maxPrice = parseInt(priceInput[1].value);

                                    if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
                                        if (e.target.className === "input-min") {
                                            rangeInput[0].value = minPrice;
                                            range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                                        } else {
                                            rangeInput[1].value = maxPrice;
                                            range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                                        }
                                    }
                                });
                            });

                            rangeInput.forEach((input) => {
                                input.addEventListener("input", (e) => {
                                    let minVal = parseInt(rangeInput[0].value),
                                        maxVal = parseInt(rangeInput[1].value);

                                    if (maxVal - minVal < priceGap) {
                                        if (e.target.className === "range-min") {
                                            rangeInput[0].value = maxVal - priceGap;
                                        } else {
                                            rangeInput[1].value = minVal + priceGap;
                                        }
                                    } else {
                                        priceInput[0].value = minVal;
                                        priceInput[1].value = maxVal;
                                        range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
                                        range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                                    }
                                });
                            });

                        </script>

                        <div class="col-md-12">
                            <p class="fs-5 fw-bold">Category</p>
                            <ul class="navbar-nav">
                                @foreach($product_categories as $category)
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('home.product', $category->product_category_slug) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-10 col-lg-9 col-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="float-end">
                                    <form method="GET" action="{{ route('products.sort', $product_category->product_category_slug) }}">
                                        <select class="form-control" name="sort_by" id="sort_by" onchange="this.form.submit()">
                                            <option value="all" {{ request('sort_by') == '' ? 'selected' : '' }}>Sort By</option>
                                            <option value="highest_price" {{ request('sort_by') == 'highest_price' ? 'selected' : '' }}>Price High to Low</option>
                                            <option value="lowest_price" {{ request('sort_by') == 'lowest_price' ? 'selected' : '' }}>Price Low to High</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if($products->isEmpty())
                                <div class="col-md-12 py-3">
                                    <div class="alert alert-warning text-center" role="alert">
                                        No products found in this price range.
                                    </div>
                                </div>
                            @else
                                @foreach($products as $product)
                                    @if($product->offer_id == null)
                                    <div class="col-lg-3 col-md-4 col-sm-6 py-3">
                                        <div class="card border-0">
                                            <div class="card-header p-0 position-relative">
                                                <a href="{{ route('home.product.detail', $product->product_slug) }}">
                                                    <img class="img-fluid object-fit-cover img-product w-100" src="{{ asset($product->image) }}" alt="{{ $product->alt }}">
                                                    @if($product->stock == 0)
                                                        <div class="position-absolute top-50 start-50 translate-middle w-100 h-100 d-flex justify-content-center align-items-center bg-dark bg-opacity-50 text-white">
                                                            <span class="fs-1">Stock Out</span>
                                                        </div>
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="card-body px-1 pb-0 my-0">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <a class="text-decoration-none text-black pb-2" href="{{ route('home.product.detail', $product->product_slug) }}" style="font-size: 14px;">
                                                            {{ $product->name }}
                                                        </a>
                                                        <p style="font-size: 14px;">
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
                                                    <div>
                                                        @if(Auth::check())
                                                            @php
                                                                $favourite = Auth::user()->favourites()->where('product_id', $product->id)->first();
                                                            @endphp
                                                            @if($favourite)
                                                                <form action="{{ route('favourite.destroy', $favourite->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="text-danger bg-transparent border-0 p-0 m-0" type="submit">
                                                                        <i class="fa-solid fa-heart"></i>
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <form action="{{ route('favourite.store') }}" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                                                                    <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                                                    <button type="submit" class="btn bg-transparent p-0 m-0">
                                                                        <i class="fa-regular fa-heart text-black"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        @else
                                                            <form action="{{ route('favourite.store') }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn bg-transparent p-0 m-0">
                                                                    <i class="fa-regular fa-heart text-black"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="justify-content-between">
                                                <a class="btn btn-sm btn-dark text-white read-btn float-end" href="{{ route('home.product.detail', $product->product_slug) }}">
                                                    Read More
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            @endif
                            <div class="pagination-simple col-md-12 pt-5">
                                {{ $products->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .img-product{
            height: 400px;
        }
        @media screen and (min-width: 1921px){
            .img-product{
                height: 35vh;
            }
        }
        @media screen and (min-width: 1801px) and (max-width: 1920px){
            .img-product{
                height: 380px;
            }
        }
        @media screen and (min-width: 1601px) and (max-width: 1800px){
            .img-product{
                height: 350px;
            }
        }
        @media screen and (min-width: 1440px) and (max-width: 1600px){
            .img-product{
                height: 350px;
            }
        }
        @media screen and (min-width: 1281px) and (max-width: 1439px){
            .img-product{
                height: 300px;
            }
            .offer-ribbon{
                transform: scale(0.9);
            }
            .read-btn{
                transform: scale(0.9);
            }
        }
        @media screen and (min-width: 993px) and (max-width: 1280px){
            .img-product{
                height: 250px;
            }
            .offer-ribbon{
                text-align: center!important;
                margin-bottom: 4px;
                width: 100%;
            }
            .read-btn{
                margin-bottom: 4px;
                width: 100%;
            }
        }
        @media screen and (min-width: 769px) and (max-width: 992px){
            .img-product{
                height: 380px;
            }
        }
        @media screen and (min-width: 577px) and (max-width: 768px){
            .img-product{
                height: 320px;
            }
        }
        @media screen and (min-width: 426px) and (max-width: 576px){
            .img-product{
                height: 450px;
            }
        }
        @media screen and (min-width: 321px) and (max-width: 425px){
            .img-product{
                height: 420px;
            }
        }
        @media screen and (min-width: 100px) and (max-width: 320px){
            .img-product{
                height: 280px;
            }
        }
    </style>

@endsection
