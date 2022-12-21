@extends('backend.master')
@section('content')
<div class="container-fluid px-0">
    <section class="section p-3">
        <div class="section-header d-flex p-3">
            <h3 class="mt-3">POS Sale List</h3>
            <div class="section-header-breadcrumb d-flex p-3">
                <div class="breadcrumb-item m-2 ">
                    <a href="{{route('dashboard')}}">Home</a>
                </div>
                <div class="m-2">/</div>
                <div class="m-2">
                    <a href="{{route('possale')}}">POS Sale</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex p-3">
                            <h4>POS Sale</h4>
                            <!-- <div class="card-header-form">
                                <a href="#" class="btn float-right text-light" style="background-color: #008080;">
                                    <i class="fa fa-list"></i>
                                    Draft List
                                </a>
                            </div> -->
                        </div>
                        <div class="card-body">
                            <div class="">
                                <div class="table_section p-3">
                                    <table class="table table-striped text-center" style="vertical-align: middle;" >
                                        <thead>
                                            <tr >
                                                <th scope="col" class="" width="4%">#</th>
                                                <th scope="col" class="" width="8%">Date</th>
                                                <th scope="col" class="" width="7%">Invoice No.</th>
                                                <th scope="col" class="" width="8%">Customer</th>
                                                <th scope="col" class="" width="8%">Total Quantity</th>
                                                <th scope="col" class="" width="8%">Net Total</th>
                                                <th scope="col" class="" width="5%">Vat</th>
                                                <th scope="col" class="" width="8%">Discount </th>
                                                <th scope="col" class="" width="8%">Total Amount</th>
                                                <th scope="col" class="" width="11%">Paid Amount(BDT)</th>
                                                <th scope="col" class="" width="11%">Change / Due (BDT)</th>
                                                <th scope="col" class="" width="9%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pos as $key=>$pos_item)
                                            <tr class="text-center">
                                                <td scope="col" class="">{{$key + 1}}</td>
                                                <td scope="col" class="my-auto">{{ \Carbon\Carbon::parse($pos_item->date)->format('d/m/Y') }}</td>
                                                <td scope="col" class="my-auto">{{$pos_item->invoice_no}}</td>
                                                <td scope="col" class="">
                                                    @if($pos_item->customer_id == 0)
                                                    Walk In Customer
                                                    @else
                                                    {{$pos_item->customer->customer_name}}
                                                    @endif
                                                </td>
                                                <td scope="col" class="">{{$pos_item->total_quantity}}</td>
                                                <td scope="col" class="">{{$pos_item->net_total}}</td>
                                                <td scope="col" class="">{{$pos_item->vat}}</td>
                                                <td scope="col" class="">{{$pos_item->discount_amount}}</td>
                                                <td scope="col" class="">{{round($pos_item->total_amount,2)}}</td>
                                                <td scope="col" class="">{{$pos_item->paid_amount}}</td>
                                                <td scope="col" class="">
                                                    @if($pos_item->change_amount != 0)
                                                        {{$pos_item->change_amount}} (Change)
                                                    @elseif($pos_item->due_amount != 0)
                                                        {{$pos_item->due_amount}} (Due)
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('invoice',$pos_item->id)}}" class="btn btn-sm text-light" style="background-color: #008080;">
                                                        <i style="font-size: 15px;" class="fa-solid fa-file my-2"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm text-light" style="background-color: #008080;">
                                                        <i style="font-size: 15px;" class="fas fa-trash my-2"></i>
                                                    </button>
                                                    <!-- <div class="dropdown">
                                                        <button type="button" class="btn dropdown-toggle text-light" style="background-color: #008080;"
                                                            data-bs-toggle="dropdown">
                                                            Action
                                                        </button>
                                                        <ul class="dropdown-menu option">
                                                            <li><a class="dropdown-item" href="#">
                                                                <i style="font-size: 10px;"
                                                                        class="fas fa-pencil-alt my-2"> Approve</i>
                                                                </a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="#">
                                                                    <i style="font-size: 10px;"
                                                                        class="fas fa-trash my-2"> Delete</i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div> -->
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{ $pos->links() }}
                        </div>
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