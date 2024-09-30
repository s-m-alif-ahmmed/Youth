@extends('admin.master')

@section('title')
    Product Size Manage
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
                            <li class="breadcrumb-item active" aria-current="page">Manage Sizes</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="">
                <a class="btn btn-success rounded-3" href="{{ route('product-size.create') }}">Add Size</a>
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
                            <th> Product Type </th>
                            <th> Size </th>
                            <th> Status </th>
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product_sizes as $size)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$size->type_name}}</td>
                                <td>{{$size->name}}</td>
                                <td>
                                    @if($size->status == 'active')
                                        <a href="{{ route('change.product-size.status', $size->id) }}">
                                            <div class="main-toggle-group style1 d-flex flex-wrap mt-3">
                                                <div class="toggle toggle-warning toggle-sm on">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </a>
                                    @else($size->status == 'inActive')
                                        <a href="{{ route('change.product-size.status', $size->id) }}">
                                            <div class="main-toggle-group style1 d-flex flex-wrap mt-3">
                                                <div class="toggle toggle-warning toggle-sm off">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                            <a href="{{route('product-size.edit', Crypt::encryptString($size->id) )}}" class="text-warning mx-1"><i class="fa fa-edit"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                            <form action="{{ route('product-size.destroy', $size->id )}}" method="post" id="deleteForm{{ $size->id }}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="text-danger border-0" type="button" onclick="return deleteAction('{{ $size->id }}', 'Are you sure to delete this size?', 'btn-danger')">
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
