@extends('backend.master')
@section('content')
    @php
        $system = \App\Models\Setting::find(1);
    @endphp
<style>
@media (min-width: 1200px) {
    .col-xl-6 {
        flex: 0 0 auto;
        width: 85%;
    }
}
@media print {
    body{
        margin: 0;
    }
    .col-print-header {
        width: 50%;
        text-align: left;
    }

    .col-print-header1 {
        width: 50%;
    }

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        text-align: center;
    }

    td, th {
        border: 1px solid #000;
        text-align: left;
        padding: 8px;
        color: #000000;
    }
}
</style>



<!-- Container -->
<div class="container mt-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card">
                <div class="card-body">

                    <!-- Header -->
                    <header>
                        <div class="row align-items-center">
                            <div class="col-sm-7 text-center text-sm-start mb-3 mb-sm-0 col-print-header">
                                <img id="logo" src="{{asset('/uploads/setting/'.$system->logo)}}" style="width: 100px;" title="Logo" alt="logo" />
                                <h4>{{$system->pharmacyname}}</h4>
                            </div>
                            <div class="col-sm-5 text-center text-sm-end col-print-header1">
                                <h4 class="text-7 mb-0">Invoice</h4>
                            </div>
                        </div>
                        <hr>
                    </header>

                    <!-- Main Content -->
                    <main>
                        <div class="row">
                            <div class="col-sm-6"><strong>Date: </strong>{{ \Carbon\Carbon::parse($purchase->date)->format('d/m/Y') }}</div>
                            <div class="col-sm-6 text-sm-end"> <strong>Invoice No:</strong> {{$purchase->purchase_no}}</div>

                        </div>
                        <hr>
                        <div class="row">

                            <div class="col-sm-6 order-sm-0"> <strong>Invoiced To:</strong>
                                <address>
                                    {{$system->pharmacyname}}<br />
                                    {{$system->email}}<br />
                                    {{$system->phone}}<br />
                                    {{$system->address}}<br />
                                </address>
                            </div>

                            <div class="col-sm-6 text-sm-end order-sm-1"> <strong>Pay To:</strong>
                                <address>
                                    SUP-{{str_pad($purchase->supplier_info->supplier_id,'3','0',STR_PAD_LEFT)}}<br />
                                    {{$purchase->supplier_info->name}}<br />
                                    {{$purchase->supplier_info->email}}<br />
                                    {{$purchase->supplier_info->phone}}<br />
                                </address>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="card-header">
                                            <tr>
                                                <td class="col-1"><strong>#</strong></td>
                                                <td class="col-3"><strong>Medicine</strong></td>
                                                <td class="col-2 text-center"><strong>QTY</strong></td>
                                                <td class="col-2 text-center"><strong>Unit Price</strong></td>
                                                <td class="col-2 text-center"><strong>Total</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($purchase->subpurchase as $key=>$purchase_list)
                                            <tr>
                                                <td class="col-1">{{$key + 1}}</td>
                                                <td class="col-3 text-1">{{$purchase_list->medicine->name}}</td>
                                                <td class="col-2 text-center">{{$purchase_list->quantity}}</td>
                                                <td class="col-2 text-center">{{$purchase_list->price}}</td>
                                                <td class="col-2 text-center">{{$purchase_list->sub_total}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="card-footer">
                                            <tr>
                                                <td colspan="4" class="text-end border-bottom-0"><strong>Sub
                                                        Total:</strong>
                                                </td>
                                                <td class="text-center border-bottom-0">{{$purchase->subpurchase->sum('sub_total')}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end border-bottom-0"><strong>Vat:</strong>
                                                </td>
                                                <td class="text-center border-bottom-0">{{$purchase->vat}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end border-bottom-0">
                                                    <strong>Discount:</strong>
                                                </td>
                                                <td class="text-center border-bottom-0">{{$purchase->discount_amount}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end border-bottom-0"><strong>Total:</strong>
                                                </td>
                                                <td class="text-center border-bottom-0">{{$purchase->total_amount}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end border-bottom-0"><strong>Paid:</strong>
                                                </td>
                                                <td class="text-center border-bottom-0">{{$purchase->paid_amount}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end"><strong>Change Amount:</strong></td>
                                                <td class="text-center ">{{$purchase->change_amount}}</td>

                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end border-bottom-0"><strong>Due:</strong>
                                                </td>
                                                <td class="text-center border-bottom-0">{{$purchase->due_amount}}</td>
                                            </tr>
                                        </tfoot>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </main>
                    <!-- Footer -->
                    <footer class="text-start mt-4">
                        <p class="text-1"><strong>Tk :</strong> {{$word}} Taka Only.</p>
                        <p class="text-1"><strong>NB :</strong> Wish Your Good Health.</p>
                        <div class="text-center">
                            <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()"
                                    class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i>
                                    Print</a>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
            <div class="modal-footer justify-content-center p-2 mt-2">
                <button type="submit" class="btn text-light" style="background-color:#25aa9e;">
                    @php
                        $t = str_replace(url('/'), '', url()->previous());
                    @endphp
                    @if($t == "/expense")
                        <a href="{{route('account_expense')}}" class="text-light" style="text-decoration: none;">Back</a>
                    @else
                        <a href="{{route('add_purchase')}}" class="text-light" style="text-decoration: none;">Back</a>
                    @endif
            </button>

            </div>
        </div>
    </div>
</div>

@endsection
