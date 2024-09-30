@extends('admin.master')

@section('title')
    Social Media
@endsection

@section('content')
    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('social-media.index') }}">Social Media</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Social Media</li>
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
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">Add New Social Media </h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class="row g-3" method="post" action="{{route('social-media.store')}}">
                                @csrf
                                @method('post')

                                <div class="col-12">
                                    <label for="color" class="form-label"> Choose Social Media Color </label>
                                    <input class="form-control" type="color" name="color" id="color" required style="width: 100px; height: 50px;" />
                                </div>

                                <div class="col-12">
                                    <label for="back_color" class="form-label"> Choose Social Media Background Color </label>
                                    <input class="form-control" type="color" name="back_color" id="back_color" required style="width: 100px; height: 50px;" />
                                </div>

                                <div class="col-12">
                                    <label for="name" class="form-label"> Social Media Name </label>
                                    <input class="form-control" type="text" name="name" id="name" placeholder="Enter social media name" required />
                                </div>

                                <div class="col-12">
                                    <label for="icon" class="form-label"> Social Media Icon Code </label>
                                    <input class="form-control" type="text" name="icon" id="icon" placeholder="Enter social media icon" required />
                                </div>

                                <div class="col-12">
                                    <label for="link" class="form-label"> Social Media Link </label>
                                    <input class="form-control" type="text" name="link" id="link" placeholder="Enter social media link" required />
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
