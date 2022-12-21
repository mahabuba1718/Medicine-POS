@extends('backend.master')
@section('content')

<section id="features" class="text-center">
    <div class="row p-3 mb-3">
        <div class="col-lg-3 col-md-6">
            <div class="features-col" style="background-color: #008ba9; color:white;">
                <h5 class="text-light ">Purchase</h5>
                <i class="fa-2x p-2 mb-3 fa-solid fa-cart-shopping"></i>
                <div class="">
                    <h4 class="text-light ">{{$purchase}}</h4>
                    <h5 class="text-light ">Total Purchase</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="features-col" style="background-color: #88ae88; color:white">
                <h5 class="text-light ">Expenses</h5>
                <i class="fa-2x p-2 mb-3 fa-solid fa-dollar-sign"></i>
                <div class=" ">
                    <h4 class="text-light ">{{$expense}}</h4>
                    <h5 class="text-light ">Total Expenses</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 ">
            <div class="features-col" style="background-color: #6768b2; color:white">
                <h5 class="text-light ">Sales</h5>
                <i class="fa-2x p-2 mb-3 fa-brands fa-salesforce"></i>
                <div class=" ">
                    <h4 class="text-light ">{{$sales}}</h4>
                    <h5 class="text-light ">Total Sales</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 ">
            <div class="features-col" style="background-color: #bd7474; color:white">
                <h5 class="text-light ">Income</h5>
                <i class="fa-2x p-2 mb-3 fa-solid fa-money-check-dollar"></i>
                <div class=" ">
                    <h4 class="text-light ">{{$income}}</h4>
                    <h5 class="text-light ">Total Income</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 ">
            <div class="features-col" style="background-color: #b0968e; color:white">
                <h5 class="text-light ">Profit</h5>
                <i class="fa-2x p-2 mb-3 fa-solid fa-hand-holding-dollar"></i>
                <div class=" ">
                    <h4 class="text-light ">
                        @if($profit > 0)
                            {{$profit}}
                        @else
                        0
                        @endif
                    </h4>
                    <h5 class="text-light ">Total Profit</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 ">
            <div class="features-col" style="background-color: #c78e5c; color:white">
                <h5 class="text-light ">Stocked Medicine</h5>
                <i class="fa-2x p-2 mb-3 fa-solid fa-capsules"></i>
                <div class=" ">
                    <h4 class="text-light ">{{$med_stock}}</h4>
                    <h5 class="text-light ">Total Stocked Medicine</h5>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 ">
            <div class="features-col" style="background-color: #16b1ce; color:white">
                <h5 class="text-light ">Expired Medicine</h5>
                <i class="fa-2x p-2 mb-3 fa-solid fa-xmark"></i>
                <div class=" ">
                    <h4 class="text-light ">{{$expired}}</h4>
                    <h5 class="text-light ">Total Expired Medicine</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="features-col" style="background-color: #779685; color:white">
                <h5 class="text-light ">Pharmacist</h5>
                <i class="fa-2x p-2 mb-3 fa-solid fa-user-doctor"></i>
                <div class=" ">
                    <h4 class="text-light ">{{$pharmacist}}</h4>
                    <h5 class="text-light ">Total Pharmacist</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 ">
            <div class="features-col" style="background-color: #3fa278; color:white">
                <h5 class="text-light ">Customer</h5>
                <i class="fa-2x p-2 mb-3 fa-solid fa-user"></i>
                <div class=" ">
                    <h4 class="text-light ">{{$customer}}</h4>
                    <h5 class="text-light ">Total Customer</h5>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="features-col" style="background-color: #506a8e; color:white">
                <h5 class="text-light ">Suppliers</h5>
                <i class="fa-2x p-2 mb-3 fa-solid fa-truck-field"></i>
                <div class=" ">
                    <h4 class="text-light ">{{$supplier}}</h4>
                    <h5 class="text-light ">Total Suppliers</h5>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>
@endsection
