@extends('backend.master')
@section('content')
    <div class="container-fluid px-0">
        <section class="section p-3">
            <div class="section-header d-flex p-3">
                <h3 class="mt-3">Profile</h3>
                <div class="section-header-breadcrumb d-flex p-3">
                    <div class="breadcrumb-item m-2 ">
                        <a href="{{route('dashboard')}}">Home</a>
                    </div>
                    <div class="m-2">/</div>
                    <div class="m-2">
                        <a href="{{route('setting')}}">Profile</a>
                    </div>
                </div>
            </div>
            <div class="section-body container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                                <div class="card-header p-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4>Profile Info.</h4>
                                        <div>
                                            <button type="button" class="btn text-light" style="background-color: #008080;" data-bs-toggle="modal" data-bs-target="#edit">
                                                Edit Profile
                                            </button>
                                            <button type="button" class="btn text-light" style="background-color: #008080;" data-bs-toggle="modal" data-bs-target="#change_pass">
                                                Change Password
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 text-center">
                                            @if(auth()->user()->image == null)
                                                <img src="{{asset('assets/backend/img/med.webp')}}" alt="image" class="rounded-circle mr-1" style="height: 200px; width: 220px;">
                                            @else
                                                <img src="{{asset('uploads/pharmacist/'.auth()->user()->image)}}" alt="image" class="rounded-circle mr-1" style="height: 200px; width: 220px;">
                                            @endif
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex flex-column ">
                                                <h4>Name : <span>{{auth()->user()->name}}</span></h4>
                                                <h4>Contact ID : <span>{{auth()->user()->contact_id}}</span></h4>
                                                <h4>Email : <span>{{auth()->user()->email}}</span></h4>
                                                <h4>Phone : <span>{{auth()->user()->phone}}</span></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- Modal edit profile -->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('update_profile')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="u_id" value="{{auth()->user()->id}}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-12 mb-4">
                                <label for="name" class="mb-2">
                                    Name
                                    <strong class="text-danger">*</strong>
                                </label>
                                <input type="text" class="form-control" name="name"
                                       placeholder="Name" id="name" value="{{old('name') ?? auth()->user()->name}}">
                                <span class="text-danger">@error('name') {{$message}} @enderror</span>
                            </div>

                            <div class="form-group col-lg-12 mb-4">
                                <label for="email" class="mb-2">
                                    Email
                                    <strong class="text-danger">*</strong>
                                </label>
                                <input type="email" class="form-control"
                                       name="email" placeholder="Email" id="email"
                                       value="{{old('email') ?? auth()->user()->email}}">
                                <span class="text-danger">@error('email') {{$message}} @enderror </span>
                            </div>
                            <div class="form-group col-lg-12 mb-4">
                                <label for="phone" class="mb-2">
                                    Phone
                                    <strong class="text-danger">*</strong>
                                </label>
                                <input type="tel" class="form-control" name="phone"
                                       placeholder="Phone" id="phone" value="{{old('phone') ?? auth()->user()->phone}}">
                                <span class="text-danger"> @error('phone') {{$message}} @enderror</span>
                            </div>
                            <div class="form-group col-lg-12 mb-4">
                                <label for="image" class="mb-2">
                                    Image
                                </label>
                                <input id="image" type="file" class="form-control"
                                       name="image">
                                <span class="text-danger"> @error('image') {{$message}} @enderror</span>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn text-light" style="background-color:#25aa9e;">Submit</button>
                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal change password -->
    <div class="modal fade" id="change_pass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('change_password')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{auth()->user()->id}}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-12 mb-4">
                                <label for="password" class="mb-2">
                                    Current Password
                                    <strong class="text-danger">*</strong>
                                </label>
                                <input type="password" class="form-control"
                                       name="current_password" placeholder="Password" id="current_password"
                                       value="{{old('current_password')}}">
                                <span class="text-danger">@error('current_password') {{$message}} @enderror </span>
                            </div>
                            <div class="form-group col-lg-12 mb-4">
                                <label for="password" class="mb-2">
                                    New Password
                                    <strong class="text-danger">*</strong>
                                </label>
                                <input type="password" class="form-control"
                                       name="new_password" placeholder="Password" id="new_password"
                                       value="{{old('new_password')}}">
                                <span class="text-danger">@error('new_password') {{$message}} @enderror </span>
                            </div>
                            <div class="form-group col-lg-12 mb-4">
                                <label for="password" class="mb-2">
                                    Confirm New Password
                                    <strong class="text-danger">*</strong>
                                </label>
                                <input type="password" class="form-control"
                                       name="new_password_confirmation" placeholder="Password" id="new_password_confirmation"
                                       value="{{old('new_password_confirmation')}}">
                                <span class="text-danger">@error('new_password_confirmation') {{$message}} @enderror </span>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn text-light" style="background-color:#25aa9e;">Submit</button>
                        <button type="button" data-bs-dismiss="modal" class="btn btn-danger">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('custom_script')
    <script>
        $(document).ready(function () {
            @if (Session::has('invalidUpdate') && count($errors) > 0)
            $('#edit').modal('show');
            @endif
        });
        $(document).ready(function () {
            @if (Session::has('invalidPassword') && count($errors) > 0)
            $('#change_pass').modal('show');
            @endif
        });
    </script>
@endpush

