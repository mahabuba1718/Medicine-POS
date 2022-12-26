@extends('backend.master')
@push('custom_css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />
@endpush
@section('content')
<style>
.m-1 {
    margin: 0.1rem !important;
}

.p-1 {
    padding: 1rem !important;
}
#viewImg img{
    width: 300px;
    height: 300px;
    object-fit: cover;
    border-radius: 7px;

}

.table:not(.table-sm)> :not(caption)>*>* {
    padding: 0rem;
}
</style>
<div class="container-fluid px-0">

    <section class="section p-3">
        <div class="section-header d-flex p-3">
            <h3 class="mt-3">Medicine</h3>
            <div class="section-header-breadcrumb d-flex p-3">
                <div class="breadcrumb-item m-2 ">
                    <a href="{{route('dashboard')}}">Home</a>
                </div>
                <div class="m-2">/</div>
                <div class="m-2">
                    <a href="{{route('medicine')}}">Medicine</a>
                </div>
            </div>
        </div>
        <div class="section-body container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                        <div class="card-header d-flex p-3">
                            <h4>Medicine</h4>
                            <div class="card-header-form">
                                <button type="button" class="btn text-light" style="background-color: #008080;"
                                    data-bs-toggle="modal" data-bs-target="#myModal">
                                    <i class="fa fa-plus"></i>
                                    Add Medicine
                                </button>
                            </div>
                        </div>
                        <form action="{{route('admedicine')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal" id="myModal">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Add Medicine
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label for="name" class="mb-2">
                                                            Name
                                                            <strong class="text-danger">*</strong>
                                                        </label>
                                                        <input type="text" class="form-control" name="name"
                                                            placeholder="Name" id="name" value="{{old('name')}}">
                                                        <span class="text-danger">@error('name') {{$message}} @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label for="genericname" class="mb-2">
                                                            Genericname
                                                            <strong class="text-danger">*</strong>
                                                        </label>
                                                        <input type="text" class="form-control" name="genericname"
                                                            placeholder="Name" id="genericname" value="{{old('genericname')}}">
                                                        <span class="text-danger">@error('genericname') {{$message}}
                                                            @enderror </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4 ">
                                                        <label for="category" class="mb-2">
                                                            Cetagory
                                                            <strong class="text-danger">*</strong>
                                                        </label>
                                                        <select class="form-select" name="category_id"
                                                            id="category">

                                                            <option selected>Select One</option>
                                                            @foreach($categories as $key=>$category )
                                                            <option value="{{$category->id}}">{{$category->name}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger">@error('category_id') {{$message}}
                                                            @enderror </span>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4">
                                                        <label for="unit" class="mb-2">
                                                            Unit
                                                            <strong class="text-danger">*</strong>
                                                        </label>
                                                        <select class="form-select" name="unit_id" id="unit">
                                                            <option selected>Select One</option>
                                                            @foreach($units as $key=>$unit)
                                                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger"> @error('unit_id') {{$message}}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4 ">
                                                        <label for="type" class="mb-2">
                                                            Type
                                                            <strong class="text-danger">*</strong>
                                                        </label>
                                                        <select class="form-select" name="type_id" id="type">
                                                            <option selected>Select One</option>
                                                            @foreach($types as $key=>$type)
                                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="text-danger">@error('type_id') {{$message}}
                                                            @enderror </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4 ">
                                                        <label for="price" class="mb-2">
                                                            Price
                                                            <strong class="text-danger">*</strong>
                                                        </label>
                                                        <input type="number" class="form-control" name="price"
                                                            placeholder="Price" id="price" value="{{old('price')}}" min="1">
                                                        <span class="text-danger"> @error('price') {{$message}}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4 ">
                                                        <label for="purchaseprice" class="mb-2">
                                                            Purchase Price
                                                            <strong class="text-danger">*</strong>
                                                        </label>
                                                        <input type="number" class="form-control"
                                                            name="purchaseprice" placeholder="Purchase Price"
                                                            id="purchaseprice" value="{{old('purchaseprice')}}" min="1">
                                                        <span class="text-danger"> @error('purchaseprice') {{$message}}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group mb-4 ">
                                                        <label class="mb-2" for="image">
                                                            Image
                                                        </label>
                                                        <input type="file" class="form-control" name="image"
                                                            id="image">
                                                        <span class="text-danger"> @error('image') {{$message}}
                                                            @enderror</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-4 ">
                                                        <label for="description" class="mb-2">
                                                            Description
                                                            <strong class="text-danger"> </strong>
                                                        </label>
                                                        <textarea class="form-control" name="description"
                                                            id="description"
                                                            placeholder="Please add details of the Medicine"></textarea>
                                                        <span class="text-danger"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="submit" class="btn text-light"
                                                style="background-color:#25aa9e;">Submit</button>
                                            <button type="button" data-bs-dismiss="modal"
                                                class="btn btn-danger">Cancel</button>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-body">
                            <div class="">
                                <div class="table_section">
                                    <table id="medicine_tbl" class=" table table-striped text-center" style="vertical-align: middle;">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="" width="5%" style="padding: 0.7rem;">#</th>
                                                <th scope="col" class="" width="7%" style="padding: 0.7rem;">Image</th>
                                                <th scope="col" class="" width="9%" style="padding: 0.7rem;">Name</th>
                                                <th scope="col" class="" width="14%" style="padding: 0.7rem;">Generic
                                                    Name</th>
                                                <th scope="col" class="" width="9%" style="padding: 0.7rem;">Category
                                                </th>
                                                <th scope="col" class="" width="10%" style="padding: 0.7rem;">Unit</th>
                                                <th scope="col" class="" width="10%" style="padding: 0.7rem;">Type</th>
                                                <th scope="col" class="" width="9%" style="padding: 0.7rem;">Price
                                                </th>
                                                <th scope="col" class="" width="9%" style="padding: 0.7rem;">Purchase
                                                    Price</th>
                                                @if(Auth::user()->role_id == 1)
                                                <th scope="col" class="" width="7%" style="padding: 0.7rem;">Status</th>
                                                <th scope="col" class="" width="13%" style="padding: 0.7rem;">Action
                                                </th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($admedicine as $key=> $medicine)
                                            <tr class="text-center">
                                                <td scope="col" class="">{{$key+1}}</td>
                                                <td>
                                                    @if($medicine->image != null)
                                                    <img class="" src="{{asset('/uploads/medicine/'.$medicine->image)}}"
                                                        alt="image">
                                                    @else
                                                    <img src="{{asset('assets/backend/img/no.jpg')}}" alt="image">
                                                    @endif
                                                </td>
                                                <td scope="col" class="">{{$medicine->name}}</td>
                                                <td scope="col" class="">{{$medicine->genericname}} </td>
                                                <td scope="col" class="">{{$medicine->category->name}}</td>
                                                <td scope="col" class="">{{$medicine->unit->name}}</td>
                                                <td scope="col" class="">{{$medicine->type->name}}</td>
                                                <td scope="col" class="">৳ {{$medicine->price}}</td>
                                                <td scope="col" class="">৳ {{$medicine->purchaseprice}}</td>
                                                @if(Auth::user()->role_id == 1)
                                                <td scope="col" class=" ">
                                                    <div class=" form-switch">
                                                        <input class="form-check-input " type="checkbox" role="switch"
                                                        id="flexSwitchCheckDefault" value="{{$medicine->id}}"
                                                        {{$medicine->status == 1 ? 'checked':''}}>
                                                    </div>
                                                </td>
                                                <td scope="col" class="p-1" style="display: flex; flex-wrap: nowrap;">
                                                    <button type="button" class="m-1 btn viewBtn float-right text-light"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="View"
                                                        style="font-size: 0.7rem; background-color: #7fa390"
                                                        value="{{$medicine->id}}">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                    <div class="modal" id="myModal1">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">
                                                                        Medicine Description
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="" id="viewImg">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 text-start">
                                                                            <div class="p-2" id="viewDes">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-center">

                                                                    <button type="button" data-bs-dismiss="modal"
                                                                        class="btn btn-danger">
                                                                        Cancel
                                                                    </button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="{{route('editmedicine',$medicine->id)}}"
                                                        class="m-1 btn float-right text-light"
                                                        style="font-size: 0.7rem; background-color: #008080;"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Edit">
                                                        <i class="fa-solid fa-pencil"></i>
                                                    </a>
                                                    <button type="button"
                                                        class="m-1 btn btn-danger deleteRow float-right"
                                                        style="font-size: 0.7rem;" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title="Delete" value="{{$medicine->id}}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>

                                                </td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- medicine delete model start -->
<div class="modal fade" id="myModalp">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <form action="{{route('deletemedicine')}}" method="POST">
            @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        Are You Sure?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="DelMedId" name="DeletingId" value="">
                    You Want to Delete This Record?
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn text-light"
                        style="background-color:#25aa9e;"
                        type="submit">
                        Yes,Delete
                    </button>

                    <button type="button" data-bs-dismiss="modal"
                        class="btn btn-danger">
                        Cancel
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- medicine delete model end -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>
@endsection

@push('custom_script')
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {

        @if (Session::has('invalidMedAdd') && count($errors) > 0)
        $('#myModal').modal('show');
        @endif

        $('#medicine_tbl').DataTable();

        // view medicine description 
        $(document).on('click', '.viewBtn', function() {
            var update_id = $(this).val();
            $("#myModal1").modal('show');

            $.ajax({
                type: "GET",
                url: "/viewmed/" + update_id,
                success: function(response) {
                    $("#viewImg").html('');
                    $("#viewImg").append('\
                        <img src="/uploads/medicine/' + response.med.image + '" alt="Medicine Image">\
                    ');

                    $("#viewDes").html('');
                    $("#viewDes").append('\
                        <p class="mb-0"><span class="fw-semibold">Name: </span>' + response.med.name + '</p>\
                        <p class="mb-0"><span class="fw-semibold">Genericname: </span>' + response.med.genericname + '</p>\
                        <p class="mb-0"><span class="fw-semibold">Cetagory: </span>' + response.c.name + '</p>\
                        <p class="mb-0"><span class="fw-semibold">Unit: </span>' + response.u.name + '</p>\
                        <p class="mb-0"><span class="fw-semibold">Type: </span>' + response.t.name + '</p>\
                        <p class="mb-0"><span class="fw-semibold">Price: </span>' + response.med.price + '</p>\
                        <p class="mb-0"><span class="fw-semibold">Description: </span>' + response.med.description + '</p>\
                    ');

                }
            });
        });
        // delete medicine
        $(document).on('click', '.deleteRow', function() {
            var del_id = $(this).val();
            $("#myModalp").modal('show');
            $('#DelMedId').val(del_id);
        });
        // medicine status
        $(document).on('click', '#flexSwitchCheckDefault', function() {
            var update_id = $(this).val();

            $.ajax({
                type: "GET",
                url: "/med_status/" + update_id,
            });
        });
    });
</script>
@endpush
