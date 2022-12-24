@extends('backend.master')
@push('custom_css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />
@endpush
@section('content')
<div class="container-fluid px-0">
    <section class="section p-3">
        <div class="section-header d-flex p-3">
            <h3 class="mt-3">Purchase</h3>
            <div class="section-header-breadcrumb d-flex p-3">
                <div class="breadcrumb-item m-2 ">
                    <a href="{{route('dashboard')}}">Home</a>
                </div>
                <div class="m-2">/</div>
                <div class="m-2">
                    <a href="{{route('purchase')}}">Purchase</a>
                </div>
            </div>
        </div>
        <div class="section-body container-fluid">
            <div class="row ">
                <div class="col-lg-12">
                    <div class="card" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                        <div class="card-header d-flex p-3">
                            <h4>Purchase</h4>
                            <div class="card-header-form">
                                <a href="{{route('add_purchase')}}" class="btn text-light float-right"
                                    style="background-color: #008080;">
                                    <i class="fa fa-plus"></i>
                                    Add Purchase
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <div class="table_section p-3 table-responsive-xxl">
                                    <table id="purchase_tbl" class="table table-striped text-center" style="vertical-align: middle;">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="" width="4%">#</th>
                                                <th scope="col" class="" width="12%">Purchase No.</th>
                                                <th scope="col" class="" width="10%">Supplier ID</th>
                                                <th scope="col" class="" width="5%">Vat</th>
                                                <th scope="col" class="" width="11%">Discount </th>
                                                <th scope="col" class="" width="9%">Total</th>
                                                <th scope="col" class="" width="9%">Paid</th>
                                                <th scope="col" class="" width="10%">Change/Due</th>
                                                <th scope="col" class="" width="9%">Status</th>
                                                <th scope="col" class="" width="10%">Action</th>
                                                <th scope="col" class="" width="11%">View Purchase</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($adpurchase as $key=> $purchase)
                                            <tr class="text-center">
                                                <td scope="col" class="">{{$key+1}}</td>
                                                <td scope="col" class="my-auto">{{$purchase->purchase_no}}</td>
                                                <td scope="col" class="my-auto">SUP-{{str_pad($purchase->supplier_info->supplier_id,'3','0',STR_PAD_LEFT)}}</td>
                                                <td scope="col" class="">{{$purchase->vat}}</td>
                                                <td scope="col" class="">{{$purchase->discount_amount}}</td>
                                                <td scope="col" class="">{{$purchase->total_amount}}</td>
                                                <td scope="col" class="">{{$purchase->paid_amount}}</td>
                                                <td scope="col" class="">
                                                    @if($purchase->change_amount != 0)
                                                    {{$purchase->change_amount}} (Change)
                                                    @elseif($purchase->due_amount != 0)
                                                    {{$purchase->due_amount}} (Due)
                                                    @else
                                                    0
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($purchase->status == 0)
                                                    <span class="badge bg-danger" style="padding: 7px;">Pending</span>
                                                    @else
                                                    <span class="badge bg-success" style="padding: 7px;">Approved</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn text-light dropdown-toggle "
                                                            style="background-color: #008080;"
                                                            data-bs-toggle="dropdown">
                                                            Action
                                                        </button>
                                                        <ul class="dropdown-menu option">
                                                            @if ($purchase->status == 0)
                                                            <li>
                                                                <button class="dropdown-item purch_approve" data-purchase-code="{{$purchase->purchase_no}}" value="{{$purchase->id}}">
                                                                    <i style="font-size: 10px; font-family: 'FontAwesome';" class="fas fa-pencil-alt my-2"> Approve</i>
                                                                </button>
                                                            </li>
                                                            @endif
                                                            @if($purchase->due_amount > 0)
                                                                <li>
                                                                    <button class="dropdown-item purch_due"
                                                                        value="{{$purchase->id}}" type="button"
                                                                        class="m-1 btn deleteRow float-right"
                                                                        data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                        title="Due">
                                                                        <i style="font-size: 10px; font-family: 'FontAwesome';"
                                                                            class="fa-solid fa-arrow-up-from-bracket my-2"> Due</i>
                                                                    </button>
                                                                </li>
                                                            @endif
                                                            <li>
                                                                <button class="dropdown-item purch_delete"
                                                                    value="{{$purchase->id}}" type="button"
                                                                    class="m-1 btn deleteRow float-right"
                                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                    title="Delete">
                                                                    <i style="font-size: 10px; font-family: 'FontAwesome';"
                                                                        class="fas fa-trash my-2"> Delete</i>
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" data-bs-toggle="modal"
                                                        class="btn text-light view" style=" background-color:#25aa9e;"
                                                        data-bs-target="#myModal{{$purchase->id}}">
                                                        View
                                                    </button>
                                                    <div class="modal" id="myModal{{$purchase->id}}">
                                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">
                                                                        View Sub-Purchase for Purchase No. {{$purchase->purchase_no}}
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="card-body" id="viewPurch">
                                                                        <div class="">
                                                                            <div class="table_section p-3">
                                                                                <table
                                                                                    class="table table-striped text-center"
                                                                                    style="vertical-align: middle;">
                                                                                    <thead >
                                                                                        <tr>
                                                                                            <th scope="col" width="14%">
                                                                                                Image
                                                                                            </th>
                                                                                            <th scope="col" width="14%">
                                                                                                Medicine Name
                                                                                            </th>
                                                                                            <th scope="col" width="14%">
                                                                                                Purchase Date
                                                                                            </th>
                                                                                            <th scope="col" width="14%">
                                                                                                Expire Date
                                                                                            </th>
                                                                                            <th scope="col" width="14%">
                                                                                                Total Quantity
                                                                                            </th>
                                                                                            <th scope="col" width="14%">
                                                                                                Price
                                                                                            </th>
                                                                                            <th scope="col" width="14%">
                                                                                                Sub Total
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach($subpurchase as $key=>
                                                                                        $subpurchases)
                                                                                        @if($subpurchases -> purchase_id
                                                                                        == $purchase -> id)
                                                                                        <tr class="text-center">
                                                                                            <td scope="col" class="">
                                                                                                <img class=""
                                                                                                    src="{{asset('/uploads/medicine/'.$subpurchases->medicine->image)}}"
                                                                                                    alt="image">
                                                                                            </td>
                                                                                            <td scope="col" class="">
                                                                                                {{$subpurchases->medicine->name}}
                                                                                            </td>
                                                                                            <td scope="col" class="">
                                                                                                {{\Carbon\Carbon::parse($subpurchases->adpurchase->date)->format('d/m/Y')}}
                                                                                            </td>
                                                                                            <td scope="col" class="">
                                                                                                {{\Carbon\Carbon::parse($subpurchases->expire_date)->format('d/m/Y')}}
                                                                                            </td>
                                                                                            <td scope="col" class="">
                                                                                                {{$subpurchases->quantity}}
                                                                                            </td>
                                                                                            <td scope="col" class="">
                                                                                                {{$subpurchases->price}}
                                                                                            </td>
                                                                                            <td scope="col" class="">
                                                                                                {{$subpurchases->sub_total}}
                                                                                            </td>
                                                                                        </tr>
                                                                                        @endif
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div
                                                                                class="modal-footer justify-content-center">
                                                                                <button type="button"
                                                                                    data-bs-dismiss="modal"
                                                                                    class="btn btn-danger">Close</button>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
<!-- purchase delete modal -->
<div class="modal" id="PurchDelete">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <form action="{{route('deletepurch')}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        Are You Sure?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="DelPurchId" name="DelPurchId" value="">
                    You Want to Delete This Record?
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn text-light" style="background-color:#25aa9e;" type="submit">
                        Save Changes
                    </button>

                    <button type="button" data-bs-dismiss="modal" class="btn btn-danger">
                        Cancel
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- due update modal -->
<div class="modal" id="PurchDue">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Due Update
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{route('due_purchase')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="PurchId" name="PurchId" value="">
                    <div class="mb-3">
                        <label for="dueAmount" class="form-label">Due Amount</label>
                        <input type="number" class="form-control" id="dueAmount" name="due_up_amount">
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn text-light" style="background-color:#25aa9e;" type="submit">
                        Save Changes
                    </button>

                    <button type="button" data-bs-dismiss="modal" class="btn btn-danger">
                        Cancel
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- purchase approve modal -->
<div class="modal" id="PurchApprove">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <form action="{{route('purchase_approve')}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        Are You Sure?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="ApporvePurchId" name="ApporvePurchId" value="">
                    <p class="text-center"> You Want to Approve <span class="purchase_code "></span> Purchase?</p>
                    <p class="text-center">If You Press Approve, <br> All Medicine Stock Will Updated And It Will Be Unchangeable.<br> </p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn text-light" style="background-color:#25aa9e;" type="submit">
                        Yes,Sure
                    </button>
                    <button type="button" data-bs-dismiss="modal" class="btn btn-danger">
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
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {

    $('#purchase_tbl').DataTable();

    $(document).on('click', '.purch_delete', function() {
        var delete_id = $(this).val();
        $("#PurchDelete").modal('show');
        $("#DelPurchId").val(delete_id);
    });
    $(document).on('click', '.purch_due', function() {
        var id = $(this).val();
        $("#PurchDue").modal('show');
        $("#PurchId").val(id);
    });
    
    $(document).on('click', '.purch_approve', function() {
        var approve_id = $(this).val();
        var approve_code = $(this).attr('data-purchase-code');
        $("#PurchApprove").modal('show');
        $("#ApporvePurchId").val(approve_id);
        $(".purchase_code").text(approve_code);
    });
});
</script>
@endpush
