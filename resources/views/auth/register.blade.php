@extends('website.master')

@section('title')
    Youth | Signup
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
                                    <p class="text-uppercase m-0 fw-bolder text-white" style="font-size: 28px;"> SIGNUP</p>
                                </div>
                            </div>
                            <div class="card-body bg-transparent">
                                <form action="{{ route('register') }}" method="POST" class="login100-form validate-form">
                                    @csrf

                                    <div class="col-12 mb-2">
                                        <div class="input-group border-0 mb-3" data-bs-validate = "Full Name is required">
                                            <span class="input-group-text position-relative border-0" id="basic-addon1" style="background-color: #ffffff;">
                                                <i class="fa-regular fa-user"></i>
                                            </span>
                                            <input class="form-control border-0" type="text" name="name" style="background-color: #ffffff !important;" id="name" :value="old('name')" placeholder="Enter full Name" required autofocus autocomplete="name" />
                                        </div>
                                        <x-input-error :messages="$errors->get('name')" class="my-2" />
                                    </div>

                                    <div class="col-12 mb-2">
                                        <div class="input-group border-0 mb-3" data-bs-validate = "Email is required">
                                            <span class="input-group-text position-relative border-0" id="basic-addon1" style="background-color: #ffffff;">
                                                <i class="fa-regular fa-envelope"></i>
                                            </span>
                                            <input class="form-control border-0" type="email" name="email" id="email" style="background-color: #ffffff !important;" placeholder="Enter email" :value="old('email')" required autocomplete="username" />
                                        </div>
                                        <x-input-error :messages="$errors->get('email')" class="my-2" />
                                    </div>

                                    <div class="col-12 mb-2">
                                        <div class="input-group border-0 mb-3" data-bs-validate = "Password is required">
                                            <span class="input-group-text position-relative border-0" id="basic-addon1" style="background-color: #ffffff;">
                                                <i class="fa-solid fa-lock"></i>
                                            </span>
                                            <input class="form-control border-0" type="password" name="password" id="password" style="background-color: #ffffff !important;" placeholder="Enter password" required autocomplete="current-password" />
                                        </div>
                                        <x-input-error :messages="$errors->get('password')" class="my-2" />
                                    </div>

                                    <div class="col-12 mb-2">
                                        <div class="input-group border-0 mb-3" data-bs-validate = "Confirm Password is required">
                                            <span class="input-group-text position-relative border-0" id="basic-addon1" style="background-color: #ffffff;">
                                                <i class="fa-solid fa-lock"></i>
                                            </span>
                                            <input class="form-control border-0" type="password" name="password_confirmation" id="password_confirmation" style="background-color: #ffffff !important;" placeholder="Enter Confirm Password" required autocomplete="new-password" />
                                        </div>
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="my-2" />
                                    </div>

                                    <div class="col-12 mt-5">
                                        <div class=" text-center">
                                            <input class="btn bg-white text-black fw-bold mb-2" type="submit" value="SIGN UP" />
                                        </div>
                                    </div>
                                </form>

{{--                                <div class="d-flex justify-content-center">--}}
{{--                                    <hr class="w-25 fw-bolder mx-2"/>--}}
{{--                                    <p class="fw-bold mt-1">Or</p>--}}
{{--                                    <hr class="w-25 fw-bolder mx-2"/>--}}
{{--                                </div>--}}

                                <div class="text-center pt-2">
                                    <p class="text-white mb-0">Already a member?<a href="{{route('login')}}" class="text-primary text-decoration-none ms-1"> Login </a></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-control:focus {
            outline: none !important;
            box-shadow: none !important;
        }

    </style>

@endsection



