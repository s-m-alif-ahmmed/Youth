@extends('admin.master')

@section('title')
    Offer Image
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
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Offer Image</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="">
                <a class="btn btn-success rounded-3" href="{{ route('offer.create') }}">Add Offer Image</a>
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
                            <th> Offer Create </th>
                            <th> Image </th>
                            <th> Offer Name </th>
                            <th> First Slider Status </th>
                            <th> Status </th>
                            <th> Actions </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($offers as $offer)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($offer->created_at)->setTimezone('Asia/Dhaka')->format('M d, Y, h:i:s') }}
                                </td>
                                <td>
                                    <img class="img-fluid w-100" src="{{ asset($offer->image) }}" alt="{{ $offer->alt }}" style="height: 60px;">
                                </td>
                                <td>{{$offer->name}}</td>
                                <td>
                                    @if($offer->status == 'active')
                                        <a href="{{ route('change.status.offer', $offer->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn btn-success">Active</a>
                                    @else($offer->status == 'inActive')
                                        <a href="{{ route('change.status.offer', $offer->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">InActive</a>
                                    @endif
                                </td>
                                <td>
                                    @if($offer->first_status == 'active')
                                        <a href="{{ route('change.status.offer.active', $offer->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-success')" class="btn btn-success">On</a>
                                    @else($offer->first_status == 'off')
                                        <a href="{{ route('change.status.offer.active', $offer->id) }}" onclick="return StatusAction(event, 'Are you sure to change the status?', 'btn-danger')" class="btn btn-danger">Off</a>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Edit">
                                            <a href="{{route('offer.edit', Crypt::encryptString($offer->id))}}" class="text-warning mx-1"><i class="fa fa-edit"></i></a>
                                        </span>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="hover focus" data-bs-content="Delete">
                                            <form action="{{ route('offer.destroy', $offer->id )}}" method="post" id="deleteForm{{ $offer->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-danger border-0" type="button" onclick="return deleteAction('{{ $offer->id }}', 'Are you sure to delete this coupon?', 'btn-danger')">
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
