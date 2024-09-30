@extends('admin.master')

@section('title')
    Add Offer Image
@endsection

@section('content')

    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('offer.index') }}">Offer</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Offer Image</li>
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
                        <h5 class="mb-0">Add New Offer Image </h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class=" g-3" method="post" action="{{route('offer.store')}}" enctype="multipart/form-data">
                                @csrf
                                @method('post')

                                <div class="col-12 mb-2">
                                    <label for="name" class="form-label"> Offer Name </label>
                                    <input class="form-control" type="text" name="name" id="name" placeholder="Enter offer name" required />
                                </div>

                                <div class="col-12 mb-2">
                                    <label for="image" class="form-label"> Offer Image (1600*200px) </label>
                                    <input class="form-control" type="file" name="image" id="image" placeholder="Enter offer image" required />
                                </div>

                                <div class="col-12 mb-2">
                                    <label for="alt" class="form-label"> Offer Image Alt </label>
                                    <input class="form-control" type="text" name="alt" id="alt" placeholder="Enter offer image alt" required />
                                </div>

                                <div class="col-12 mb-2 text-center">
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
