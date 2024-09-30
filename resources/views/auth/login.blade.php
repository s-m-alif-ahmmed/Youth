@extends('website.master')

@section('title')
    Youth | Login
@endsection

@section('content')

    <div class="container-fluid py-5" style="background-color: #ffffff;">
        <div class="row justify-content-center">
            <div class="col-md-4 m-5">
                <div class="container">
                    <div class="row">
                        <div class="card pb-5" style="background-color: #212529;">
                            <div class="card-header border-0 py-5 bg-transparent">
                                <div class="col-md-12 text-center">
                                    <p class="text-uppercase m-0 fw-bolder text-white" style="font-size: 28px;"> LOGIN</p>
                                </div>
                            </div>
                            <div class="card-body bg-transparent">
                                <form action="{{ route('login') }}" method="POST" >
                                    @csrf

                                    <div class="com-md-12">
                                        <div class="input-group border-0 mb-3">
                                            <span class="input-group-text position-relative border-0" id="basic-addon1" style="background-color: #ffffff;">
                                                <i class="fa-regular fa-user"></i>
                                            </span>
                                            <input class="form-control border-0" style="background-color: #ffffff !important;" type="email" name="email" id="email" :value="old('email')" placeholder="Email" aria-describedby="basic-addon1" autofocus autocomplete="username" required />
                                        </div>
                                        <x-input-error :messages="$errors->get('email')" class="my-2 text-white" />
                                    </div>

                                    <style>
                                        .form-control:focus {
                                            outline: none !important;
                                            box-shadow: none !important;
                                        }

                                    </style>

                                    <div class="com-md-12 d-flex my-2">
                                        <div class="input-group mb-3 border-0">
                                             <span class="input-group-text border-0" id="basic-addon2" style="background-color: #ffffff;">
                                                <i class="fa-solid fa-lock"></i>
                                            </span>
                                            <input class="form-control border-0" style="background-color: #ffffff !important;" type="password" name="password" id="password" placeholder="Password" autocomplete="current-password" aria-describedby="basic-addon2" required />
                                        </div>
                                        <x-input-error :messages="$errors->get('password')" class="my-2 text-white" />
                                    </div>

                                    <div class="col-md-12 d-flex justify-content-between my-3">
                                        <!-- Remember Me -->
                                        <div class="text-start">
                                            <label for="remember_me" class="">
                                                <input id="remember_me" type="checkbox" class="rounded " name="remember">
                                                <span class="ms-2 text-sm text-white">{{ __('Remember me') }}</span>
                                            </label>
                                        </div>

{{--                                        @if (Route::has('password.request'))--}}
{{--                                            <div class="text-end">--}}
{{--                                                <p class="mb-0"><a href="{{ route('password.request') }}" class="text-white text-decoration-none ms-1">Forgot Password?</a></p>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
                                    </div>

                                    <div class="col-md-12 text-center">
                                        <input class="btn bg-white text-black fw-bold mt-3 mb-2" type="submit" value="LOGIN" />
                                    </div>

                                    <div class="text-center pt-3">
                                        <p class="text-white mb-0">Don't have an account?<a href="{{route('register')}}" class="text-primary text-decoration-none ms-1"> Signup</a></p>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
