@extends('backend.master')
@section('content')
<style>
       .image__overlay{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            color: #ffffff;
            font-family: 'Quicksand', sans-serif,;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.25s;
       }    
       .image__overlay:hover{
        opacity: 1;
       } 
</style>

<div class="container-fluid px-0">
    <section class="section p-3">
        <div class="section-header d-flex p-3">
            <h2 class="mt-3">POS</h2>
            <div class="section-header-breadcrumb d-flex p-3">
                <div class="breadcrumb-item m-2 ">
                    <a href="{{route('dashboard')}}">Home</a>
                </div>
                <div class="m-2">/</div>
                <div class="m-2">
                    <a href="{{route('possale')}}">POS Sale</a>
                </div>
                <div class="m-2">/</div>
                <div class="m-2">
                    <a href="{{route('medicine')}}">Medicine</a>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row d-flex">
                <div class="col-lg-6" style="padding: 0px">
                    <form action="">
                        <input type="hidden" name="purchase" value="">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="from-group">
                                    <input class="form-control mb-3" type="text" placeholder="Enter Medicine Name"
                                        name="medicine_name">
                                    <div class="row pos_div">
                                        @foreach($medicines as $medicine)
                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-2" style="padding: 4px;">
                                            <div class="card">
                                            <div class="image">
                                                @if($medicine->image != null)
                                                
                                                <img class="card-img-top mb-2 "
                                                    src="{{asset('/uploads/medicine/'.$medicine->image)}}" alt="image"
                                                    style="height: 100px">
                                                    <div class="image__overlay">
                                                        <div class="image__title">Bricks</div>
                                                    </div>
                                                </div>
                                                    
                                                @endif
                                                <div class="card-body text-center" style="padding: 0.2rem;">
                                                    <h6 class="card-title ">
                                                        {{$medicine->name}}
                                                    </h6>
                                                    <a href="{{route('addtocart',$medicine->id)}}" class="stretched-link" style="text-decoration: none;"><h6>৳ {{$medicine->price}}</h6></a>
                                                </div>
                                                <!-- <div class="card-body text-center" style="padding: 0.2rem;">
                                                <h6 class="card-footer ">
                                                    {{$medicine->price}}
                                                </h6>
                                            </div> -->
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="col-lg-6 " style="padding: 0px">
                    <form action="" method="post">

                        <div class="card">
                            <div class="card-header">
                                <div class="form-group">
                                    <select name="contact_id" id="contact_id" class="form-control">
                                        <option value="1">Walk In Customer</option>
                                        <option value="2">Customer</option>
                                        <option value="4">Mahabuba</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table ">
                                    <table id="table1" class="table table-bordered pos_table table_reduced">
                                        <thead>
                                            <tr style= "text-align: center;">
                                                <th scope="col" width="35%" >Medicine</th>
                                                <th scope="col" width="15%">QTY</th>
                                                <th scope="col" width="15%">Price</th>
                                                <th scope="col" width="20%">Sub Total</th>
                                                <th scope="col" width="15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            @foreach($pos as $data)
                                            <tr>
                                                <td><img src="{{asset('/uploads/medicine/'.$data->options->image)}}" alt="image" style="height: 40px">   {{$data->name}}</td>

                                                <td colspan="1">
                                                    <div class="input-group">
                                                        <input type="number" step="1" min="1" name="quantity" value="{{$data->qty}}"
                                                            class="form-control vat_amount">
                                                    </div> 
                                                </td>

                                                <td colspan="1">
                                                    <div class="input-group">
                                                        <input type="number" step="0.1" min="0.1" name="price" value="{{$data->price}}"
                                                            class="form-control vat_amount">
                                                    </div>
                                                </td>
                                                @php
                                                   $total = $data ->price*$data ->qty
                                                @endphp
                                                <td colspan="1">
                                                  
                                                        <p>{{$total}}</p>
                                                </td>
                                                <td colspan="1">
                                                    <input type="button" value=" - "
                                                        class="text-light border-0 m-2 bg-danger  rounded-2"
                                                        onclick="ob_adRows.delRow(this)" />
                                                    <!-- <i class="fa-solid fa-trash"></i> -->

                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr>

                                                <td colspan="3" style="text-align: end;">Net Total</td>
                                                <td>
                                                    <div class="input-group">
                                                        <!-- <input type="number" readonly value="0" name="net_total" 
                                                            class="form-control sub_total border-0"
                                                            placeholder="Net Total"> -->
                                                            <p>{{Cart::subtotal()}}</p>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>

                                                <td colspan="3" style="text-align: end;">Vat</td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" min="0.1" name="net_total"
                                                            class="form-control vat_amount">
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="text-align: end;">Discount</td>
                                                <td>
                                                    <div class="input-group">
                                                        <input type="number" step="0.1" min="0.1" name="discount_amount"
                                                            class="form-control discoount_amount">
                                                    </div>
                                                    
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                               
                                                <td colspan="3" style="text-align: end;">Total</td>
                                                <td>
                                                    <input type="number" step="0.1" value="0" readonly
                                                        name="total_amount" name="total_amount"
                                                        class="form-control total_amount border-0" placeholder="Total">
                                                       
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="text-align: end;">Paid</td>
                                                <td>
                                                    <input type="number" step="0.1" value="0" readonly
                                                        name="paid_amount" name="paid_amount"
                                                        class="form-control paid_amount border-0" placeholder="Paid">
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="text-align: end;">Change Amount</td>
                                                <td>
                                                    <input type="number" step="0.1" value="0" readonly
                                                        name="change_amount" name="change_amount"
                                                        class="form-control change_amount border-0"
                                                        placeholder="change_amount">
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" style="text-align: end;">Due</td>
                                                <td>
                                                    <input type="number" step="0.1" value="0" readonly name="due_amount"
                                                        name="due_amount" class="form-control due_amount border-0"
                                                        placeholder="Due">
                                                </td>
                                                <td></td>
                                            </tr>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center pb-3 ">
                                <a href="#" class="btn btn-danger" style="margin: 2px;">
                                    Cancel
                                </a>
                                <button class="btn btn-success" style="margin: 2px;" type="submit">Pay Now</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
//JS class to add/delete rows in html table - https://coursesweb.net/javascript/ 
//receives table id
function adRowsTable(id) {
    var table = document.getElementById(id);
    var me = this;
    if (document.getElementById(id)) {
        var row1 = table.rows[1].outerHTML;

        me.delRow = function(btn) {
            btn.parentNode.parentNode.outerHTML = '';
            setIds();
        }
    }
}

//create object of adRowsTable(), pass the table id
var ob_adRows = new adRowsTable('table1');
</script>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
</script>

@endsection