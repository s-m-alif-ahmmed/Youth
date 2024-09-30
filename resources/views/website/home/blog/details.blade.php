@extends('website.master')

@section('meta_info')
    <meta name="title" content="{{ $blog->meta_title }}">
    <meta name="description" content="{{ $blog->meta_description }}">
@endsection

@section('title')
    {{ $blog->title }}
@endsection

@section('content')

    {{--cart--}}
    @include('website.includes.cart')

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-lg-9 col-sm-12 order-md-1">
                    <article class="row mb-4">
                        <div class="col-12 mx-auto mb-4">
                            <h1 class="h2 mb-3 mt-3 text-justify">{{ $blog->title }}</h1>
                            <ul class="list-inline post-meta mb-3">
                                <li class="list-inline-item">Date : {{ $blog->created_at->format('M d, Y') }}</li>
                                <li class="list-inline-item">Categories :
                                    <a href="{{ route('home.blog.category', $blog->blog_category->blog_category_slug) }}" class="text-decoration-none text-black ml-1">
                                        {{ $blog->blog_category->name }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="mb-3 text-center">
                                <img src="{{ asset($blog->image) }}" class="img-fluid" alt="{{ $blog->alt }}" style="height: 450px; object-fit: cover; border-radius: 15px;" />
                            </div>
                        </div>
                        <div class="col-lg-12 mx-auto">
                            <div class="content">
                                <span style="color: #1a1c1b !important;" >{!! $blog->description !!}</span>
                                <!--<p style="font-size: 18px;">{{ strip_tags($blog->description) }}</p>-->
                            </div>
                        </div>

                        <div class="col-lg-12 mt-3">
                            <div class="">
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

                                @include('website.home.blog.comment.comment')

                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 order-md-2">
                    <!-- categories -->
                    <div class="widget">
                        <h5 class="widget-title"><span>Categories</span></h5>
                        <ul class="list-unstyled widget-list">
                            @foreach($blog_categories as $category)
                                <li class="">
                                    <a href="{{ route('home.blog.category', $category->blog_category_slug) }}" class="text-decoration-none text-black py-2 border-bottom d-flex">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <style>
                    .order-md-1{
                        order: 1;
                    }
                    .order-md-2{
                        order: 2;
                    }
                </style>

            </div>
        </div>
    </section>

@endsection
