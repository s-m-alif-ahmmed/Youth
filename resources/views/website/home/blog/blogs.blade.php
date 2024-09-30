@extends('website.master')

@section('title')
    {{ $category->name }}
@endsection

@section('content')

    {{--cart--}}
    @include('website.includes.cart')

    <section class="section-sm pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title text-center">
                        <h1 class="mt-3 mb-4">{{ $category->name }}</h1>
                    </div>
                </div>
                @foreach($blogs as $blog)
{{--                        @if($blog->category_id == $category->id)--}}
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <article class="mb-5">
                                    <div class="mb-3">
                                        <img src="{{ asset($blog->image) }}" class="img-fluid" alt="{{ $blog->alt }}" style="height: 250px; object-fit: cover; border-radius: 15px;" />
                                    </div>
                                    <h3 class="h5">
                                        <a class="post-title text-decoration-none text-dark" href="{{ route('home.blog.detail', $blog->slug) }}">
                                            {{ strlen($blog->title) >= 35 ? substr($blog->title, 0, 30) . '...' : $blog->title}}
                                        </a>
                                    </h3>
                                    <ul class="list-inline post-meta mb-2">
                                        <li class="list-inline-item">
                                            Date: {{ $blog->created_at->format('M d, Y') }}
                                        </li>
                                        <li class="list-inline-item">
                                            Categories:
                                            <a href="{{ route('home.blog.category', $blog->blog_category->blog_category_slug) }}" class="ml-1 text-decoration-none text-dark">
                                                {{ strlen($blog->blog_category->name) >= 12 ? substr($blog->blog_category->name, 0, 10) . '...' : $blog->blog_category->name}}
                                            </a>
                                        </li>
                                    </ul>
                                    <p class="pe-4 text-justify">
                                        {{ strlen($blog->short_description) >= 100 ? substr($blog->short_description, 0, 95) . '...' : $blog->short_description}}
                                    </p>
                                    <a href="{{ route('home.blog.detail', $blog->slug) }}" class="btn btn-dark">Continue Reading</a>
                                </article>
                            </div>
{{--                        @endif--}}
                @endforeach



                <div class="pagination-simple col-md-12 pt-5">
                    {{ $blogs->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>

@endsection
