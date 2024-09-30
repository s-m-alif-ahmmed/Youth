@extends('website.master')

@section('title')
    Confirm Password
@endsection

@section('content')

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 card mx-auto border-0">
                    <p class="mb-4 text-center fs-5">Confirm Password</p>
                    <div class="mb-4 fs-6 text-success">
                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                    </div>
                    <form>
                        <div class="form-group">
                            <div class="row row-sm">
                                <div class="col-md-3 text-center p-2">
                                    <label for="code" class="form-label">New Password</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter a new password" required>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row row-sm">
                                <div class="col-md-3 text-center p-2">
                                    <label for="code" class="form-label">Confirm Password</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Confirm your new password" required>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="text-center p-2">
                            <button class="btn btn-info" type="submit"><a>Submit</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
