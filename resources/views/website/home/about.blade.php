@extends('website.master')

@section('title')
    About Us
@endsection

@section('content')

    {{--cart--}}
    @include('website.includes.cart')

    <section>
        <div class="container py-3">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">About Youth</h1>
                    <div class="mx-auto" style="border: 1px solid black; width: 10%;"></div>
                </div>
            </div>
            <div class="row py-5">
                <div class="col-md-12 px-5">
                    @foreach($about_pages->take(1) as $about)
                        <span>
                        {!! $about->description !!}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
