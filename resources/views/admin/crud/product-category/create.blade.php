@extends('admin.master')

@section('title')
    Product Category
@endsection

@section('content')
    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('product-category.index') }}">Category</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Category</li>
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
                        <h5 class="mb-0">Add New Category </h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class="row g-3" method="post" action="{{route('product-category.store')}}" enctype="multipart/form-data">
                                @csrf
                                @method('post')

                                <div class="col-6">
                                    <label for="menu" class="form-label"> Menu </label>
                                    <div class="form-group">
                                        <select class="form-control select2" name="menu_id" id="menu" data-placeholder="Choose one menu" required >
                                            <option >Select Menu</option>
                                            @foreach($menus as $menu)
                                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('menu_id')" class="my-2" />
                                </div>

                                <div class="col-12">
                                    <label for="name" class="form-label"> Name</label>
                                    <input class="form-control" type="text" name="name" id="name" placeholder="Enter category name" required />
                                    <x-input-error :messages="$errors->get('name')" class="my-2" />
                                </div>

                                <div class="col-12">
                                    <label for="feature_image" class="form-label"> Feature Image (1024*683px)</label>
                                    <input class="form-control" type="file" name="feature_image" id="feature_image" placeholder="Enter category name" required />
                                    <x-input-error :messages="$errors->get('feature_image')" class="my-2" />
                                </div>

                                <div class="col-12">
                                    <label for="feature_alt" class="form-label"> Home Feature Image Alt</label>
                                    <input class="form-control" type="text" name="feature_alt" id="feature_alt" placeholder="Enter category name" required />
                                    <x-input-error :messages="$errors->get('feature_alt')" class="my-2" />
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
