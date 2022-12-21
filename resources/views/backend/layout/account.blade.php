@extends('backend.master')
@section('content')
<style>
#logo {
    height: 70px;
    border: none;
}
</style>
<div class="container-fluid px-0">

    <section class="container-fluid my-3">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a href="{{url('/expense')}}" class="nav-link {{request()->is('expense') ? 'active' : '' }} "
                    id="expense-tab" type="button" role="tab" aria-controls="expense-tab-pane" aria-selected="true">
                    <i class="fa-solid fa-bag-shopping"></i>
                    Expense
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="{{url('/income')}}" class="nav-link {{request()->is('income') ? 'active' : '' }} "
                    id="income-tab" type="button" role="tab" aria-controls="income-tab-pane" aria-selected="false">
                    <i class="fa-solid fa-money-check-dollar"></i>
                    Income
                </a>
            </li>
        </ul>
        <div class="container-fluid tab-content" id="myTabContent">
            <div class="tab-pane fade show {{request()->is('expense') ? 'active' : '' }}" id="{{url('/expense')}}"
                role="tabpanel" aria-labelledby="expense-tab" tabindex="0">
                <section class="section p-2">
                    <div class="section-header d-flex p-3">
                        <h2 class="mt-3">Expense</h2>
                        <div class="section-header-breadcrumb d-flex p-3">
                            <div class="breadcrumb-item m-2 ">
                                <a href="{{route('dashboard')}}">Home</a>
                            </div>
                            <div class="m-2">/</div>
                            <div class="m-2">
                                <a href="{{route('account_expense')}}">Expense</a>
                            </div>
                        </div>
                    </div>
                    <div class="section-body container-fluid">
                        <div class="row ">
                            <div class=" col-lg-12">
                                <div class="card" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4>Expense List</h4>
                                        <h4>Total Expanse : {{$expenseTotal}}</h4>
                                    </div>
                                    <div class="card-body p-5">
                                        <table class="table table-striped text-center table-bordered table_reduced">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="">#</th>
                                                    <th scope="col" class="">Title</th>
                                                    <th scope="col" class="">Amount</th>
                                                    <th scope="col" class="">Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($expenses as $key=> $expense)
                                                <tr class="text-center">
                                                    <td scope="col" class="">{{$key+1}}</td>
                                                    <td scope="col" class="">{{$expense->purchase_no}}</td>
                                                    <td scope="col" class="">{{$expense->paid_amount}}</td>
                                                    <td>
                                                        <a href="{{route('purchase_invoice',$expense->id)}}" class="btn text-light" style="background-color:#5fb9a9;">Invoice</a>
{{--                                                        <div class=" modal" id="myModal">--}}
{{--                                                            <div class="modal-dialog modal-dialog-centered modal-lg">--}}
{{--                                                                <div class="modal-content">--}}
{{--                                                                    <div class="modal-header">--}}
{{--                                                                        <h5 class="modal-title">--}}
{{--                                                                            Medicine Description--}}
{{--                                                                        </h5>--}}
{{--                                                                        <button type="button" class="btn-close"--}}
{{--                                                                            data-bs-dismiss="modal"></button>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="modal-body">--}}
{{--                                                                        <div class="container invoice-container">--}}
{{--                                                                            <!-- Header -->--}}
{{--                                                                            <header>--}}
{{--                                                                                <div class="row align-items-center">--}}
{{--                                                                                    <div--}}
{{--                                                                                        class="col-sm-7 text-center text-sm-start mb-3 mb-sm-0">--}}
{{--                                                                                        <img id="logo"--}}
{{--                                                                                            src="assets/backend/img/medi.png"--}}
{{--                                                                                            style="width: 100px;"--}}
{{--                                                                                            title="Logo" alt="logo" />--}}
{{--                                                                                        <h4>Medicine POS</h4>--}}
{{--                                                                                    </div>--}}
{{--                                                                                    <div--}}
{{--                                                                                        class="col-sm-5 text-center text-sm-end">--}}
{{--                                                                                        <h4 class="text-7 mb-0">Invoice</h4>--}}
{{--                                                                                    </div>--}}
{{--                                                                                </div>--}}
{{--                                                                                <hr>--}}
{{--                                                                            </header>--}}
{{--    --}}
{{--                                                                            <!-- Main Content -->--}}
{{--                                                                            <main>--}}
{{--                                                                                <div class="row">--}}
{{--                                                                                    <div class="col-sm-6 text-sm-start">--}}
{{--                                                                                        <strong>Date:</strong> 05/12/2020--}}
{{--                                                                                    </div>--}}
{{--                                                                                    <div class="col-sm-6 text-sm-end">--}}
{{--                                                                                        <strong>Invoice No:</strong> 16835--}}
{{--                                                                                    </div>--}}
{{--    --}}
{{--                                                                                </div>--}}
{{--                                                                                <hr>--}}
{{--                                                                                <div class="row">--}}
{{--                                                                                    <div--}}
{{--                                                                                        class="col-sm-6 text-sm-end order-sm-1">--}}
{{--                                                                                        <strong>Pay To:</strong>--}}
{{--                                                                                        <address>--}}
{{--                                                                                            Uttara Dhaka<br />--}}
{{--                                                                                            Joynal Market<br />--}}
{{--                                                                                            T.I.C Colony<br />--}}
{{--                                                                                            contact@pharma.com--}}
{{--                                                                                        </address>--}}
{{--                                                                                    </div>--}}
{{--                                                                                    <div--}}
{{--                                                                                        class="col-sm-6 text-sm-start order-sm-0">--}}
{{--                                                                                        <strong>Invoiced To:</strong>--}}
{{--                                                                                        <address>--}}
{{--                                                                                            Customer<br />--}}
{{--                                                                                            Uttara Dhaka<br />--}}
{{--                                                                                            Sector-10<br />--}}
{{--                                                                                            Kamarpara--}}
{{--                                                                                        </address>--}}
{{--                                                                                    </div>--}}
{{--                                                                                </div>--}}
{{--                                                                                <div class="card">--}}
{{--                                                                                    <div class="card-body p-0">--}}
{{--                                                                                        <div class="table-responsive ">--}}
{{--                                                                                            <table--}}
{{--                                                                                                class="table table_reduced mb-0">--}}
{{--                                                                                                <thead class="card-header">--}}
{{--                                                                                                    <tr>--}}
{{--                                                                                                        <td class="col-1">--}}
{{--                                                                                                            <strong>#</strong>--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td class="col-3">--}}
{{--                                                                                                            <strong>Medicine</strong>--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="col-2 text-center">--}}
{{--                                                                                                            <strong>QTY</strong>--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="col-2 text-center">--}}
{{--                                                                                                            <strong>Unit--}}
{{--                                                                                                                Price</strong>--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="col-2 text-center">--}}
{{--                                                                                                            <strong>Price</strong>--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="col-2 text-end">--}}
{{--                                                                                                            <strong>Total</strong>--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                    </tr>--}}
{{--                                                                                                </thead>--}}
{{--                                                                                                <tbody>--}}
{{--                                                                                                    <tr>--}}
{{--                                                                                                        <td class="col-1">1--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="col-3 text-1">--}}
{{--                                                                                                            Napa--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="col-2 text-center">--}}
{{--                                                                                                            20--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="col-2 text-center">--}}
{{--                                                                                                            5--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="col-2 text-center">--}}
{{--                                                                                                            100--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="col-2 text-end">--}}
{{--                                                                                                            100--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                    </tr>--}}
{{--                                                                                                    <tr>--}}
{{--                                                                                                        <td>2</td>--}}
{{--                                                                                                        <td class="text-1">--}}
{{--                                                                                                            Napa Extra--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="text-center">--}}
{{--                                                                                                            10--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="text-center">--}}
{{--                                                                                                            6--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="text-center">--}}
{{--                                                                                                            150--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="text-end">--}}
{{--                                                                                                            150--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                    </tr>--}}
{{--                                                                                                </tbody>--}}
{{--                                                                                                <tfoot class="card-footer">--}}
{{--                                                                                                    <tr>--}}
{{--                                                                                                        <td colspan="5"--}}
{{--                                                                                                            class="text-end border-bottom-0">--}}
{{--                                                                                                            <strong>Sub--}}
{{--                                                                                                                Total:</strong>--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="text-end border-bottom-0">--}}
{{--                                                                                                            250.00</td>--}}
{{--                                                                                                    </tr>--}}
{{--                                                                                                    <tr>--}}
{{--                                                                                                        <td colspan="5"--}}
{{--                                                                                                            class="text-end border-bottom-0">--}}
{{--                                                                                                            <strong>Vat:</strong>--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="text-end border-bottom-0">--}}
{{--                                                                                                            5.00--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                    </tr>--}}
{{--                                                                                                    <tr>--}}
{{--                                                                                                        <td colspan="5"--}}
{{--                                                                                                            class="text-end border-bottom-0">--}}
{{--                                                                                                            <strong>Discount:</strong>--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="text-end border-bottom-0">--}}
{{--                                                                                                            0.00</td>--}}
{{--                                                                                                    </tr>--}}
{{--                                                                                                    <tr>--}}
{{--                                                                                                        <td colspan="5"--}}
{{--                                                                                                            class="text-end border-bottom-0">--}}
{{--                                                                                                            <strong>Total:</strong>--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="text-end border-bottom-0">--}}
{{--                                                                                                            255.00</td>--}}
{{--                                                                                                    </tr>--}}
{{--                                                                                                    <tr>--}}
{{--                                                                                                        <td colspan="5"--}}
{{--                                                                                                            class="text-end border-bottom-0">--}}
{{--                                                                                                            <strong>Paid:</strong>--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="text-end border-bottom-0">--}}
{{--                                                                                                            260.00</td>--}}
{{--                                                                                                    </tr>--}}
{{--                                                                                                    <tr>--}}
{{--                                                                                                        <td colspan="5"--}}
{{--                                                                                                            class="text-end">--}}
{{--                                                                                                            <strong>Change--}}
{{--                                                                                                                Amount:</strong>--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="text-end ">--}}
{{--                                                                                                            5.00</td>--}}
{{--    --}}
{{--                                                                                                    </tr>--}}
{{--                                                                                                    <tr>--}}
{{--                                                                                                        <td colspan="5"--}}
{{--                                                                                                            class="text-end border-bottom-0">--}}
{{--                                                                                                            <strong>Due:</strong>--}}
{{--                                                                                                        </td>--}}
{{--                                                                                                        <td--}}
{{--                                                                                                            class="text-end border-bottom-0">--}}
{{--                                                                                                            0.00</td>--}}
{{--                                                                                                    </tr>--}}
{{--                                                                                                </tfoot>--}}
{{--    --}}
{{--                                                                                            </table>--}}
{{--                                                                                        </div>--}}
{{--                                                                                    </div>--}}
{{--                                                                                </div>--}}
{{--                                                                            </main>--}}
{{--                                                                            <!-- Footer -->--}}
{{--                                                                            <footer class="text-start mt-4">--}}
{{--                                                                                <p class="text-1"><strong>Tk :</strong> Two--}}
{{--                                                                                    Hundred Fifty Five Taka Only.</p>--}}
{{--                                                                                <p class="text-1"><strong>NB :</strong> Wish--}}
{{--                                                                                    Your Good Health.</p>--}}
{{--                                                                                <div class="text-center">--}}
{{--                                                                                    <div--}}
{{--                                                                                        class="btn-group btn-group-sm d-print-none">--}}
{{--                                                                                        <a href="javascript:window.print()"--}}
{{--                                                                                            class="btn btn-light border text-black-50 shadow-none"><i--}}
{{--                                                                                                class="fa fa-print"></i>--}}
{{--                                                                                            Print--}}
{{--                                                                                        </a>--}}
{{--                                                                                    </div>--}}
{{--                                                                                </div>--}}
{{--                                                                            </footer>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div class="modal-footer justify-content-center">--}}
{{--                                                                        <button type="button" data-bs-dismiss="modal"--}}
{{--                                                                            class="btn btn-danger">--}}
{{--                                                                            Cancel--}}
{{--                                                                        </button>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <!-- <tfoot>
                                                <tr>
                                                    <td colspan="1" class="text-right">Total</td>
                                                    <td></td>
                                                    <td>3400</td>
                                                    <td></td>
                                                </tr>
                                            </tfoot> -->
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        {{ $expenses->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="tab-pane fade show {{request()->is('income') ? 'active' : '' }}" id="{{url('/income')}}"
                role="tabpanel" aria-labelledby="income-tab" tabindex="0">
                <section class="section p-2">
                    <div class="section-header d-flex p-3">
                        <h2 class="mt-3">Income</h2>
                        <div class="section-header-breadcrumb d-flex p-3">
                            <div class="breadcrumb-item m-2 ">
                                <a href="{{route('dashboard')}}">Home</a>
                            </div>
                            <div class="m-2">/</div>
                            <div class="m-2">
                                <a href="{{route('account_income')}}">Income</a>
                            </div>
                        </div>
                    </div>
                    <div class="section-body container-fluid">
                        <div class="row ">
                            <div class=" col-lg-12">
                                <div class="card" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4>Income List</h4>
                                        <h4>Total Income : {{$incomeTotal}}</h4>
                                    </div>
                                    <div class="card-body p-5">
                                        <table class="table table-striped text-center table-bordered table_reduced">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="">#</th>
                                                    <th scope="col" class="">Title</th>
                                                    <th scope="col" class="">Amount</th>
                                                    <th scope="col" class="">Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($incomes as $key=>$income)
                                                <tr class="text-center">
                                                    <td scope="col" class="">{{$key + 1}}</td>
                                                    <td scope="col" class="">{{$income->invoice_no}}</td>
                                                    <td scope="col" class="">{{$income->paid_amount}}</td>
                                                    <td>
                                                        <a href="{{route('invoice',$income->id)}}" class="btn text-light" style="background-color:#5fb9a9;">Invoice</a>
                                                        <div class=" modal" id="myModal1">
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
                                                                        <div class="container invoice-container">
                                                                            <!-- Header -->
                                                                            <header>
                                                                                <div class="row align-items-center">
                                                                                    <div
                                                                                        class="col-sm-7 text-center text-sm-start mb-3 mb-sm-0">
                                                                                        <img id="logo"
                                                                                            src="assets/backend/img/medi.png"
                                                                                            style="width: 100px;"
                                                                                            title="Logo" alt="logo" />
                                                                                        <h4>Medicine POS</h4>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-sm-5 text-center text-sm-end">
                                                                                        <h4 class="text-7 mb-0">Invoice</h4>
                                                                                    </div>
                                                                                </div>
                                                                                <hr>
                                                                            </header>

                                                                            <!-- Main Content -->
                                                                            <main>
                                                                                <div class="row">
                                                                                    <div class="col-sm-6 text-sm-start">
                                                                                        <strong>Date:</strong> 05/12/2020
                                                                                    </div>
                                                                                    <div class="col-sm-6 text-sm-end">
                                                                                        <strong>Invoice No:</strong> 16835
                                                                                    </div>

                                                                                </div>
                                                                                <hr>
                                                                                <div class="row">
                                                                                    <div
                                                                                        class="col-sm-6 text-sm-end order-sm-1">
                                                                                        <strong>Pay To:</strong>
                                                                                        <address>
                                                                                            Uttara Dhaka<br />
                                                                                            Joynal Market<br />
                                                                                            T.I.C Colony<br />
                                                                                            contact@pharma.com
                                                                                        </address>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-sm-6 text-sm-start order-sm-0">
                                                                                        <strong>Invoiced To:</strong>
                                                                                        <address>
                                                                                            Customer<br />
                                                                                            Uttara Dhaka<br />
                                                                                            Sector-10<br />
                                                                                            Kamarpara
                                                                                        </address>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card">
                                                                                    <div class="card-body p-0">
                                                                                        <div class="table-responsive ">
                                                                                            <table
                                                                                                class="table table_reduced mb-0">
                                                                                                <thead class="card-header">
                                                                                                    <tr>
                                                                                                        <td class="col-1">
                                                                                                            <strong>#</strong>
                                                                                                        </td>
                                                                                                        <td class="col-3">
                                                                                                            <strong>Medicine</strong>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="col-2 text-center">
                                                                                                            <strong>QTY</strong>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="col-2 text-center">
                                                                                                            <strong>Unit
                                                                                                                Price</strong>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="col-2 text-center">
                                                                                                            <strong>Price</strong>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="col-2 text-end">
                                                                                                            <strong>Total</strong>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="col-1">1
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="col-3 text-1">
                                                                                                            Napa
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="col-2 text-center">
                                                                                                            20
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="col-2 text-center">
                                                                                                            5
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="col-2 text-center">
                                                                                                            100
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="col-2 text-end">
                                                                                                            100
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>2</td>
                                                                                                        <td class="text-1">
                                                                                                            Napa Extra
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="text-center">
                                                                                                            10
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="text-center">
                                                                                                            6
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="text-center">
                                                                                                            150
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="text-end">
                                                                                                            150
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                                <tfoot class="card-footer">
                                                                                                    <tr>
                                                                                                        <td colspan="5"
                                                                                                            class="text-end border-bottom-0">
                                                                                                            <strong>Sub
                                                                                                                Total:</strong>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="text-end border-bottom-0">
                                                                                                            250.00</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td colspan="5"
                                                                                                            class="text-end border-bottom-0">
                                                                                                            <strong>Vat:</strong>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="text-end border-bottom-0">
                                                                                                            5.00
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td colspan="5"
                                                                                                            class="text-end border-bottom-0">
                                                                                                            <strong>Discount:</strong>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="text-end border-bottom-0">
                                                                                                            0.00</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td colspan="5"
                                                                                                            class="text-end border-bottom-0">
                                                                                                            <strong>Total:</strong>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="text-end border-bottom-0">
                                                                                                            255.00</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td colspan="5"
                                                                                                            class="text-end border-bottom-0">
                                                                                                            <strong>Paid:</strong>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="text-end border-bottom-0">
                                                                                                            260.00</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td colspan="5"
                                                                                                            class="text-end">
                                                                                                            <strong>Change
                                                                                                                Amount:</strong>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="text-end ">
                                                                                                            5.00</td>

                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td colspan="5"
                                                                                                            class="text-end border-bottom-0">
                                                                                                            <strong>Due:</strong>
                                                                                                        </td>
                                                                                                        <td
                                                                                                            class="text-end border-bottom-0">
                                                                                                            0.00</td>
                                                                                                    </tr>
                                                                                                </tfoot>

                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </main>
                                                                            <!-- Footer -->
                                                                            <footer class="text-start mt-4">
                                                                                <p class="text-1"><strong>Tk :</strong> Two
                                                                                    Hundred Fifty Five Taka Only.</p>
                                                                                <p class="text-1"><strong>NB :</strong> Wish
                                                                                    Your Good Health.</p>
                                                                                <div class="text-center">
                                                                                    <div
                                                                                        class="btn-group btn-group-sm d-print-none">
                                                                                        <a href="javascript:window.print()"
                                                                                            class="btn btn-light border text-black-50 shadow-none"><i
                                                                                                class="fa fa-print"></i>
                                                                                            Print
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </footer>
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
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <!-- <tfoot>
                                                <tr>
                                                    <td colspan="1" class="text-right">Total</td>
                                                    <td></td>
                                                    <td>3400</td>
                                                    <td></td>
                                                </tr>
                                            </tfoot> -->
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        {{ $incomes->links() }}
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
