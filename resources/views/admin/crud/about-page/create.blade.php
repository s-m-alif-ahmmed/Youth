@extends('admin.master')

@section('title')
    About Page
@endsection

@section('content')
    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('product-brand.index') }}">Brand</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New About Page Description</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        {{--        message--}}
        @if(session('message'))
            <p class="text-center text-primary">{{session('message')}}</p>
        @endif
        <hr>
        <!-- Create Category Form-->
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">Add New About Page Description </h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class="row g-3" method="post" action="{{route('about-page.store')}}">
                                @csrf
                                @method('post')

                                <div class="col-12">
                                    <label for="description" class="form-label"> About Page Description</label>
                                    <textarea name="description" id="editor" cols="30" rows="10" placeholder="Enter about page description" required></textarea>
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
