@extends('website.master')

@section('title')
    Terms & Conditions
@endsection

@section('content')

    {{--cart--}}
    @include('website.includes.cart')

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h1 class="text-center">Terms & Conditions</h1>
                    @foreach($terms_and_conditions->take(1) as $terms)
                        <p>
                            {!! $terms->terms_and_condition !!}
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
