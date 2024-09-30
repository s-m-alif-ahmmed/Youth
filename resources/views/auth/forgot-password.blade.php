@extends('website.master')

@section('title')
    Forgot Password
@endsection

@section('content')

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 card mx-auto border-0">
                    <p class="mb-4 text-center fs-5">Forgot Password</p>
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

                    <div class="mb-4 fs-6 text-success text-center">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <div class="row row-sm">
                                <div class="col-md-3 text-center p-2">
                                    <label for="email" class="form-label">Email</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter email address" value="">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="text-center p-2">
                            <button class="btn btn-info" type="submit">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
