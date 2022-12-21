@extends('backend.master')
@section('content')
<style>
    .d-flex{
        display: flex!important;
        justify-content: space-between;
    }
</style>
<div class="container-fluid px-0">
    <section class="container-fluid my-3">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a href="{{url('/stock_report')}}" class="nav-link {{request()->is('stock_report') ? 'active' : '' }} "
                    id="stock_batch-tab" type="button" role="tab" aria-controls="stock_batch-tab-pane"
                    aria-selected="false">
                    <i class="fa-solid fa-money-bill-trend-up"></i>
                    Stock Report
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{url('/expiry_report')}}"
                    class="nav-link {{request()->is('expiry_report') ? 'active' : '' }} " id="expiry-tab" type="button"
                    role="tab" aria-controls="expiry-tab-pane" aria-selected="false">
                    <i class="fa-solid fa-xmark"></i>
                    Expiry Report
                </a>
            </li>
        </ul>
        <div class="container-fluid tab-content" id="myTabContent">

            <div class="tab-pane fade show {{request()->is('stock_report') ? 'active' : '' }}"
                id="{{url('/stock_report')}}" role="tabpanel" aria-labelledby="stock_batch-tab" tabindex="0">
                <section class="section p-3">
                    <div class="section-header d-flex p-3">
                        <a href="{{route('stock_report')}}" class="text-decoration-none">
                            <h3 class="mt-3">Stock Report</h3>
                        </a>
                        <div class="section-header-breadcrumb d-flex p-3">
                            <div class="breadcrumb-item m-2 ">
                                <a href="{{route('dashboard')}}">Home</a>
                            </div>
                            <div class="m-2">/</div>
                            <div class="m-2">
                                <a href="{{route('stock_report')}}">Stock Report</a>
                            </div>
                        </div>
                    </div>
                    <div class="section-body container-fluid">
                        <div class="row ">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center p-3">
                                        <h4>Stock Report</h4>
                                        <form action="{{route('stock_report')}}" method="GET">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2" name="search">
                                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="card-body">
                                        <div class="">
                                            <div class="table_section p-3">
                                                <table class="table table-striped text-center" style="vertical-align: middle;" >
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="">#</th>
                                                            <th scope="col" class="">Medicine Name</th>
                                                            <th scope="col" class="">Available Stock</th>
                                                            <th scope="col" class="">Stock Alert</th>
                                                            <th scope="col" class="">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($stock as $key=> $stock_b)
                                                        <tr class="text-center">
                                                            <td scope="col" class="">{{$key+1}}</td>
                                                            <td scope="col" class="">{{$stock_b->name}}</td>
                                                            <td scope="col" class="">
                                                                @if($stock_b->stock <= $stock_b->stock_alert)
                                                                    <span class="badge text-bg-danger">{{$stock_b->stock}}</span>
                                                                @else
                                                                    <span class="">{{$stock_b->stock}}</span>
                                                                @endif
                                                            </td>
                                                            <td scope="col" class="">{{$stock_b->stock_alert}}</td>
                                                            <td scope="col" class="">
                                                                @if($stock_b->status == 1)
                                                                    <p>Active</p>
                                                                @else
                                                                    <p>Inactive</p>
                                                                @endif
                                                            </td>
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

            <div class="tab-pane fade show {{request()->is('expiry_report') ? 'active' : '' }} " id="expiry-tab-pane"
                role="tabpanel" aria-labelledby="expiry-tab" tabindex="0">
                <section class="section p-3">
                    <div class="section-header d-flex p-3">
                        <a href="{{route('expiry_report')}}" class="text-decoration-none">
                            <h3 class="mt-3">Expiry Report</h3>
                        </a>
                        <div class="section-header-breadcrumb d-flex p-3">
                            <div class="breadcrumb-item m-2 ">
                                <a href="{{route('dashboard')}}">Home</a>
                            </div>
                            <div class="m-2">/</div>
                            <div class="m-2">
                                <a href="{{route('expiry_report')}}">Expiry Report</a>
                            </div>
                        </div>
                    </div>
                    <div class="section-body container-fluid">
                        <div class="row ">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center p-3">
                                        <h4>Expiry Medicine Report</h4>
                                        <form action="{{route('expiry_report')}}" method="GET">
                                            <div class="input-group mb-3">
                                                <input type="date" class="form-control" placeholder="q" aria-label="q" aria-describedby="button-addon2" name="q">
                                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-body">
                                        <div class="">
                                            <div class="table_section p-3">
                                                <table class="table table-striped text-center" style="vertical-align: middle;" >
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="">#</th>
                                                            <th scope="col" class="">Medicine Name</th>
                                                            <th scope="col" class="">Supplier ID</th>
                                                            <th scope="col" class="">Purchase Date</th>
                                                            <th scope="col" class="">Expire Date</th>
                                                            <th scope="col" class="">Purchase No.</th>
                                                            <th scope="col" class="">Stock</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($expired as $key=>$expires)
                                                        <tr class="text-center">
                                                            <td scope="col" class="">{{$key + 1}}</td>
                                                            <td scope="col" class="">{{$expires->medicine->name}}</td>
                                                            <td scope="col" class="my-auto">{{$expires->adpurchase->supplier_info->name}}</td>
                                                            <td scope="col" class="my-auto">{{$expires->adpurchase->date}}</td>
                                                            <td scope="col" class="">{{$expires->expire_date}}</td>
                                                            <td scope="col" class="">{{$expires->adpurchase->purchase_no}}</td>
                                                            <td scope="col" class="">{{$expires->medicine->stock->stock}}</td>
                                                        </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="7"><h6>No Data Found.</h6></td>
                                                            </tr>
                                                        @endforelse
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
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>
@endsection
