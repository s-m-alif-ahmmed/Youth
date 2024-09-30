@extends('admin.master')

@section('title')
    User Detail
@endsection

@section('content')
    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('product-sub-category.index') }}">User</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User Detail Page</li>
                        </ol>
                    </nav>
                </div>
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
                        <div class="card-header fs-3 fw-bold">User Detail Page</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th> User Create Time </th>
                                    <td>{{$user->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia')}}</td>
                                </tr>
                                <tr>
                                    <th> User Name </th>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <th> User Image </th>
                                    <td>
                                        @if($user->image)
                                        <img class="img-fluid w-100" src="{{ asset( $user->email ) }}" alt="user" style="height: 100px; width: 100%;" />
                                        @else
                                            No image found.
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> User Email </th>
                                    <td>{{$user->email}}</td>
                                </tr>
                                <tr>
                                    <th> Phone Number </th>
                                    <td>{{$user->number}}</td>
                                </tr>
                                <tr>
                                    <th> Address </th>
                                    <td>{{$user->address}}</td>
                                </tr>
                                <tr>
                                    <th> Role </th>
                                    <td>
                                        @if($user->role == 'admin')
                                            <a href="{{ route('change-role', $user->id) }}" onclick="return StatusAction(event, 'Are you sure to change the role?', 'btn-success')" class="btn btn-success">Admin</a>
                                        @else($user->role == 'user')
                                            <a href="{{ route('change-role', $user->id) }}" onclick="return StatusAction(event, 'Are you sure to change the role?', 'btn-secondary')" class="btn btn-secondary">User</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th> Restriction Status</th>
                                    <td>
                                        @if($user->ban_status == 0)
                                            <a href="{{ route('change-ban-status', $user->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn btn-success">Active</a>
                                        @else($user->ban_status == 1)
                                            <a href="{{ route('change-ban-status', $user->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">InActive</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <td>
                                        <div class="d-flex">
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                                <form action="{{ route('delete-user', $user->id )}}" method="post" id="deleteForm{{ $user->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-danger border-0 mx-2" type="button" onclick="return deleteAction('{{ $user->id }}', 'Are you sure to delete this user?', 'btn-danger')">
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

