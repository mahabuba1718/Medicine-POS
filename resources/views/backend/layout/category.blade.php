@extends('backend.master')
@section('content')

    <div class="container-fluid px-0">

        <section class="container-fluid my-3">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{url('/category')}}" class="nav-link {{request()->is('category') ? 'active' : '' }} "
                       id="category-tab" type="button" role="tab" aria-controls="category-tab-pane"
                       aria-selected="true">
                        <i class="fa-solid fa-square-poll-horizontal"></i>
                        Category
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="{{url('/unit')}}" class="nav-link {{request()->is('unit') ? 'active' : '' }} "
                       id="unit-tab"
                       type="button" role="tab" aria-controls="unit-tab-pane" aria-selected="false">
                        <i class="fa-solid fa-pen-fancy"></i>
                        Unit
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a href="{{url('/type')}}" class="nav-link {{request()->is('type') ? 'active' : '' }} "
                       id="type-tab"
                       type="button" role="tab" aria-controls="type-tab-pane" aria-selected="false">
                        <i class="fa-solid fa-cube"></i>
                        Type
                    </a>
                </li>
            </ul>
            <div class="container-fluid tab-content" id="myTabContent">
                <div class="tab-pane fade show {{request()->is('category') ? 'active' : '' }}" id="{{url('/category')}}"
                     role="tabpanel" aria-labelledby="category-tab" tabindex="0">
                    <section class="section p-2">
                        <div class="section-header d-flex p-3">
                            <h3 class="mt-3">Category</h3>
                            <div class="section-header-breadcrumb d-flex p-3">
                                <div class="breadcrumb-item m-2 ">
                                    <a href="{{route('dashboard')}}">Home</a>
                                </div>
                                <div class="m-2">/</div>
                                <div class="m-2">
                                    <a href="{{route('category')}}">Category</a>
                                </div>
                            </div>
                        </div>
                        <div class="section-body container-fluid">
                            <div class="row ">
                                <div class=" col-lg-4 ">
                                    <form method="POST" action="{{route('categories')}}" class="">
                                        @csrf
                                        <div class="card" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                                            <div class="card-header p-2">
                                                <h4>Add Category</h4>
                                                <div class="form-group col-lg-12 p-2 mb-4">
                                                    <label for="category" class="mb-2">
                                                        Category
                                                        <strong class="text-danger">*</strong>
                                                    </label>
                                                    <input for="category" type="text" class="form-control" name="name"
                                                           placeholder="Category" id="category" value="">
                                                    <span
                                                        class="text-danger">@error('name') {{$message}} @enderror</span>
                                                </div>
                                                <div class="form-group col-lg-12 p-2 mb-4">
                                                    <label for="description" class="mb-2">
                                                        Description
                                                        <strong class="text-danger"> </strong>
                                                    </label>
                                                    <textarea for="description" class="form-control" name="description"
                                                              id="description"
                                                              placeholder="Please add Category details"></textarea>
                                                    <span class="text-danger"> </span>
                                                </div>
                                            </div>
                                            <div class="card-footer text-center">
                                                <button class="btn text-light" style="background-color:#25aa9e;"
                                                        type="submit">
                                                    Save Changes
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="  col-lg-8 ">
                                    <div class="card" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                                        <div class="card-header">
                                            <h4>Category List</h4>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped text-center  table-bordered table_reduced"
                                                   style="vertical-align: middle;">
                                                <thead>
                                                <tr>
                                                    <th scope="col" class="" width="10">No.</th>
                                                    <th scope="col" class="" width="25">Name</th>
                                                    <th scope="col" class="" width="30">Description</th>
                                                    @if(Auth::user()->role_id == 1)
                                                    <th scope="col" class="" width="15">Status</th>
                                                    <th scope="col" class="" width="20">Action</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($categories as $key=>$category )
                                                    <tr class="text-center">
                                                        <td scope="col" class="">{{$key+1}}</td>
                                                        <td scope="col" class="">{{$category->name}}</td>
                                                        <td scope="col" class="">{{$category->description}}</td>
                                                        @if(Auth::user()->role_id == 1)
                                                        <td scope="col" class=" ">
                                                            <div class=" form-switch">
                                                                <input class="form-check-input " type="checkbox"
                                                                       role="switch"
                                                                       id="flexSwitchCheckDefault_c"
                                                                       value="{{$category->id}}"
                                                                    {{$category->status == 1 ? 'checked':''}}>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button"
                                                                        class="btn text-light dropdown-toggle "
                                                                        style="background-color: #008080;"
                                                                        data-bs-toggle="dropdown">
                                                                    Action
                                                                </button>
                                                                <ul class="dropdown-menu option">
                                                                    <li>
                                                                        <button class="dropdown-item category_edit"
                                                                                value="{{$category->id}}">
                                                                            <i style="font-size: 10px;"
                                                                               class="fas fa-pencil-alt my-2"> Edit</i>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button class="dropdown-item category_delete"
                                                                                value="{{$category->id}}">
                                                                            <i style="font-size: 10px;"
                                                                               class="fas fa-trash my-2"> Delete</i>
                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            <div class="modal" id="myModal1">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">
                                                                                Category
                                                                            </h5>
                                                                            <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"></button>
                                                                        </div>
                                                                        <form method="POST"
                                                                              action="{{route('updatecat')}}">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <input type="hidden" name="cat_id" value=""
                                                                                   id="cat_id">
                                                                            <div class="modal-body">
                                                                                <div class="card"
                                                                                     style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                                                                                    <div
                                                                                        class="card-header text-start p-2">
                                                                                        <h4>Edit Category</h4>
                                                                                        <div
                                                                                            class="form-group col-lg-12 p-2 mb-4">
                                                                                            <label for="u_category "
                                                                                                   class="mb-2">
                                                                                                Category
                                                                                                <strong
                                                                                                    class="text-danger">*</strong>
                                                                                            </label>
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   name="name"
                                                                                                   placeholder="Category"
                                                                                                   id="u_category"
                                                                                                   value="">
                                                                                            <span
                                                                                                class="text-danger"> </span>
                                                                                        </div>
                                                                                        <div
                                                                                            class="form-group col-lg-12 p-2 mb-4">
                                                                                            <label for="u_description"
                                                                                                   class="mb-2">
                                                                                                Description
                                                                                                <strong
                                                                                                    class="text-danger">
                                                                                                </strong>
                                                                                            </label>
                                                                                            <textarea
                                                                                                class="form-control"
                                                                                                name="description"
                                                                                                id="u_description"
                                                                                                placeholder="Please add Category details"></textarea>
                                                                                            <span
                                                                                                class="text-danger"> </span>
                                                                                        </div>

                                                                                    </div>

                                                                                    <div
                                                                                        class="card-footer text-center">
                                                                                        <button class="btn text-light"
                                                                                                style="background-color:#25aa9e;"
                                                                                                type="submit">
                                                                                            Save Changes
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                        <div
                                                                            class="modal-footer justify-content-center">

                                                                            <button type="button"
                                                                                    data-bs-dismiss="modal"
                                                                                    class="btn btn-danger">Cancel
                                                                            </button>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-footer">
                                            {{  $categories->links() }}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="tab-pane fade show {{request()->is('unit') ? 'active' : '' }} " id="{{url('/unit')}}"
                     role="tabpanel" aria-labelledby="unit-tab" tabindex="0">
                    <section class="section p-2">
                        <div class="section-header d-flex p-3">
                            <h3 class="mt-3">Unit</h3>
                            <div class="section-header-breadcrumb d-flex p-3">
                                <div class="breadcrumb-item m-2 ">
                                    <a href="{{route('dashboard')}}">Home</a>
                                </div>
                                <div class="m-2">/</div>
                                <div class="m-2">
                                    <a href="{{route('unit')}}">Unit</a>
                                </div>
                            </div>
                        </div>
                        <div class="section-body container-fluid">
                            <div class="row ">
                                <div class=" col-lg-4">
                                    <form method="POST" action="{{route('units')}}" class="">
                                        @csrf
                                        <div class="card" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                                            <div class="card-header p-2">
                                                <h4>Add Unit</h4>
                                                <div class="form-group col-lg-12 p-2 mb-4">
                                                    <label for="unit" class="mb-2">
                                                        Unit
                                                        <strong class="text-danger">*</strong>
                                                    </label>
                                                    <input type="text" class="form-control" name="name"
                                                           placeholder="Unit" id="unit" value="">
                                                    <span
                                                        class="text-danger">@error('name') {{$message}} @enderror </span>
                                                </div>
                                                <div class="form-group col-lg-12 p-2 mb-4">
                                                    <label for="description" class="mb-2">
                                                        Description
                                                        <strong class="text-danger"> </strong>
                                                    </label>
                                                    <textarea class="form-control" name="description" id="description"
                                                              placeholder="Please add unit details"></textarea>
                                                    <span class="text-danger"> </span>
                                                </div>

                                            </div>

                                            <div class="card-footer text-center">
                                                <button class="btn text-light" style="background-color:#25aa9e;"
                                                        type="submit">
                                                    Save Changes
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="  col-lg-8">
                                    <div class="card" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                                        <div class="card-header">
                                            <h4>Unit List</h4>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped text-center  table-bordered table_reduced"
                                                   style="vertical-align: middle;">
                                                <thead>
                                                <tr>
                                                    <th scope="col" class="" width="10">No.</th>
                                                    <th scope="col" class="" width="25">Name</th>
                                                    <th scope="col" class="" width="30">Description</th>
                                                    @if(Auth::user()->role_id == 1)
                                                    <th scope="col" class="" width="15">Status</th>
                                                    <th scope="col" class="" width="20">Action</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($units as $key=>$unit)
                                                    <tr class="text-center">
                                                        <td scope="col" class="">{{$key+1}}</td>
                                                        <td scope="col" class="">{{$unit->name}}</td>
                                                        <td scope="col" class="">{{$unit->description}}</td>
                                                        @if(Auth::user()->role_id == 1)
                                                        <td scope="col" class=" ">
                                                            <div class=" form-switch">
                                                                <input class="form-check-input " type="checkbox"
                                                                       role="switch"
                                                                       id="flexSwitchCheckDefault" value="{{$unit->id}}"
                                                                    {{$unit->status == 1 ? 'checked':''}}>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button"
                                                                        class="btn text-light dropdown-toggle "
                                                                        style="background-color: #008080;"
                                                                        data-bs-toggle="dropdown">
                                                                    Action
                                                                </button>
                                                                <ul class="dropdown-menu option">
                                                                    <li>
                                                                        <button class="dropdown-item unit_edit"
                                                                                value="{{$unit->id}}">
                                                                            <i style="font-size: 10px;"
                                                                               class="fas fa-pencil-alt my-2"> Edit</i>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button class="dropdown-item unit_delete"
                                                                                value="{{$unit->id}}">
                                                                            <i style="font-size: 10px;"
                                                                               class="fas fa-trash my-2"> Delete</i>
                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="modal" id="myModal2">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">
                                                                                Unit
                                                                            </h5>
                                                                            <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"></button>
                                                                        </div>
                                                                        <form method="POST"
                                                                              action="{{route('updateunit')}}">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <input type="hidden" name="unit_id" value=""
                                                                                   id="unit_id">
                                                                            <div class="modal-body">
                                                                                <div class="card"
                                                                                     style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                                                                                    <div
                                                                                        class="card-header text-start p-2">
                                                                                        <h4>Edit Unit</h4>
                                                                                        <div
                                                                                            class="form-group col-lg-12 p-2 mb-4">
                                                                                            <label for="u_unit"
                                                                                                   class="mb-2">
                                                                                                Unit
                                                                                                <strong
                                                                                                    class="text-danger">*</strong>
                                                                                            </label>
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   name="name"
                                                                                                   placeholder="Unit"
                                                                                                   id="u_unit" value="">
                                                                                            <span
                                                                                                class="text-danger"> </span>
                                                                                        </div>
                                                                                        <div
                                                                                            class="form-group col-lg-12 p-2 mb-4">
                                                                                            <label for="u_udescription"
                                                                                                   class="mb-2">
                                                                                                Description
                                                                                                <strong
                                                                                                    class="text-danger">
                                                                                                </strong>
                                                                                            </label>
                                                                                            <textarea
                                                                                                class="form-control"
                                                                                                name="description"
                                                                                                id="u_udescription"
                                                                                                placeholder="Please add unit details"></textarea>
                                                                                            <span
                                                                                                class="text-danger"> </span>
                                                                                        </div>

                                                                                    </div>

                                                                                    <div
                                                                                        class="card-footer text-center mb-3">
                                                                                        <button class="btn text-light"
                                                                                                style="background-color:#25aa9e;"
                                                                                                type="submit">
                                                                                            Save Changes
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                        <div
                                                                            class="modal-footer justify-content-center">

                                                                            <button type="button"
                                                                                    data-bs-dismiss="modal"
                                                                                    class="btn btn-danger">Cancel
                                                                            </button>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @endif

                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-footer">
                                            {{ $units->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="tab-pane fade show {{request()->is('type') ? 'active' : '' }} " id="{{url('/type')}}"
                     role="tabpanel" aria-labelledby="type-tab" tabindex="0">
                    <section class="section p-2">
                        <div class="section-header d-flex p-3">
                            <h3 class="mt-3">Type</h3>
                            <div class="section-header-breadcrumb d-flex p-3">
                                <div class="breadcrumb-item m-2 ">
                                    <a href="{{route('dashboard')}}">Home</a>
                                </div>
                                <div class="m-2">/</div>
                                <div class="m-2">
                                    <a href="{{route('type')}}">Type</a>
                                </div>
                            </div>
                        </div>
                        <div class="section-body container-fluid">
                            <div class="row ">
                                <div class=" col-lg-4">
                                    <form method="POST" action="{{route('types')}}" class="">
                                        @csrf
                                        <div class="card" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                                            <div class="card-header p-2">
                                                <h4>Add Type</h4>
                                                <div class="form-group col-lg-12 p-2 mb-4">
                                                    <label for="name" class="mb-2">
                                                        Type
                                                        <strong class="text-danger">*</strong>
                                                    </label>
                                                    <input type="text" class="form-control" name="type"
                                                           placeholder="Type" id="type" value="">
                                                    <span
                                                        class="text-danger">@error('type') {{$message}} @enderror</span>
                                                </div>
                                                <div class="form-group col-lg-12 p-2 mb-4">
                                                    <label for="description" class="mb-2">
                                                        Description
                                                        <strong class="text-danger"> </strong>
                                                    </label>
                                                    <textarea class="form-control" name="description" id="description"
                                                              placeholder="Please add type details"></textarea>
                                                    <span class="text-danger"> </span>
                                                </div>

                                            </div>

                                            <div class="card-footer text-center">
                                                <button class="btn text-light" style="background-color:#25aa9e;"
                                                        type="submit">
                                                    Save Changes
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-lg-8">
                                    <div class="card" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                                        <div class="card-header">
                                            <h4>Type List</h4>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-striped text-center  table-bordered table_reduced"
                                                   style="vertical-align: middle;">
                                                <thead>
                                                <tr>
                                                    <th scope="col" class="" width="10">#</th>
                                                    <th scope="col" class="" width="25">Name</th>
                                                    <th scope="col" class="" width="30">Description</th>
                                                    @if(Auth::user()->role_id == 1)
                                                    <th scope="col" class="" width="15">Status</th>
                                                    <th scope="col" class="" width="20">Action</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($types as $key=>$type)
                                                    <tr class="text-center">
                                                        <td scope="col" class="">{{$key+1}}</td>
                                                        <td scope="col" class="">{{$type->name}}</td>
                                                        <td scope="col" class="">{{$type->description}}</td>
                                                        @if(Auth::user()->role_id == 1)
                                                        <td scope="col" class=" ">
                                                            <div class=" form-switch">
                                                                <input class="form-check-input " type="checkbox"
                                                                       role="switch"
                                                                       id="flexSwitchCheckDefault_t"
                                                                       value="{{$type->id}}"
                                                                    {{$type->status == 1 ? 'checked':''}}>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button"
                                                                        class="btn text-light dropdown-toggle "
                                                                        style="background-color: #008080;"
                                                                        data-bs-toggle="dropdown">
                                                                    Action
                                                                </button>
                                                                <ul class="dropdown-menu option">
                                                                    <li>
                                                                        <button class="dropdown-item type_edit"
                                                                                value="{{$type->id}}">
                                                                            <i style="font-size: 10px;"
                                                                               class="fas fa-pencil-alt my-2"> Edit</i>
                                                                        </button>
                                                                    </li>
                                                                    <li>
                                                                        <button class="dropdown-item type_delete"
                                                                                value="{{$type->id}}">
                                                                            <i style="font-size: 10px;"
                                                                               class="fas fa-trash my-2"> Delete</i>
                                                                        </button>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="modal" id="myModal3">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">
                                                                                Type
                                                                            </h5>
                                                                            <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"></button>
                                                                        </div>
                                                                        <form method="POST"
                                                                              action="{{route('updatetype')}}">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <input type="hidden" name="type_id" value=""
                                                                                   id="type_id">
                                                                            <div class="modal-body">
                                                                                <div class="card"
                                                                                     style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                                                                                    <div
                                                                                        class="card-header text-start p-2">
                                                                                        <h4>Edit Type</h4>
                                                                                        <div class="form-group col-lg-12 p-2 mb-4">
                                                                                            <label for="u_type"
                                                                                                   class="mb-2">
                                                                                                Type
                                                                                                <strong
                                                                                                    class="text-danger">*</strong>
                                                                                            </label>
                                                                                            <input type="text"
                                                                                                   class="form-control"
                                                                                                   name="name"
                                                                                                   placeholder="Type"
                                                                                                   id="u_type" value="">
                                                                                            <span
                                                                                                class="text-danger"> </span>
                                                                                        </div>
                                                                                        <div
                                                                                            class="form-group col-lg-12 p-2 mb-4">
                                                                                            <label for="u_tdescription"
                                                                                                   class="mb-2">
                                                                                                Description
                                                                                                <strong
                                                                                                    class="text-danger">
                                                                                                </strong>
                                                                                            </label>
                                                                                            <textarea
                                                                                                class="form-control"
                                                                                                name="description"
                                                                                                id="u_tdescription"
                                                                                                placeholder="Please add type details"></textarea>
                                                                                            <span
                                                                                                class="text-danger"> </span>
                                                                                        </div>

                                                                                    </div>

                                                                                    <div
                                                                                        class="card-footer text-center mb-3">
                                                                                        <button class="btn text-light"
                                                                                                style="background-color:#25aa9e;"
                                                                                                type="submit">
                                                                                            Save Changes
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                        <div
                                                                            class="modal-footer justify-content-center">

                                                                            <button type="button"
                                                                                    data-bs-dismiss="modal"
                                                                                    class="btn btn-danger">Cancel
                                                                            </button>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-footer">
                                            {{ $types->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
    <!-- Category Delete Modal -->
    <div class="modal" id="CategoryDelete">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <form action="{{route('deletecat')}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Are You Sure?
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="DelCatId" name="DelCatId" value="">
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
    <!-- Unit Delete Modal -->
    <div class="modal" id="UnitDelete">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <form action="{{route('deleteunit')}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Are You Sure?
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="DelUnitId" name="DelUnitId" value="">
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
    <!-- Type Delete Modal -->
    <div class="modal" id="TypeDelete">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <form action="{{route('deletetype')}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Are You Sure?
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="DelTypeId" name="DelTypeId" value="">
                        You Want to Delete This Record?
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button class="btn text-light"
                                style="background-color:#25aa9e;"
                                type="submit">
                            Save Changes
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>

@endsection

@push('custom_script')
    <script>
        $(document).ready(function () {
            // category edit
            $(document).on('click', '.category_edit', function () {
                var update_id = $(this).val();
                $("#myModal1").modal('show');

                $.ajax({
                    type: "GET",
                    url: "/editcat/" + update_id,
                    success: function (response) {
                        console.log(response.cat);
                        $("#cat_id").val(update_id);
                        $("#u_category").val(response.cat.name);
                        $("#u_description").val(response.cat.description);
                    }
                });
            });
            // unit edit
            $(document).on('click', '.unit_edit', function () {
                var update_id = $(this).val();
                $("#myModal2").modal('show');

                $.ajax({
                    type: "GET",
                    url: "/editunit/" + update_id,
                    success: function (response) {
                        console.log(response.unit);
                        $("#unit_id").val(update_id);
                        $("#u_unit").val(response.unit.name);
                        $("#u_udescription").val(response.unit.description);
                    }
                });
            });
            // type edit
            $(document).on('click', '.type_edit', function () {
                var update_id = $(this).val();
                $("#myModal3").modal('show');

                $.ajax({
                    type: "GET",
                    url: "/edittype/" + update_id,
                    success: function (response) {
                        console.log(response.type);
                        $("#type_id").val(update_id);
                        $("#u_type").val(response.type.name);
                        $("#u_tdescription").val(response.type.description);
                    }
                });

            });
            $(document).on('click', '.category_delete', function () {
                var delete_id = $(this).val();
                $("#CategoryDelete").modal('show');
                $("#DelCatId").val(delete_id);

            });
            $(document).on('click', '.unit_delete', function () {
                var delete_id = $(this).val();
                $("#UnitDelete").modal('show');
                $("#DelUnitId").val(delete_id);

            });

            // type modal delete
            $(document).on('click', '.type_delete', function () {
                var delete_id = $(this).val();
                $("#TypeDelete").modal('show');
                $("#DelTypeId").val(delete_id);
            });

            //  category status
            $(document).on('click', '#flexSwitchCheckDefault_c', function () {
                var update_id = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "/cat_status/" + update_id,
                });
            });

            // unit status
            $(document).on('click', '#flexSwitchCheckDefault', function () {
                var update_id = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "/unit_status/" + update_id,
                });
            });

            // type status
            $(document).on('click', '#flexSwitchCheckDefault_t', function () {
                var update_id = $(this).val();

                $.ajax({
                    type: "GET",
                    url: "/type_status/" + update_id,
                });
            });
        });
    </script>
@endpush
