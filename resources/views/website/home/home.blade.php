@extends('website.master')

@section('title')
    Youth
@endsection

@section('content')

    {{--cart--}}
    @include('website.includes.cart')

    <section class="mt-0 pt-0">
        <div class="container-fluid">
            @if(session('message'))
                <div class="row p-0 m-0">
                    <div class="col-md-12">
                        <p class="text-center text-black py-1">{{ session('message') }}</p>
                    </div>
                </div>
            @endif
            @if(session('search_message'))
                <div class="row p-0 m-0">
                    <div class="col-md-12">
                        <p class="text-center text-black py-1">{{ session('search_message') }}</p>
                    </div>
                </div>
            @endif
            <div class="row p-0">
                <div class="col-md-12 p-0 mt-0 mb-3">
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($hero_banners as $banner)
                                @if($banner->status == 'active')
                                    <div class="carousel-item {{ $banner->first_status }}">
                                        <img src="{{ asset($banner->image) }}" class="img-fluid d-block w-100 top-banner-img" alt="{{ $banner->alt }}" />
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <button class="carousel-control-prev justify-content-start ms-3" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next justify-content-end me-3" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12 px-3 pb-3">

                    <div id="carouselExampleControlsTouching" class="carousel slide mt-0" data-bs-ride="carousel" data-bs-touch="false">
                        <div class="carousel-inner">
                            @foreach($events as $event)
                                <div class="carousel-item {{ $event->first_status }} img-b">
                                    <a class="" href="{{ route('home.event.product', $event->event_slug) }}">
                                        <img src="{{ asset($event->image) }}" class="img-fluid offer-image w-100" alt="{{ $event->alt }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev justify-content-start ms-3" type="button" data-bs-target="#carouselExampleControlsTouching" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" ></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next justify-content-end me-3" type="button" data-bs-target="#carouselExampleControlsTouching" data-bs-slide="next">
                            <span class="carousel-control-next-icon" ></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>
            </div>

            <div class="row pt-0 mt-0">
                @foreach($product_categories as $category)
                    @if($category->status == 'active')
                        <div class="col-md-6">
                            <a href="{{ route('home.product', $category->product_category_slug) }}">
                                <img class="img-fluid pb-3" src="{{ asset( $category->feature_image ) }}" alt="{{ $category->feature_alt }}" />
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-12 px-3 pb-3">

                    <div id="carouselExampleSlidesOnly" class="carousel slide mt-0" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($offers as $offer)
                                @if($offer->status == 'active')
                                    <div class="carousel-item {{ $offer->first_status }} img-b">
                                        <a class="" href="{{ route('home.offer.product', $offer->offer_slug) }}">
                                            <img src="{{ asset($offer->image) }}" class="img-fluid offer-image w-100" alt="{{ $offer->alt }}">
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>



        </div>
    </section>

    <style>
        .offer-image{
            height: 200px;
        }
        @media screen and (max-width: 992px){
            .offer-image{
                height: 100px;
            }
            .top-banner-img{
                height: 200px;
            }
        }
    </style>

@endsection
