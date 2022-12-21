@extends('backend.master')
@section('content')
<!-- <style>
            .mr-2{
                margin-left: 0.5rem !important;
            }
        </style> -->

<div class="container-fluid px-0">
    <section class="section p-3">
        <div class="section-header d-flex p-3">
            <h2 class="mt-3">
             <a href="{{route('pos')}}" style="text-decoration:none;" class="text-dark">POS</a>
            </h2>
            <div class="section-header-breadcrumb d-flex p-3">
                <div class="breadcrumb-item m-2 ">
                    <a href="{{route('dashboard')}}">Home</a>
                </div>
                <div class="m-2">/</div>
                <div class="m-2">
                    <a href="{{route('pos')}}">POS</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row d-flex">
                <div class="col-lg-6" style="padding: 0px">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="from-group">
                                <form action="{{route('pos')}}" type="get" method="GET" class="search-form">
                                    <!-- @csrf -->
                                    <input class="form-control mb-3 search-box search_med" type="text"
                                        placeholder="Enter a Medicine Name" name="search" value="{{request()->get('search')}}">
                                    <button type="submit" id="s_m_submit" hidden>submit</button>
                                </form>

                                <div class="row pos_div">

                                    @forelse($adpurchase as $key=> $subpurchase)
                                    <div class="col-lg-3 col-md-4 col-sm-6 mb-2" style="padding: 8px;">
                                        <div class="card">
                                            @if($subpurchase->medicine->image != null)
                                            <img class="card-img-top mb-2 "
                                                src="{{asset('/uploads/medicine/'.$subpurchase->medicine->image)}}"
                                                alt="image" style="height: 100px">
                                            @endif
                                            <div class="card-body text-center" style="padding: 0.2rem;">
                                                @if($subpurchase->stock <= $subpurchase->stock_alert)
                                                    <span class="position-absolute top-0 start-100 translate-middle badge text-bg-danger rounded-pill">
                                                        {{$subpurchase->stock}}
                                                    </span>
                                                @else
                                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" style=" background-color: #008080;">
                                                    {{$subpurchase->stock}}
                                                    </span>
                                                @endif
                                                <h6 class="card-title " style="font-size: inherit;">
                                                    {{$subpurchase->medicine->name}}
                                                </h6>
                                                <a href="{{route('addtocart',$subpurchase->medicine->id)}}"
                                                    class="stretched-link" style="text-decoration: none;">
                                                    <h6 class="text-primary" style="font-size: inherit;">৳
                                                        {{$subpurchase->medicine->price}}</h6>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <h2>No Match Found Here.</h2>
                                    @endforelse
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 " style="padding: 0px">
                    <form action="{{route('pos_sale')}}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <div class="form-group">
                                    <select name="customer_id" id="contact_id" class="form-control">
                                        <option value="0">Walk In Customer</option>
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->customer_name}}</option>
                                        @endforeach
                                        <!-- <option value="2">Customer</option>
                                        <option value="4">Mahabuba</option> -->
                                    </select>
                                    <span class="text-danger"> @error('customer_id') {{$message}} @enderror</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table ">
                                    <table id="table1" class="table table-bordered pos_table table_reduced">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th scope="col" width="30%">Medicine</th>
                                                <th scope="col" width="22%">QTY</th>
                                                <th scope="col" width="18%">Price</th>
                                                <th scope="col" width="20%">Sub Total</th>
                                                <th scope="col" width="10 %"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($pos as $key=>$data)
                                            <tr>
                                                <td class="text-center">
                                                    {{$data->name}}
                                                </td>

                                                <td colspan="1">
                                                    <form></form>
                                                    <form action="{{route('cart_increment')}}" method="POST">
                                                        @csrf
                                                        <div class="input-group">
                                                            <input type="hidden" name="row_id" value="{{$data->rowId}}">
                                                            <input type="number" id="quantity" name="quantity"
                                                                value="{{$data->qty}}"
                                                                class="form-control vat_amount QTY"
                                                                style=" padding: 0px; text-align: center; border-radius:10px;">
                                                            <button type="submit" class="btn btn-link ">
                                                                <!-- <i class="fas fa-plus"></i> -->
                                                                <i class="fa-solid fa-rotate-right"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </td>

                                                <td colspan="1">
                                                    <div class="input-group">
                                                        <p id="price" name="price"  style="margin-bottom: 0rem;" >৳ {{$data->price}}</p>
                                                    </div>
                                                </td>
                                                @php
                                                $total = $data ->price*$data ->qty
                                                @endphp
                                                <td colspan="1">

                                                    <p style="margin-bottom: 0rem;" >৳ {{$total}}</p>
                                                </td>
                                                <td colspan="1">
                                                    <!-- <input type="button" value=" - "
                                                        class="text-light border-0 m-2 bg-danger  rounded-2"
                                                        onclick="ob_adRows.delRow(this)" /> -->
                                                    <a href="{{route('deletecart', $data ->rowId )}}"
                                                        class="btn text-danger" role="button">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>

                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>

                                                <td colspan="3" style="text-align: end;" readonly>Net Total</td>
                                                <td>
                                                    <input type="hidden" value="{{Cart::subtotal()}}" name="net_total">
                                                    <p class="mb-0">৳ {{Cart::subtotal()}}</p>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>

                                                <td colspan="3" style="text-align: end;">Vat(5%)</td>
                                                @php
                                                    $net_total = (float)str_replace(',','',Cart::subtotal());
                                                    $vat = $net_total*5/100;
                                                    $total =  $net_total+$vat;
                                                @endphp
                                                <td>
                                                    <div class="input-group">
                                                        <input type="hidden" name="vat_amount" value="{{$vat}}">
                                                        <p class="mb-0">৳ {{$vat}}</p>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="text-align: end;">Discount</td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" step="0.1" name="discount_amount" class="form-control discoount_amount" value="0">
                                                    </div>

                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>

                                                <td colspan="3" style="text-align: end;">Total</td>
                                                <td>
                                                    <input type="number" class="form-control" name="total_amount" id="total_amount" value="{{round($total)}}" readonly>

                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>

                                                <td colspan="3" style="text-align: end;">Paid</td>
                                                <td>
                                                    <input type="number" step="0.1" value="0" name="paid_amount"
                                                        class="form-control paid_amount border-0" placeholder="Paid">
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="text-align: end;">Change Amount</td>
                                                <td>
                                                    <input type="number" step="0.1" value="0" name="change_amount" class="form-control change_amount border-0"
                                                        id="change_amount">
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="text-align: end;">Due</td>
                                                <td>
                                                    <input type="number" step="0.1" value="0" name="due_amount"
                                                        id="due_amount" class="form-control due_amount border-0"
                                                        placeholder="Due">
                                                </td>
                                                <td></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center pb-3 ">
                                <a href="{{route('pos_clear')}}" class="btn btn-danger" style="margin: 2px;">
                                    Cancel
                                </a>
                                <button class="btn text-light disabled" style="margin: 2px; background-color: #25aa9e;"
                                    type="submit" id="save">Pay Now</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>

@endsection
@push('custom_script')
<script>
$(document).ready(function() {
    $(document).on('change', '.QTY', function() {
        var i = 1;
        var i = $(this).parents('tr').attr('id');
        var qty = $('#quantity' + i).val();
        var price = $('#price' + i).val();
        var subtotal = price * qty;
        $('#subtotal' + i).val(subtotal);
        total();
    });
    $(document).on('keyup', '.search_med', function() {
        setInterval(function(){
            $('#s_m_submit').click();
        },1000)
    });

    $(document).on('change','.discoount_amount',function(){
        let discount = $(this).val();
        let total = $('#total_amount').val();
        let afterDiscount = total - discount;
        $('#total_amount').val(afterDiscount.toFixed());
    });

    $(document).on('change','.paid_amount',function()
    {
        var paid_amount = parseFloat($(this).val());
        var total = parseFloat($("#total_amount").val());
        if(paid_amount > 0){
            $('#save').removeClass("disabled");
        }
        if(total < paid_amount){
            var change = paid_amount - total;
            $("#change_amount").val(change.toFixed());
            $("#due_amount").val('0');
        }else{
            var due = total - paid_amount;
            $("#due_amount").val(due.toFixed());
            $("#change_amount").val('0');
        }
    });

});
</script>
@endpush
