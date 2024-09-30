@extends('admin.master')

@section('title')
    Privacy Policy Edit
@endsection

@section('content')
    <section class="py-5">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">
                <a href="{{ route('privacy-policy.index') }}">Privacy Policy</a>
            </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Privacy Policy</li>
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
                        <h5 class="mb-0">Edit Privacy Policy</h5>
                    </div>
                    <div class="card-body">
                        <div class="border p-3 ">
                            <form class="row g-3" method="post" action="{{route('privacy-policy.update', Crypt::encryptString($privacy_policy->id) )}}" >
                                @csrf
                                @method('patch')

                                <div class="col-12">
                                    <label for="privacy_policy" class="form-label"> Terms & Conditions </label>
                                    <textarea class="form-control" name="privacy_policy" id="editor" cols="30" rows="10" placeholder="Enter privacy policy" required>{{$privacy_policy->privacy_policy}}</textarea>
                                </div>

                                <div class="col-12 text-center">
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
