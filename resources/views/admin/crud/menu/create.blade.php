@extends('admin.master')

@section('title')
    Product Category
@endsection

@section('content')
    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('menus.index') }}">Menus</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Menu</li>
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
                        <h5 class="mb-0">Add New Menu </h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class="row g-3" method="post" action="{{route('menus.store')}}" enctype="multipart/form-data">
                                @csrf
                                @method('post')

                                <div class="col-12">
                                    <label for="name" class="form-label"> Name</label>
                                    <input class="form-control" type="text" name="name" id="name" placeholder="Enter category name" required />
                                    <x-input-error :messages="$errors->get('name')" class="my-2" />
                                </div>

                                <div class="col-12">
                                    <label for="image" class="form-label"> Banner Image (1600*500px)</label>
                                    <input class="form-control" type="file" name="image" id="image" placeholder="Enter image" required />
                                    <x-input-error :messages="$errors->get('image')" class="my-2" />
                                </div>

                                <div class="col-12">
                                    <label for="alt" class="form-label">Banner Image Alt</label>
                                    <input class="form-control" type="text" name="alt" id="alt" placeholder="Enter image alt" required />
                                    <x-input-error :messages="$errors->get('alt')" class="my-2" />
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
