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
                                        <form action="">
                                            <div class=" mt-2">
                                                <form action="{{route('account_expense')}}" method="GET">
                                                    <div class="input-group mb-3">
                                                        <input type="date" name="start" class="form-control "
                                                            placeholder="dd-mm-yyyy " value="">
                                                        <input type="date" class="form-control "
                                                            placeholder="dd-mm-yyyy " aria-label="q"
                                                            aria-describedby="button-addon2" name="ended">
                                                        <button class="btn btn-outline-secondary" type="submit"
                                                            id="button-addon2">
                                                            <i class="fa-solid fa-magnifying-glass"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-body p-5">
                                        <div class="p-2">
                                            <h6 class="text-end">Total Yearly Expense : {{$expenseYearTotal}}</h6>
                                            <h6 class="text-end">Total Monthly Expense : {{$expenseMonthTotal}}</h6>
                                            <h6 class="text-end">Total Daily Expense : {{$expenseDailyTotal}}</h6>
                                        </div>
                                        <table class="table table-striped text-center table-bordered table_reduced">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="">#</th>
                                                    <th scope="col" class="">Purchase No.</th>
                                                    <th scope="col" class="">Purchase Date</th>
                                                    <th scope="col" class="">Amount</th>
                                                    <th scope="col" class="">Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($expenses as $key=> $expense)
                                                <tr class="text-center">
                                                    <td scope="col" class="">{{$key+1}}</td>
                                                    <td scope="col" class="">{{$expense->purchase_no}}</td>
                                                    <td scope="col" class="">{{$expense->date}}</td>
                                                    <td scope="col" class="">{{$expense->paid_amount}}</td>
                                                    <td>
                                                        <a href="{{route('purchase_invoice',$expense->id)}}"
                                                            class="btn text-light"
                                                            style="background-color:#5fb9a9;">Invoice</a>

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
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
                                        <form action="">
                                            <div class=" mt-2">
                                                <form action="{{route('account_income')}}" method="GET">
                                                    <div class="input-group mb-3">
                                                        <input type="date" name="begin" class="form-control"
                                                            placeholder="dd-mm-yyyy " value="">
                                                        <input type="date" class="form-control"
                                                            placeholder="dd-mm-yyyy " aria-label="q"
                                                            aria-describedby="button-addon2" name="end">
                                                        <button class="btn btn-outline-secondary" type="submit"
                                                            id="button-addon2">
                                                            <i class="fa-solid fa-magnifying-glass"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-body p-5">
                                        <div class="p-2">
                                            <h6 class="text-end">Total Yearly Income : {{$incomeYearTotal}}</h6>
                                            <h6 class="text-end">Total Monthly Income : {{$incomeMonthTotal}}</h6>
                                            <h6 class="text-end">Total Daily Income : {{$incomeDailyTotal}}</h6>
                                        </div>
                                        <table class="table table-striped text-center table-bordered table_reduced">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="">#</th>
                                                    <th scope="col" class="">Pos Sale</th>
                                                    <th scope="col" class="">Sale Date</th>
                                                    <th scope="col" class="">Amount</th>
                                                    <th scope="col" class="">Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($incomes as $key=>$income)
                                                <tr class="text-center">
                                                    <td scope="col" class="">{{$key + 1}}</td>
                                                    <td scope="col" class="">{{$income->invoice_no}}</td>
                                                    <td scope="col" class="">{{$income->date}}</td>
                                                    <td scope="col" class="">{{$income->paid_amount}}</td>
                                                    <td>
                                                        <a href="{{route('invoice',$income->id)}}"
                                                            class="btn text-light"
                                                            style="background-color:#5fb9a9;">Invoice</a>
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