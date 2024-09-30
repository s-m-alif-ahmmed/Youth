@extends('admin.master')

@section('title')
    Product Brand Detail
@endsection

@section('content')
    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('product-brand.index') }}">Brand</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Brand Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="">
                <a class="btn btn-success rounded-3" href="{{ route('product-brand.create') }}">Add Brand</a>
            </div>

        </div>
        <!--end breadcrumb-->

        {{--        message--}}
        <p class="text-center text-muted">{{session('message')}}</p>

        <hr/>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header fs-3 fw-bold">Brand Detail Page</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th> Brand Create Time </th>
                                    <td>{{$product_brand->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia')}}</td>
                                </tr>
                                <tr>
                                    <th> Brand Name </th>
                                    <td>{{$product_brand->name}}</td>
                                </tr>
                                <tr>
                                    <th> Brand Menu Status</th>
                                    <td>
                                        @if($product_brand->filter_status == 'active')
                                            <a href="{{ route('change.product-brand.filter.status', $product_brand->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')"  class="btn btn-success">Active</a>
                                        @else($product_brand->filter_status == 'inActive')
                                            <a href="{{ route('change.product-brand.filter.status', $product_brand->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">Deactive</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Brand Status</th>
                                    <td>
                                        @if($product_brand->status == 'active')
                                            <a href="{{ route('change.product-brand.status', $product_brand->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')"  class="btn btn-success">Active</a>
                                        @else($product_brand->status == 'inActive')
                                            <a href="{{ route('change.product-brand.status', $product_brand->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">Deactive</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <td>
                                        <div class="d-flex">
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                                <a href="{{route('product-brand.edit', $product_brand->product_brand_slug )}}" class="text-warning mx-2"><i class="fa fa-edit"></i></a>
                                            </span>
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                                <form action="{{ route('product-brand.destroy', $product_brand->id )}}" method="post" id="deleteForm{{ $product_brand->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-danger border-0 mx-2" type="button" onclick="return deleteAction('{{ $product_brand->id }}', 'Are you sure to delete this brand?', 'btn-danger')">
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
