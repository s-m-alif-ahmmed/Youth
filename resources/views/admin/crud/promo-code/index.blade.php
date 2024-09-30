@extends('admin.master')

@section('title')
    Add Coupon
@endsection

@section('content')

    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('coupon.index') }}">Coupon</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Coupon</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

{{--                message--}}
        <p class="text-center text-primary">{{session('message')}}</p>

        <hr>
        <!-- Create Category Form-->
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">Add New Coupon </h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class=" g-3" method="post" action="{{route('coupon.store')}}">
                                @csrf
                                @method('post')

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Code</label>
                                    <div class="col-md-9">
                                        <input class="form-control" name="code" placeholder="Enter coupon code" type="text" required />
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Name</label>
                                    <div class="col-md-9">
                                        <input class="form-control" name="name" placeholder="Enter coupon code name" type="text">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Max Uses</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="max_uses" placeholder="Max Uses">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Max Uses User</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="max_uses_user" placeholder="Max Uses User">
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="type" class="col-md-3 form-label">Type</label>
                                    <div class="col-md-9">
                                        <select name="type" id="type" class="form-control" required >
                                        <option value="percent">Percent</option>
                                        <option value="fixed">Fixed</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Discount Amount</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="discount_amount" placeholder="Enter discount amount" required/>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label class="col-md-3 form-label">Minimum Amount</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="min_amount" placeholder="Enter minimum amount" required/>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="status" class="col-md-3 form-label">Coupon Status</label>
                                    <div class="col-md-9">
                                        <select name="status" id="status" class="form-control" required >
                                            <option value="active">Active</option>
                                            <option value="inActive">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="starts_at" class="col-md-3 form-label">Starts At</label>
                                    <div class="col-md-9">
                                        <input type="datetime-local" class="form-control" name="starts_at" id="starts_at" step="1">
                                        @if($errors->has('starts_at'))
                                            <div class="alert alert-danger fs-6 my-2 py-0">{{ $errors->first('starts_at') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="expires_at" class="col-md-3 form-label">Expires At</label>
                                    <div class="col-md-9">
                                        <input type="datetime-local" class="form-control" name="expires_at" id="expires_at" step="1">
                                        @if($errors->has('expires_at'))
                                            <div class="alert alert-danger fs-6 my-2 py-0">{{ $errors->first('expires_at') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 text-center">
                                    <button class="btn btn-primary px-4" type="submit">Create</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
