@extends('admin.master')

@section('title')
    Social Media Detail
@endsection

@section('content')
    <section class="my-5">
        <!--breadcrumb-->
        <div class="d-flex justify-content-between">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{ route('social-media.index') }}">Social Media</a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Social Media Detail Page</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="">
                <a class="btn btn-success rounded-3" href="{{ route('social-media.create') }}">Add Social Media</a>
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
                        <div class="card-header fs-3 fw-bold">Social Media Detail Page</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th> Social Media Create Time </th>
                                    <td>{{$social_media->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia')}}</td>
                                </tr>
                                <tr>
                                    <th> Social Media Color </th>
                                    <td>
                                        <input type="color" value="{{$social_media->color}}" style="height: 50px; width: 100px;" disabled />
                                    </td>
                                </tr>
                                <tr>
                                    <th> Social Media Background Color </th>
                                    <td>
                                        <input type="color" value="{{$social_media->back_color}}" style="height: 50px; width: 100px;" disabled />
                                    </td>
                                </tr>
                                <tr>
                                    <th> Social Media Name </th>
                                    <td>{{$social_media->name}}</td>
                                </tr>
                                <tr>
                                    <th> Social Media Icon </th>
                                    <td>
                                        {{ $social_media->icon }}
                                    </td>
                                </tr>
                                <tr>
                                    <th> Social Media Link </th>
                                    <td>{{$social_media->link}}</td>
                                </tr>
                                <tr>
                                    <th> Brand Status</th>
                                    <td>
                                        @if($social_media->status == 'active')
                                            <a href="{{ route('change.status.social.media', $social_media->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')"  class="btn btn-success">Active</a>
                                        @else($social_media->status == 'inActive')
                                            <a href="{{ route('change.status.social.media', $social_media->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">Deactive</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <td>
                                        <div class="d-flex">
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                                <a href="{{route('social-media.edit', Crypt::encryptString($social_media->id) )}}" class="text-warning mx-2"><i class="fa fa-edit"></i></a>
                                            </span>
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                                <form action="{{ route('social-media.destroy', $social_media->id )}}" method="post" id="deleteForm{{ $social_media->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-danger border-0 mx-2" type="button" onclick="return deleteAction('{{ $social_media->id }}', 'Are you sure to delete this social media?', 'btn-danger')">
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
