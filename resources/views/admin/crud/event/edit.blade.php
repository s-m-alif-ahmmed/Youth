@extends('admin.master')

@section('title')
    Edit Event
@endsection

@section('content')

    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('event.index') }}">Event</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Event</li>
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
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-header py-3 bg-transparent">
                        <h5 class="mb-0">Edit Event</h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class=" g-3" method="post" action="{{route('event.update', Crypt::encryptString($event->id) )}}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')

                                <div class="col-12 mb-2">
                                    <label for="name" class="form-label"> Event Name </label>
                                    <input class="form-control" type="text" name="name" id="name" value="{{ $event->name }}" placeholder="Enter event name" required />
                                </div>

                                <div class="col-12 mb-2">
                                    <label for="image" class="form-label"> Event Image (1600*200px) </label>
                                    <input class="form-control" type="file" name="image" id="image" value="{{ $event->image }}" placeholder="Enter event image" />
                                    <img class="img-fluid w-100 m-2" src="{{ asset($event->image) }}" alt="{{ $event->image }}" style="height: 60px;">
                                </div>

                                <div class="col-12 mb-2">
                                    <label for="alt" class="form-label"> Event Image Alt </label>
                                    <input class="form-control" type="text" name="alt" id="alt" value="{{ $event->alt }}" placeholder="Enter event image alt" required />
                                </div>

                                <div class="col-12 mb-2 text-center">
                                    <button class="btn btn-primary px-4" type="submit">Update</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
