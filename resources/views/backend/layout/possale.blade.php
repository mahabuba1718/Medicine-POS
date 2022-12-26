@extends('backend.master')
@push('custom_css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" />
@endpush
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
                        </div>
                        <div class="card-body">
                            <div class="">
                                <div class="table_section p-3">
                                    <table id="pos_tbl" class="table table-striped text-center" style="vertical-align: middle;">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="" width="4%">#</th>
                                                <th scope="col" class="" width="8%">Date</th>
                                                <th scope="col" class="" width="7%">Invoice No.</th>
                                                <th scope="col" class="" width="10%">Customer</th>
                                                <th scope="col" class="" width="8%">Total Quantity</th>
                                                <th scope="col" class="" width="8%">Net Total</th>
                                                <th scope="col" class="" width="5%">Vat</th>
                                                <th scope="col" class="" width="8%">Discount </th>
                                                <th scope="col" class="" width="8%">Total</th>
                                                <th scope="col" class="" width="9%">Paid</th>
                                                <th scope="col" class="" width="9%">Change / Due </th>
                                                @if(Auth::user()->role_id == 1)
                                                <th scope="col" class="" width="11%">Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pos as $key=>$pos_item)
                                            <tr class="text-center">
                                                <td scope="col" class="">{{$key + 1}}</td>
                                                <td scope="col" class="my-auto">
                                                    {{ \Carbon\Carbon::parse($pos_item->date)->format('d/m/Y') }}</td>
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
                                                @if(Auth::user()->role_id == 1)
                                                <td>
                                                    <a href="{{route('invoice',$pos_item->id)}}"
                                                        class="btn btn-sm text-light" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title="Invoice"
                                                        style="background-color: #008080;">
                                                        <i style="font-size: 15px;" class="fa-solid fa-file my-2"></i>
                                                    </a>
                                                    @if($pos_item->due_amount > 0)

                                                    <button class="pos_due btn btn-sm text-light"
                                                        style="background-color: #008080;" value="{{$pos_item->id}}"
                                                        type="button" class="m-1 btn deleteRow float-right"
                                                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Due" require>
                                                        <i style="font-size: 15px;"
                                                            class="fa-solid fa-arrow-up-from-bracket my-2">
                                                        </i>
                                                    </button>

                                                    @endif
                                                    <button type="button" class="btn btn-sm text-light pos_delete" value="{{$pos_item->id}}" type="button"
                                                        style="background-color: #008080;" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title="Delete">
                                                        <i style="font-size: 15px;" class="fas fa-trash my-2"></i>
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
<!-- due modal -->
<div class="modal" id="PosDue">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Due Update
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{route('due_pos')}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="PosId" name="PosId" value="">
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

<!-- delete modal -->
<div class="modal" id="PosDelete">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <form action="{{route('deletepos')}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        Are You Sure?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="DelPosId" name="DelPosId" value="">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>
@endsection

@push('custom_script')
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {

    $('#pos_tbl').DataTable();
    // due cal
    $(document).on('click', '.pos_due', function() {
        var id = $(this).val();
        // alert(update_id);
        $("#PosDue").modal('show');
        $("#PosId").val(id);
    });
});
// delete
$(document).on('click', '.pos_delete', function() {
        var delete_id = $(this).val();
        // alert(update_id);
        $("#PosDelete").modal('show');
        $("#DelPosId").val(delete_id);
    });
</script>
@endpush