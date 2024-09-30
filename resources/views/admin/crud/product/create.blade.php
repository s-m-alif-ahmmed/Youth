@extends('admin.master')

@section('title')
    Product
@endsection

@section('content')
    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-5">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('product.index') }}">Product</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
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
                        <h5 class="mb-0">Add New Product </h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class="row g-3" method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
                                @csrf
                                @method('post')

                                <div class="col-12">
                                    <label for="meta_title" class="form-label"> Meta Title</label>
                                    <input class="form-control" type="text" name="meta_title" id="meta_title" value="" placeholder="Enter meta title" required />
                                    <x-input-error :messages="$errors->get('meta_title')" class="my-2" />
                                </div>

                                <div class="col-12">
                                    <label for="meta_description" class="form-label"> Meta Description </label>
                                    <textarea class="form-control" name="meta_description" id="meta_description" placeholder="Enter meta description" cols="30" rows="3" required ></textarea>
                                    <x-input-error :messages="$errors->get('meta_description')" class="my-2" />
                                </div>

                                <div class="col-12">
                                    <label for="name" class="form-label"> Name</label>
                                    <input class="form-control" type="text" name="name" id="name" value="" placeholder="Enter product name" required />
                                    <x-input-error :messages="$errors->get('name')" class="my-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="menu" class="form-label"> Menu </label>
                                    <div class="form-group">
                                        <select class="form-control select2" name="menu_id" id="menu" data-placeholder="Choose one menu" required >
                                            <option value="">Select Menu</option>
                                            @foreach($menus as $menu)
                                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('menu_id')" class="my-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="category" class="form-label"> Product Category </label>
                                    <div class="form-group">
                                        <select class="form-control select2" name="product_category_id" id="product-category" data-placeholder="Choose one category" required >
                                            <option value="">Select Category</option>
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('product_category_id')" class="my-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="product_brand_id" class="form-label"> Product Brand </label>
                                    <div class="form-group">
                                        <select class="form-control select2 form-select" name="product_brand_id" id="product_brand_id" >
                                            <option value="" >Select Product Brand</option>
                                            @foreach($product_brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('product_brand_id')" class="my-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="image" class="form-label"> Product Image (1200*1200px)</label>
                                    <input class="form-control" type="file" name="image" id="image" value="" required />
                                    <x-input-error :messages="$errors->get('image')" class="my-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="alt" class="form-label"> Product Image Alt</label>
                                    <input class="form-control" type="text" name="alt" id="alt" value="" placeholder="Enter image alt" required />
                                    <x-input-error :messages="$errors->get('alt')" class="my-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="other_image" class="form-label"> Product More Images (1200*1200px)</label>
                                    <input class="form-control" type="file" name="other_image[]" id="other_image" value="" multiple required />
                                    <x-input-error :messages="$errors->get('other_image')" class="my-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="product_size_id" class="form-label"> Product Size </label>
                                    <div class="form-group">
                                        <select class="form-control select2" name="product_size_id[]" id="product_size_id" data-placeholder="Choose product size" multiple >
                                            <option value="" >Select Product Size</option>
                                            @foreach($product_sizes as $size)
                                                <option value="{{ $size->id }}">{{ $size->name }} ({{ $size->type_name }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('product_size_id')" class="my-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="stock" class="form-label"> Product Stock </label>
                                    <input class="form-control" type="number" name="stock" id="stock" value="" placeholder="Enter product stock" required />
                                    <x-input-error :messages="$errors->get('stock')" class="my-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="discount" class="form-label"> Product Discount </label>
                                    <input class="form-control" type="number" name="discount" id="discount" value="" placeholder="Enter product discount percentage" />
                                    <x-input-error :messages="$errors->get('discount')" class="my-2" />
                                </div>

                                <div class="col-md-6 col-sm-12 col-12">
                                    <label for="offer_id" class="form-label"> Offer </label>
                                    <div class="form-group">
                                        <select class="form-control select2 form-select" name="offer_id" id="offer_id" >
                                            <option value="">Select Offer</option>
                                            @foreach($offers as $offer)
                                                <option value="{{ $offer->id }}">{{ $offer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('offer_id')" class="my-2" />
                                </div>

                                <div class="col-md-6 col-sm-12 col-12">
                                    <label for="event_id" class="form-label"> Event </label>
                                    <div class="form-group">
                                        <select class="form-control select2 form-select" name="event_id" id="event_id" >
                                            <option value="">Select Event</option>
                                            @foreach($events as $event)
                                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('event_id')" class="my-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="regular_price" class="form-label"> Product Regular Price </label>
                                    <input class="form-control" type="number" name="regular_price" id="regular_price" value="" placeholder="Enter regular price" />
                                    <x-input-error :messages="$errors->get('regular_price')" class="my-2" />
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                    <label for="selling_price" class="form-label"> Product Selling Price </label>
                                    <input class="form-control" type="number" name="selling_price" id="selling_price" value="" placeholder="Enter selling price" required />
                                    <x-input-error :messages="$errors->get('selling_price')" class="my-2" />
                                </div>

                                <div class="col-12">
                                    <label for="description" class="form-label"> Product Description</label>
                                    <textarea class="form-control" name="description" id="editor1" cols="30" rows="10" placeholder="Enter product description" required></textarea>
                                    <x-input-error :messages="$errors->get('description')" class="my-2" />
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
