@extends('website.master')

@section('title')
    Reset Password
@endsection

@section('content')

    <section class="py-5">

        <div class="container">
            <div class="row">
                <div class="col-md-6 card mx-auto border-0">
                    <p class="mb-4 text-center fs-5">Reset Password</p>
                    <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="form-group">
                            <div class="row row-sm">
                                <div class="col-md-3 text-end p-2">
                                    <label for="email" class="form-label">Email</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email address" value="{{ $request->email }}" required autofocus autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>
                            <div class="row row-sm">
                                <div class="col-md-3 text-end p-2">
                                    <label for="password" class="form-label">New Password</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter new password" required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>
                            <div class="row row-sm">
                                <div class="col-md-3 text-end p-2">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Enter confirm password" required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="flex text-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Reset Password') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
