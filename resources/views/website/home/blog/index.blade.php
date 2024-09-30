@extends('website.master')

@section('meta_info')
    <meta name="title" content="Youth Blogs">
    <meta name="description" content="This is Youth website blog page.">
@endsection

@section('title')
    Youth | Blogs
@endsection

@section('content')

    {{--cart--}}
    @include('website.includes.cart')

    <section class="section pt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1 class="mb-5">Blogs</h1>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 mb-5 order-md-1">
                    <h1 class="visually-hidden"></h1>
                    @foreach($blogs as $blog)
                        @if($blog->status == 'Publish')

                            <article class="row mb-5">
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <div class="mb-3">
                                        <img src="{{ asset($blog->image) }}" class="img-fluid w-100 rounded-3" alt="{{ $blog->alt }}" style="height:200px; object-fit: cover; border-radius: 15px;">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h3 class="h5">
                                        <a class="post-title text-decoration-none text-dark" href="{{ route('home.blog.detail', $blog->slug) }}">
                                            {{ strlen($blog->title) >= 15 ? substr($blog->title, 0, 15) . '...' : $blog->title}}
{{--                                            {{ $blog->heading }}--}}
                                        </a>
                                    </h3>
                                    <ul class="list-inline post-meta mb-2">
                                        <li class="list-inline-item">Date : {{ $blog->created_at->format('M d, Y') }}</li>
                                        <li class="list-inline-item">Categories :
                                            <a href="{{ route('home.blog.category', $blog->blog_category->blog_category_slug) }}" class="text-decoration-none text-black py-2 ml-1">
{{--                                                {{ $blog->blog_category->name }}--}}
                                                {{ strlen($blog->blog_category->name) >= 15 ? substr($blog->blog_category->name, 0, 15) . '...' : $blog->blog_category->name}}
                                            </a>
                                        </li>
                                    </ul>
                                    <p>
                                        {{ strlen($blog->short_description) >= 15 ? substr($blog->short_description, 0, 15) . '...' : $blog->short_description}}
{{--                                        {{ $blog->short_description }}--}}
                                    </p>
                                    <a href="{{ route('home.blog.detail', $blog->slug) }}" class="btn btn-dark">Continue Reading</a>
                                </div>
                            </article>
                        @endif
                    @endforeach
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 order-md-2 mb-3">
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
            </div>
            <div class="row">
                <div class="pagination-simple col-md-12 pt-5">
                    {{ $blogs->links('pagination::bootstrap-5') }}
                </div>
            </div>

            <style>
                .order-md-1{
                    order: 2;
                }
                .order-md-2{
                    order: 1;
                }
            </style>

        </div>
    </section>

@endsection
