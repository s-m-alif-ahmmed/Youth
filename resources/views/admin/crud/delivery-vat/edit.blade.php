@extends('admin.master')

@section('title')
    Edit Delivery Charge & Vat
@endsection

@section('content')

    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('delivery-vat.index') }}">Delivery Charge & Vat</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Delivery Charge & Vat</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        {{--        message--}}
        <p class="text-center text-primary">{{session('message')}}</p>

        <hr>
        <!-- Create Category Form-->
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">Edit Delivery Charge & Vat</h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class="row g-3" method="post" action="{{route('delivery-vat.update', Crypt::encryptString($delivery_tax->id) )}}">
                                @csrf
                                @method('patch')

                                <div class="col-12">
                                    <label for="location" class="form-label"> Delivery Location </label>
                                    <input class="form-control" type="text" name="location" id="location" value="{{ $delivery_tax->location }}" placeholder="Enter location" required />
                                </div>

                                <div class="col-12">
                                    <label for="delivery_charge" class="form-label"> Delivery Charge </label>
                                    <input class="form-control" type="text" name="delivery_charge" id="delivery_charge" value="{{ $delivery_tax->delivery_charge }}" placeholder="Enter delivery charge tk" required />
                                </div>

                                <div class="col-12">
                                    <label for="vat" class="form-label"> Vat </label>
                                    <input class="form-control" type="text" name="vat" id="vat" value="{{ $delivery_tax->vat }}" placeholder="Enter vat percentage" required />
                                </div>

                                <div class="col-12 text-center">
                                    <button class="btn btn-primary px-4" type="submit">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
