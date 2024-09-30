@extends('admin.master')

@section('title')
    Product Category Manage
@endsection

@section('content')

    <section class="py-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Categories</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="">
                <a class="btn btn-success rounded-3" href="{{ route('product-category.create') }}">Add Category</a>
            </div>

        </div>
        <!--end breadcrumb-->

        {{--        message--}}
        <p class="text-center text-muted">{{session('message')}}</p>

        <hr/>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-nowrap border-bottom w-100" id="file-datatable" style="width:100%">
                        <thead>
                        <tr>
                            <th> SL </th>
                            <th> Menu Name </th>
                            <th> Category Name </th>
                            <th> Category Filter Status </th>
                            <th> Category Status </th>
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product_categories as $category)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$category->menu->name}}</td>
                                <td>{{$category->name}}</td>
                                <td>
                                    @if($category->filter_status == 'active')
                                        <a href="{{ route('change.product-category.filter.status', $category->id) }}" onclick="return StatusAction(event, 'Are you sure to change the filter status?', 'btn-success')" class="btn btn-success">Active</a>
                                    @else($category->filter_status == 'inActive')
                                        <a href="{{ route('change.product-category.filter.status', $category->id) }}" onclick="return StatusAction(event, 'Are you sure to change the filter status?', 'btn-danger')" class="btn btn-danger">Deactive</a>
                                    @endif
                                </td>
                                <td>
                                    @if($category->status == 'active')
                                        <a href="{{ route('change.product-category.status', $category->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn btn-success">Active</a>
                                    @else($category->status == 'inActive')
                                        <a href="{{ route('change.product-category.status', $category->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">Deactive</a>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="View">
                                            <a href="{{route('product-category.show', $category->product_category_slug)}}" class="text-primary mx-1"><i class="fa fa-eye"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                            <a href="{{route('product-category.edit', $category->product_category_slug)}}" class="text-warning mx-1"><i class="fa fa-edit"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                            <form action="{{ route('product-category.destroy', $category->id )}}" method="post" id="deleteForm{{ $category->id }}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="text-danger border-0" type="button" onclick="return deleteAction('{{ $category->id }}', 'Are you sure to delete this category?', 'btn-danger')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </span>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>

@endsection
