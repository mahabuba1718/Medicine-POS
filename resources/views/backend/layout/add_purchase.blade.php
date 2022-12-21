@extends('backend.master')
@section('content')
<div class="container-fluid px-0">
    <section class="section container-fluid my-3">
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
                <div class="m-2">/</div>
                <div class="m-2">
                    <a href="{{route('add_purchase')}}">Add Purchase</a>
                </div>
            </div>
        </div>
        <div class="section-body container-fluid">
            <div class="row ">
                <div class="col-lg-12">
                    <div class="card" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                        <input type="hidden" id="last_row" value="1">
                        <form method="POST" action="{{route('adpurchase')}}">
                            @csrf
                            <div class="card-header p-3">
                                <h4>Add Purchase</h4>
                            </div>
                            <div class="card-body">
                                <div class="row p-2">
                                    <div class="form-group col-lg-3 mb-3">
                                        <label for="date" class="mb-2">
                                            Date
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <input class="form-control" type="text" name="date" id="date" value="{{old('date') ?? \Carbon\Carbon::today()->format("Y-m-d")}}" readonly/>
                                        <span class="text-danger"> @error('date') {{$message}} @enderror</span>
                                    </div>
                                    <div class="form-group col-lg-3 mb-3">
                                        <label for="time" class="mb-2">
                                            Time
                                            <strong class="text-danger"> </strong>
                                        </label>
                                        <input class="form-control" type="text" name="time" id="time" value="{{old('date') ?? \Carbon\Carbon::now()->format("h:i A")}}" readonly />
                                        <span class="text-danger"> </span>
                                    </div>
                                    <div class="form-group col-lg-3 mb-3">
                                        <label for="supplier" class="mb-2">
                                            Supplier
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <select class="form-select" for="supplier" name="supplier" id="supplier">
                                            <option value="" disable hidden>Select One</option>
                                            @foreach($supplier as $supplied)
                                            <option value="{{$supplied->id}}">{{$supplied->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">@error('supplier') {{$message}} @enderror </span>
                                    </div>

                                    <div class="form-group col-lg-3 mb-3">
                                        <label for="purchase_no" class="mb-2">
                                            Purchase No.
                                            <strong class="text-danger">*</strong>
                                        </label>
                                        <input type="text" class="form-control" name="purchase_no"
                                            placeholder="PO-01" id="purchase_no" value="{{$purchase_code}}" readonly>
                                        <span class="text-danger"> </span>
                                    </div>
                                </div>
                            </div>

                            <div class="container-fluid">
                                <div class="card-header d-flex p-2">
                                    <h4>Purchase Medicine</h4>

                                </div>
                                <div class="card-body">
                                    <div class=" table_section p-3">
                                        <table id="table1" class="table table-bordered text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="" width="5%">#</th>
                                                    <th scope="col" class="" width="25%">Medicine</th>
                                                    <th scope="col" class="" width="18%">Expiry Date</th>
                                                    <th scope="col" class="" width="10%">Alert</th>
                                                    <th scope="col" class="" width="11%">Price</th>
                                                    <th scope="col" class="" width="11%">Quantity</th>
                                                    <th scope="col" class="" width="11%">Sub Total</th>
                                                    <th scope="col" class="" width="9%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="dynamicAddRemove">
                                                <tr id="1">
                                                    <td colspan="1" class="tbl_id">1</td>
                                                    <td colspan="1" class="">
                                                        <select class="form-select medicine" name="medicine[]" id="medicine1">
                                                            <option selected>Select One</option>
                                                            @foreach($admedicine as $key => $medicine)
                                                            <option value="{{$medicine->id}}">{{$medicine->medicine->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td colspan="1" class="">
                                                        <input class="form-control" type="date" for="expire_date" name="expire_date[]" id="expire_date1" required/>
                                                    </td>
                                                    <td colspan="1" class="">
                                                        <div class="input-group">
                                                        <label for="alert_id" class="mb-2"></label>
                                                            <input type="number" name="alert_id[]" id="alert_id1" placeholder="Alert" class="form-control alert_id">
                                                        </div>
                                                    </td>
                                                    <td colspan="1">
                                                        <div class="input-group">
                                                        <label for="price" class="mb-2"></label>
                                                            <input type="number" id="price1" name="price[]" class="form-control total_amount" value="0" readonly>
                                                        </div>
                                                    </td>
                                                    <td colspan="1">
                                                        <div class="input-group">
                                                        <label for="quantity" class="mb-2"></label>
                                                            <input type="number" step="1" min="1" id="quantity1" name="quantity[]" class="form-control QTY" value="0">
                                                        </div>
                                                    </td>
                                                    <td colspan="1">
                                                        <input type="number" step="0.1" min="0.1" id="sub_total1" name="sub_total[]" class="form-control sub_total border-0" value="0" readonly>
                                                    </td>
                                                    <td colspan="1">
                                                    <button type="button" name="add" id="add-btn" class="btn btn-sm text-light" style="background-color:#25aa9e;"><i class="fa-sharp fa-solid fa-circle-plus"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td colspan="6" style="text-align: end;" >Net Total</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="number" min="1" name="net_total" id="net_total"
                                                                class="form-control net_total" readonly>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr >
                                                    <td colspan="6" style="text-align: end;" >Vat(5%)</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="number" min="0" name="vat"
                                                            id="vat" class="form-control vat" value="" readonly>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" style="text-align: end;" >Discount(Taka)</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <input type="text" name="discount_amount" id="discount_amount"
                                                                class="form-control discount_amount" value="">
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" style="text-align: end;" >Total</td>
                                                    <td>
                                                        <input type="number" step="0.1" min="0.1" name="total_amount" id="total_amount"
                                                            class="form-control total_amount border-0" value="" readonly>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr >
                                                    <td colspan="6" style="text-align: end;" >Paid</td>
                                                    <td>
                                                        <input type="number" step="1" min="1" name="paid_amount"
                                                            class="form-control paid_amount" id="paid_amount">
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr >
                                                    <td colspan="6" style="text-align: end;" >Change Amount</td>
                                                    <td>
                                                        <input type="number" step="0" min="0" name="change_amount"
                                                        id="change_amount" class="form-control change_amount border-0" readonly>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <tr >
                                                    <td colspan="6" style="text-align: end;" >Due</td>
                                                    <td>
                                                    <input type="number" step="0" min="0" name="due_amount" id="due_amount"
                                                            class="form-control due_amount border-0" readonly>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="form-group col-lg-12 p-2" >
                                            <label for="description" class="mb-2" >
                                                Description
                                                <strong class="text-danger"> </strong>
                                            </label>
                                            <textarea class="form-control mb-4" for="description" name="description" id="description"
                                                placeholder="Please add details, about the Purchase"></textarea>
                                            <span class="text-danger"> </span>
                                        </div>
                                        <tfoot>
                                            <div class="card-footer text-center">
                                                <button class="btn text-light disabled" id="save" style="background-color:#25aa9e;"
                                                    type="submit">
                                                    Save Changes
                                                </button>
                                            </div>
                                        </tfoot>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>

<script type="text/javascript">

</script>
<script>
    $(document).ready(function(){
        // var j = $(".tbl_id").attr('id');
        var i = 1;
        $("#add-btn").click(function()
        {
        ++i;
        $("#dynamicAddRemove").append('\
            <tr id="'+[i]+'">\
                <td colspan="1" class="tbl_id">'+[i]+'</td>\
                <td colspan="1" class="">\
                    <select class="form-select medicine" name="medicine[]" id="medicine'+[i]+'">\
                        <option selected>Select One</option>\
                        @foreach($admedicine as $key => $medicine)\
                        <option value="{{$medicine->id}}">{{$medicine->medicine->name}}</option>\
                        @endforeach\
                    </select>\
                </td>\
                <td colspan="1" class="">\
                    <input class="form-control" type="date" for="expire_date" name="expire_date[]" id="expire_date'+[i]+'" required />\
                </td>\
                <td colspan="1" class="">\
                    <div class="input-group">\
                    <label for="alert_id" class="mb-2"></label>\
                        <input type="text" name="alert_id[]" id="alert_id'+[i]+'" placeholder="Alert" class="form-control alert_id">\
                    </div>\
                </td>\
                <td colspan="1">\
                    <div class="input-group">\
                    <label for="price" class="mb-2"></label>\
                        <input type="number" step="0.1" min="0.1" id="price'+[i]+'" name="price[]" class="form-control total_amount" value="0" readonly>\
                    </div>\
                </td>\
                <td colspan="1">\
                    <div class="input-group">\
                    <label for="quantity" class="mb-2"></label>\
                        <input type="number" step="1" min="1" id="quantity'+[i]+'" name="quantity[]" class="form-control QTY" value="0">\
                    </div>\
                </td>\
                <td colspan="1">\
                    <input type="number" step="0.1" min="0.1" id="sub_total'+[i]+'" name="sub_total[]" class="form-control sub_total border-0" value="0" readonly>\
                </td>\
                <td colspan="1">\
                    <button type="button" class="btn btn-danger remove-tr"><i class="fa-sharp fa-solid fa-circle-minus"></i></button>\
                </td>\
            </tr>\
        ');
        $('#last_row').val(i);
        });
        $(document).on('click', '.remove-tr', function()
        {
            $(this).parents('tr').remove();
            i--;
            $('#last_row').val(i);
            total();
        });

        $(document).on('change','.medicine',function()
        {
            var i = $(this).parents('tr').attr('id');
            var $option = $(this).find('option:selected');
            var value = $option.val();
            $.ajax({
                type: "GET",
                url: "/purchase/find_med/" + value,
                success: function(response) {
                    $('#price'+i).val(response.med.purchaseprice);
                }
            });

        });

        $(document).on('change','.QTY',function()
        {
            var i = $(this).parents('tr').attr('id');
            var qty = $('#quantity'+i).val();
            var price = $('#price'+i).val();
            var subtotal = price * qty;
            $('#sub_total'+i).val(subtotal);
            total();
        });

        function total(){
            var j = $('#last_row').val();
            var netTotal = 0;
            for (let i = 1; i <= j; i++)
            {
                var subTotal = $('#sub_total'+i).val();
                netTotal += parseInt(subTotal);
            }
            $('#net_total').val(netTotal);

            var vat = (netTotal*5)/100;
            $("#vat").val(vat);

            var discount = 0;
            $("#discount_amount").val(discount);
            var total = (netTotal + vat) - discount;
            $("#total_amount").val(total.toFixed());

        }

        $(document).on('change','#discount_amount',function()
        {
            var discount = $(this).val();
            var net_total = $("#net_total").val();
            var vat = $("#vat").val();
            var total = (parseFloat(net_total) + parseFloat(vat)) - discount;
            $("#total_amount").val(total.toFixed());
        });

        $(document).on('change','#paid_amount',function()
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

@endsection
