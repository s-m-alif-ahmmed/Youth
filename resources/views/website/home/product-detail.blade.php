@extends('website.master')

@section('meta_info')
    <meta name="title" content="{{ $product->meta_title }}">
    <meta name="description" content="{{ $product->meta_description }}">
@endsection

@section('title')
    Product Detail
@endsection

@section('content')

    {{--cart--}}
    @include('website.includes.cart')

    <section class="py-3">
        <div class="container">
            @if(session('message'))
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center text-black py-2">{{ session('message') }}</p>
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

            <div class="row">
                <div class="col-md-5">
                    <div class="container" id="img-zoomer-box">
                        <img class="img-fluid object-fit-cover main-image w-100" id="expandedImg" src="{{ asset($product->image) }}" alt="{{ $product->alt }}" >
                    </div>
                    <style>
                        .main-image{
                            height: 500px;
                        }

                        @media screen and (min-width: 100px) and (max-width: 425px){
                            .main-image{
                                height: 300px !important;
                            }
                        }

                        @media screen and (min-width: 426px) and (max-width: 576px){
                            .main-image{
                                height: 400px !important;
                            }
                        }

                        #img-zoomer-box {
                            overflow: hidden;
                            position: relative;
                        }

                        #img-zoomer-box #expandedImg {
                            transition: transform 0.5s ease;
                            cursor: zoom-in; /* Change cursor to zoom-in when hovering over the image */
                        }

                        #img-zoomer-box #expandedImg.zoomed {
                            transform: scale(1.7); /* Zoom the image */
                            cursor: zoom-out; /* Change cursor to zoom-out when the image is zoomed */
                        }
                    </style>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const img = document.getElementById('expandedImg');
                            const container = document.getElementById('img-zoomer-box');

                            let isZoomed = false;

                            img.addEventListener('mouseenter', function () {
                                isZoomed = true;
                                img.classList.add('zoomed');
                            });

                            img.addEventListener('mouseleave', function () {
                                isZoomed = false;
                                img.classList.remove('zoomed');
                            });

                            img.addEventListener('mousemove', function (e) {
                                if (isZoomed) {
                                    const rect = container.getBoundingClientRect();
                                    const x = e.clientX - rect.left;
                                    const y = e.clientY - rect.top;

                                    const moveX = (x / rect.width) * 100;
                                    const moveY = (y / rect.height) * 100;

                                    img.style.transformOrigin = `${moveX}% ${moveY}%`;
                                }
                            });
                        });
                    </script>

                    <div class="container">
                        <div class="g-scrolling-carousel carousel-two">
                            <div class="items my-2">
                                @foreach($other_images as $image)
                                    <img src="{{ asset($image->other_image) }}" alt="{{ $product->alt }}" onclick="myFunction(this);">
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <style>
                        .g-scrolling-carousel .items > *{
                            min-height: 80px;
                            margin: 0 10px 0 10px;
                        }
                    </style>

                    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
                    <script>

                        $(document).ready(function(){
                            $(".carousel-two .items").gScrollingCarousel({
                                mouseScrolling: true,
                                draggable: false,
                                snapOnDrag: false,
                                mobileNative: false,
                            });
                        });

                        function myFunction(imgs) {
                            var expandImg = document.getElementById("expandedImg");
                            var imgText = document.getElementById("imgtext");
                            expandImg.src = imgs.src;
                            imgText.innerHTML = imgs.alt;
                            expandImg.parentElement.style.display = "block";
                        }
                    </script>

                </div>

                <div class="col-md-7">
                    <div class="">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-decoration-none text-black" href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <a class="text-decoration-none text-black" >{{ $product->menu->name }}</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <a class="text-decoration-none text-black" >{{ $product->productCategory->name }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $product->name }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="">
                        <h1>{{ $product->name }}</h1>
                        @if($product->offer_id)
                            <p class="offer-ribbon">{{ $product->offer->name }}</p>
                        @endif
                        @if($product->event_id)
                            <p class="offer-ribbon">{{ $product->event->name }}</p>
                        @endif
                    </div>
                    <div id="full-stars-example-two" class="d-flex justify-content-between">
                        <div class="d-flex">
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

                            <div class="rating-group">
                                @php
                                    $total_reviews = count($product_reviews);
                                    $sum = 0;

                                    foreach ($product_reviews as $review) {
                                        $sum += $review->star;
                                    }

                                    $average_review = $total_reviews > 0 ? $sum / $total_reviews : 0;
                                @endphp

                                <style>
                                    .text-gray{
                                        color: #2dce89 !important;
                                    }
                                </style>

                                <div class="d-flex align-items-center">
                                    <div class="ratings p-0 m-0">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if($i <= $average_review)
                                                <i class="fa fa-star text-warning"></i>
                                            @else
                                                <i class="fa fa-star text-gray"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="ps-2 py-0 pe-0 m-0" style="font-size: 16px;">({{ number_format($total_reviews) }} ratings)</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="" style="margin-top: -10px;">
                                @if(Auth::check())
                                @php
                                    $favourite = Auth::user()->favourites()->where('product_id', $product->id)->first();
                                @endphp
                                @if($favourite)
                                    <form action="{{ route('favourite.destroy', $favourite->id )}}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn text-danger bg-transparent border-0" type="submit">
                                            <i class="fa-solid fa-heart" style="font-size: 20px;"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('favourite.store') }}" method="POST">
                                        @csrf
                                        @method('POST')

                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                        <button type="submit" class="btn bg-transparent border-0">
                                            <i class="fa-regular fa-heart text-black" style="font-size: 20px;"></i>
                                        </button>
                                    </form>
                                @endif
                                @else
                                    <form action="{{ route('favourite.store') }}" method="POST">
                                        @csrf
                                        @method('POST')

                                        <input type="hidden" name="user_id"  />
                                        <input type="hidden" name="product_id" />
                                        <button type="submit" class="btn bg-transparent border-0">
                                            <i class="fa-regular fa-heart text-black" style="font-size: 20px;"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>

                        </div>
                    </div>
                    <style>
                        .rating__icon--star.checked {
                            color: #969595;
                        }
                        .rating__icon--star.checked {
                            color: gold;
                        }
                    </style>
                    <div class="d-flex my-auto">
                        <p class="me-3" style="font-size: 20px;">
                            ৳{{ $product->selling_price }}.00
                        </p>
                        <div class="d-flex my-auto" style="font-size: 14px;">
                            @if($product->regular_price)
                                <p class="text-decoration-line-through me-2">
                                    ৳{{ $product->regular_price }}.00
                                </p>
                            @endif
                            @if($product->discount)
                                <p class="mx-2">
                                    ({{ $product->discount }})
                                </p>
                            @endif
                        </div>
                    </div>
                    <form id="cartForm" action="" method="POST">
                        @csrf

                        <div class="d-flex">
                            <div class="border-quantity">
                                <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                                @if($product->stock == 0)
                                    <input class="border-0" type="number" name="quantity" id="number" value="0" min="1" max="{{ $product->stock }}" />
                                @else
                                    <input class="border-0" type="number" name="quantity" id="number" value="1" min="1" max="{{ $product->stock }}" />
                                @endif
                                <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
                            </div>
                            <div class="pt-2 px-2" style="font-size: 16px;">
                                @if($product->stock == 0)
                                    <p class="text-danger">(Stock out)</p>
                                @else
                                    <p>({{ $product->stock }} in stock)</p>
                                @endif
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('quantity')" class="my-2 text-black" />
                        @if($product->sizes->isNotEmpty())
                            <div class="d-flex mb-3">
                                <p class="my-auto" style="font-size: 16px;">Size:</p>
                                <div class="d-flex">
                                    @foreach($product->sizes as $size)
                                        <div class="form-check p-0 m-0" style="font-size: 16px;">
                                            <input type="radio" class="btn-check m-0" name="product_size_id" id="{{ $size->id }}" value="{{ $size->id }}" autocomplete="off" required>
                                            <label class="btn m-0 shadow" for="{{ $size->id }}">{{ $size->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('product_size_id')" class="my-2 text-black" />
                        @endif
                        @if(Auth::check())
                            <div class="d-flex mt-3">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                <div class="me-2">
                                    <button type="button" class="btn text-black bg-white shadow fw-bold" style="border: 2px solid black;" onclick="submitForm('buy_now')">Buy Now</button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-dark shadow text-white" onclick="submitForm('add_to_cart', true)" >Add to Cart</button>
                                </div>
                            </div>
                        @else
                            <div class="d-flex mt-3">
                                <input type="hidden" name="user_id" />
                                <input type="hidden" name="product_id" />
                                <div class="me-2">
                                    <button type="button" class="btn text-black bg-white shadow fw-bold" style="border: 2px solid black;" onclick="submitForm('buy_now')">Buy Now</button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-dark shadow text-white" onclick="submitForm('add_to_cart', true)" >Add to Cart</button>
                                </div>
                            </div>
                        @endif

                    </form>
                </div>
            </div>
            <script>
                function submitForm(action, openInNewTab = false) {
                    const form = document.getElementById('cartForm');
                    if (action === 'buy_now') {
                        form.action = "{{ route('cart.buy.now') }}";
                    } else {
                        form.action = "{{ route('cart.store') }}";
                        if (openInNewTab) {
                            form.target = "_blank";
                        } else {
                            form.target = "_self";
                        }
                    }
                    form.submit();
                }
            </script>

            <div class="row">
                <div class="col-md-12 pt-3">
                    <div class="">
                        <div class="social text-decoration-none">
                            <span class="d-flex">
                                <span class="fw-semibold" style="font-size: 20px;">
                                    Share Links:
                                </span>
                                <span style="margin-left: -20px; margin-top: -2px;">
                                    {!! $shareButtons !!}
                                </span>
                            </span>
                        </div>
                    </div>

                    <style>
                        .social ul{
                            display: flex !important;
                        }
                        .social ul>li{
                            text-decoration: none !important;
                            display: flex !important;
                            margin: 0 5px;
                            font-size: 24px !important;
                        }
                        .social ul>li a{
                            text-decoration: none !important;
                        }
                        .social ul>li a{
                            color: #0B5ED7 !important;
                        }
                        .social ul>li a:hover{
                            color: #0B5ED7 !important;
                        }
                    </style>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="tab-menu-heading border-bottom">
                            <div class="tabs-menu mb-3">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs">
                                    <li class="">
                                        <a class="active btn mx-3 text-decoration-none text-black shadow" data-bs-toggle="tab" href="#tab1">Specifications</a>
                                    </li>
                                    <li class="">
                                        <a class="mx-3 btn text-decoration-none text-black shadow" data-bs-toggle="tab" href="#tab2">Review</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body">
                            <div class="tab-content my-3">
                                <div class="tab-pane active" id="tab1">
                                    {!! $product->description !!}
                                </div>
                                <div class="tab-pane" id="tab2">
                                    @include('website.home.review.index')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <p class="fw-bold text-center" style="font-size: 20px;">Most Selling Products</p>
                    <div class="mx-auto" style="border: 1px solid rgba(0,0,0,0.85); width: 30%;"></div>
                </div>

                <div class="center slider">
                    @foreach($related_products as $product)
                        <div class="col-lg-3 col-xl-3 col-md-3 col-sm-12 col-12 mb-3 px-3">
                            <div class="card border-0 shadow-lg">
                                <a href="{{ route('home.product.detail', $product->product_slug) }}">
                                    <img class="img-fluid card-img-top object-fit-cover w-100" src="{{ asset( $product->image ) }}" alt="{{ $product->alt }}" style="height: 300px;">
                                    @if($product->stock == 0)
                                        <div class="position-absolute top-50 start-50 translate-middle w-100 h-100 d-flex justify-content-center align-items-center bg-dark bg-opacity-50 text-white">
                                            <span class="fs-1">Stock Out</span>
                                        </div>
                                    @endif
                                </a>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="">
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
                                        <div class="">
                                            @if(Auth::check())
                                                @php
                                                    $favourite = Auth::user()->favourites()->where('product_id', $product->id)->first();
                                                @endphp
                                                @if($favourite)
                                                    <form action="{{ route('favourite.destroy', $favourite->id )}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="text-danger bg-transparent border-0 p-0 m-0" type="submit">
                                                            <i class="fa-solid fa-heart"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('favourite.store') }}" method="POST">
                                                        @csrf
                                                        @method('POST')
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
                                                    @method('POST')
                                                    <input type="hidden" name="user_id" />
                                                    <input type="hidden" name="product_id" />
                                                    <button type="submit" class="btn bg-transparent p-0 m-0">
                                                        <i class="fa-regular fa-heart text-black"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <div class="py-0 my-0">
                                            @if($product->offer_id)
                                                <p class="offer-ribbon">{{ $product->offer->name }}</p>
                                            @endif
                                            @if($product->event_id)
                                                <p class="offer-ribbon">{{ $product->event->name }}</p>
                                            @endif
                                        </div>
                                        <div class="">
                                            <a class="btn btn-sm btn-dark text-white float-end" href="{{ route('home.product.detail', $product->product_slug) }}">
                                                Read More
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="col-md-12 mb-5 px-5">
                    <a class="btn btn-dark text-white float-end" href="{{ route('home.all.product') }}">View More</a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .slider {
            width: 100%;
            margin: 50px auto;
        }

        .slick-slide {
            margin: 0px 20px;
        }

        .slick-slide img {
            width: 100%;
        }

        .slick-prev:before,
        .slick-next:before {
            color: black;
        }

    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.4.0.min.js"></script>
    <script src="./slick/slick.js?v2022" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).on('ready', function() {
            $(".center").slick({
                dots: false,
                infinite: false,
                centerMode: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 768, // Mobile breakpoint
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            autoplay: false,        // Enable auto slide in mobile view
                            infinite: false,        // Infinite scrolling in mobile view
                            dots: false,             // Enable dots in mobile view if needed
                        }
                    }
                ]
            });
        });
    </script>

    <style>
    .border-quantity{
        margin: 0 !important;
        padding: 0 !important;
        border: 1px solid #ddd;
        height: 35px;
    }

    .value-button {
        display: inline-block;
        /*border: 1px solid #ddd;*/
        margin: -2px 0 0 0;
        width: 32px;
        height: 32px;
        text-align: center;
        vertical-align: middle;
        padding: 5px 0;
        background: #eee;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .value-button:hover {
        cursor: pointer;
    }

    #decrease {
        margin-right: -4px;
        /*border-radius: 8px 0 0 8px;*/
    }

    #increase {
        margin-left: -4px;
        /*border-radius: 0 8px 8px 0;*/
    }

    input#number {
        text-align: center;
        border: none;
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        margin: 1px 0 1px 0 !important;
        width: 31px;
        height: 32px;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<script>
    function increaseValue() {
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        value++;
        value > {{ $product->stock }} ? value = {{ $product->stock }} : '';
        document.getElementById('number').value = value;
    }

    function decreaseValue() {
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        value < 1 ? value = 1 : '';
        value--;
        document.getElementById('number').value = value;
    }
</script>


<style>
    #full-stars-example-two {

    /* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
    .rating-group {
        display: inline-flex;
    }

    /* make hover effect work properly in IE */
    .rating__icon {
        pointer-events: none;
    }

    /* hide radio inputs */
    .rating__input {
        position: absolute !important;
        left: -9999px !important;
    }

    /* hide 'none' input from screenreaders */
    .rating__input--none {
        display: none
    }

    /* set icon padding and size */
    .rating__label {
        cursor: pointer;
        padding: 0 0.1em;
        font-size: 20px;
    }

    /* set default star color */
    .rating__icon--star {
        color: orange;
    }

    /* if any input is checked, make its following siblings grey */
    .rating__input:checked ~ .rating__label .rating__icon--star {
        color: #9f9d9d;
    }

    /* make all stars orange on rating group hover */
    .rating-group:hover .rating__label .rating__icon--star {
        color: orange;
    }

    /* make hovered input's following siblings grey on hover */
    .rating__input:hover ~ .rating__label .rating__icon--star {
        color: #9f9d9d;
    }
    }
</style>

@endsection
