@extends('website.master')

@section('title')
    Privacy Policy
@endsection

@section('content')

    {{--cart--}}
    @include('website.includes.cart')

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 mx-auto">
                    <h1 class="text-center">Privacy Policy</h1>
                    @foreach($privacy_policies->take(1) as $privacy)
                        <p>
                            {!! $privacy->privacy_policy !!}
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
