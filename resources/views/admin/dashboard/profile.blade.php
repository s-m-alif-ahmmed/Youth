@extends('admin.master')

@section('title')
    Profile
@endsection

@section('content')

    <section class="py-5">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- ROW-1 OPEN -->
            <div class="row" id="user-profile">
                <div class="col-lg-12">
                    <div class="tab-content">

                        <div class="card">
                            <div class="card-body border-0">
                                <div class="form-horizontal">
                                    <div class="row mb-4">

                                        <p class="mb-4 text-center text-17">Personal Info</p>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="photo" class="form-label">Profile Picture</label>
                                                    </div>
                                                    <div class="me-5 my-3 text-center">
                                                        <img src="{{asset($user->photo)}}" alt="Profile Photo" class="border-2 rounded-3" height="150" width="150" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="name" class="form-label">Full Name</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="name" id="name" value="{{Auth::user()->name}}" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="email" class="form-label">Email</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="email" class="form-control" id="email" name="email" value="{{Auth::user()->email}}" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="email" class="form-label">Phone Number</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control" id="number" name="number" value="{{Auth::user()->number}}" required />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row row-sm">
                                                    <div class="col-md-3">
                                                        <label for="email" class="form-label">Address</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <textarea type="text" class="form-control" id="address" name="address" required >{{Auth::user()->address}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- COL-END -->
            </div>
            <!-- ROW-1 CLOSED -->

        </div>
        <!-- End CONTAINER -->

    </section>


@endsection
