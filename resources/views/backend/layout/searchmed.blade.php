@extends('backend.layout.pos')
@section('content')

@foreach($adpurchase as $key=> $subpurchase)
<div class="col-lg-3 col-md-4 col-sm-6 mb-2" style="padding: 4px">
    <div class="card">
        <img class="card-img-top mb-2 " src="{{asset('/uploads/medicine/'.$subpurchase->medicine->image)}}" alt="image"
            style="height: 100px">
        <div class="card-body text-center" style="padding: 0.2rem">
            <h6 class="card-title " style="font-size: inherit;">
                {{$subpurchase->medicine->name}}
            </h6>
            <a href="{{route('addtocart',$subpurchase->id)}}" class="stretched-link " style="text-decoration: none;">
                <h6 class="text-primary" style="font-size: inherit;">৳ {{$subpurchase->price}}</h6>
            </a>
        </div>
    </div>
</div>
@endforeach


@endsection