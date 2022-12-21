@extends('backend.master')
@section('content')
<div class="container-fluid px-0">

    <section class="section p-3">
        <div class="section-header d-flex p-3">
            <h3 class="mt-3">Edit Customer</h3>
            <div class="section-header-breadcrumb d-flex p-3">
                <div class="breadcrumb-item m-2 ">
                    <a href="{{route('dashboard')}}">Home</a>
                </div>
                <div class="m-2">/</div>
                <div class="m-2">
                    <a href="{{route('contact_customer')}}">Customer</a>
                </div>
                <div class="m-2">/</div>
                <div class="m-2">
                    <a href="">Edit Customer</a>
                </div>
            </div>
        </div>
        <div class="section-body container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                        <form method="POST" action="{{route('updatecus')}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$cus->id}}">
                            <div class="card-header p-3">
                                <h5>Edit customer</h5>
                            </div>
                            <div class="card-body">
                                <div class="row p-2">
                                    <div class="form-group col-lg-4 mb-4">
                                        <label for="name" class="mb-2">
                                            Name
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <input type="text" class="form-control" name="name" placeholder="Name" id="name" value="{{old('name')??$cus->customer_name}}">
                                        <span class="text-danger"> @error('name') {{$message}} @enderror</span>
                                    </div>

                                    <div class="form-group col-lg-4 mb-4">
                                        <label for="customer_id" class="mb-2">
                                            customer ID
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <input type="text" class="form-control" name="customer_id" for="customer_id"
                                        placeholder="Contact ID" id="customer_id" value="{{old('customer_id')??$cus->customer_id}}">
                                        <span class="text-danger"> @error('customer_id') {{$message}} @enderror</span>
                                    </div>

                                    <div class="form-group col-lg-4 mb-4">
                                        <label for="email" class="mb-2">
                                            Email
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <input type="email" class="form-control" name="email" placeholder="Email"
                                            for="email" id="email" value="{{old('email')??$cus->email}}">
                                        <span class="text-danger"> @error('email') {{$message}} @enderror</span>
                                    </div>

                                    <div class="form-group col-lg-4 mb-4">
                                        <label for="phone" class="mb-2">
                                            Phone
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <input type="tel" class="form-control" name="phone" placeholder="Phone"
                                            for="phone" id="phone" value="{{old('phone')??$cus->phone}}">
                                        <span class="text-danger"> @error('phone') {{$message}} @enderror</span>
                                    </div>
                                    <div class="form-group col-lg-4 mb-4">
                                        <label for="image" class="mb-2">
                                            Image
                                        </label>
                                        <input type="file" class="form-control" id="image" name="image">
                                        <span class="text-danger"> @error('image') {{$message}} @enderror</span>
                                    </div>
                                    <div class="form-group col-lg-4 mb-4">
                                        @if($cus->image !=null)
                                            <img src="{{'/uploads/customer/'.$cus->image}}" alt="image" width="200" height="200">
                                        @else
                                            <img src="{{asset('assets/backend/img/nouser.webp')}}" alt="image" width="200" height="200">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button class="btn text-light" type="submit" style="background-color:#25aa9e;">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>

@endsection
