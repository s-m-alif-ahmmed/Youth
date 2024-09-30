@extends('admin.master')

@section('title')
    Product Detail
@endsection

@section('content')
    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('product.index') }}">Products</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Product Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="">
                <a class="btn btn-success rounded-3" href="{{ route('product.create') }}">Add Product</a>
            </div>

        </div>
        <!--end breadcrumb-->

        {{--        message--}}
        @if(session('message'))
            <p class="text-center text-primary">{{session('message')}}</p>
        @endif

        <hr/>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header fs-3 fw-bold">Product Detail Page</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th> Product Create Time </th>
                                    <td>{{$product->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia')}}</td>
                                </tr>
                                <tr>
                                    <th> Meta Title </th>
                                    <td>{{$product->meta_title}}</td>
                                </tr>
                                <tr>
                                    <th> Meta Description </th>
                                    <td>{{$product->meta_description}}</td>
                                </tr>
                                <tr>
                                    <th> Menu Name </th>
                                    <td>{{$product->menu->name}}</td>
                                </tr>
                                <tr>
                                    <th> Product Category Name </th>
                                    <td>{{$product->productCategory->name}}</td>
                                </tr>
                                <tr>
                                    <th> Product Brand Name </th>
                                    <td>{{$product->productBrand->name}}</td>
                                </tr>
                                @if($product->offer_id)
                                <tr>
                                    <th> Offer </th>
                                    <td>{{$product->offer->name}}</td>
                                </tr>
                                @endif
                                @if($product->event_id)
                                <tr>
                                    <th> Event </th>
                                    <td>{{$product->event->name}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th> Product Name </th>
                                    <td>{{$product->name}}</td>
                                </tr>
                                <tr>
                                    <th> Product Feature Image </th>
                                    <td>
                                        <img class="img-fluid" src="{{ asset($product->image) }}" alt="{{ $product->alt }}" style="height: 100px; width: 180px;" />
                                    </td>
                                </tr>
                                <tr>
                                    <th> Product Feature Image Alt </th>
                                    <td>{{$product->alt}}</td>
                                </tr>
                                <tr>
                                    <th> Product More Images </th>
                                    <td>
                                        @foreach($product->otherImages as $image)
                                            <img class="img-fluid m-1" src="{{ asset($image->other_image) }}" alt="{{ $image->alt }}" style="height: 100px; width: 180px;" />
                                        @endforeach
                                    </td>
                                </tr>
                                @if($product->size)
                                <tr>
                                    <th> Product Size </th>
                                    <td>
                                        @if($product->sizes->isNotEmpty())
                                            @foreach($product->sizes as $size)
                                                {{ $size->name }} ({{ $size->type_name }}),
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <th> Product Stock </th>
                                    <td>{{$product->stock}}</td>
                                </tr>
                                @if($product->regular_price)
                                <tr>
                                    <th> Regular Price </th>
                                    <td>{{$product->regular_price}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th> Selling Price </th>
                                    <td>{{$product->selling_price}}</td>
                                </tr>
                                @if($product->discount)
                                <tr>
                                    <th> Discount </th>
                                    <td>{{$product->discount}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th> Product Description </th>
                                    <td>
                                        {!! $product->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th> Product Status</th>
                                    <td>
                                        @if($product->status == 'active')
                                            <a href="{{ route('change.product.status', $product->id) }}">
                                                <div class="main-toggle-group style1 d-flex flex-wrap mt-3">
                                                    <div class="toggle toggle-warning toggle-sm on">
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </a>
                                        @else($product->status == 'inActive')
                                            <a href="{{ route('change.product.status', $product->id) }}">
                                                <div class="main-toggle-group style1 d-flex flex-wrap mt-3">
                                                    <div class="toggle toggle-warning toggle-sm off">
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Most Selling Product Status </th>
                                    <td>
                                        @if($product->popular_status == 'active')
                                            <a href="{{ route('change.popular.product.status', $product->id) }}">
                                                <div class="main-toggle-group style1 d-flex flex-wrap mt-3">
                                                    <div class="toggle toggle-warning toggle-sm on">
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </a>
                                        @else($product->popular_status == 'inActive')
                                            <a href="{{ route('change.popular.product.status', $product->id) }}">
                                                <div class="main-toggle-group style1 d-flex flex-wrap mt-3">
                                                    <div class="toggle toggle-warning toggle-sm off">
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
{{--                                <tr>--}}
{{--                                    <th> Related Product Status </th>--}}
{{--                                    <td>--}}
{{--                                        @if($product->related_status == 'active')--}}
{{--                                            <a href="{{ route('change.related.product.status', $product->id) }}">--}}
{{--                                                <div class="main-toggle-group style1 d-flex flex-wrap mt-3">--}}
{{--                                                    <div class="toggle toggle-warning toggle-sm on">--}}
{{--                                                        <span></span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </a>--}}
{{--                                        @else($product->related_status == 'inActive')--}}
{{--                                            <a href="{{ route('change.related.product.status', $product->id) }}">--}}
{{--                                                <div class="main-toggle-group style1 d-flex flex-wrap mt-3">--}}
{{--                                                    <div class="toggle toggle-warning toggle-sm off">--}}
{{--                                                        <span></span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
                                <tr>
                                    <th>Action</th>
                                    <td>
                                        <div class="d-flex">
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                                <a href="{{route('product.edit', Crypt::encryptString($product->id) )}}" class="text-warning mx-2"><i class="fa fa-edit"></i></a>
                                            </span>
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                                <form action="{{ route('product.destroy', $product->id )}}" method="post" id="deleteForm{{ $product->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-danger border-0 mx-2" type="button" onclick="return deleteAction('{{ $product->id }}', 'Are you sure to delete this product?', 'btn-danger')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
