@extends('layouts.app')

@section('content')

  
   <div class="container">
     <div class="row">
        <div class="col">
            @foreach ($data as $item)
            <div class="card mt-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                         <img src="{{$item->image}}" width="300" height="250">
                        </div>
                        <div class="col-sm-6">
                            <h4 class="alert alert-success">{{$item->title}}</h4>
                            <ul class="list-unstyled">
                                <li class="p-2"> <h4>{{$item->ingredients[0]}}</h4> </li>
                                <li class="text-dark" style="font-size: medium;">{{$item->description}}</li>
                                <li class="p-2"> <small>Address Jeddah Khaled ibn Alawalid St</small> </li>
                            </ul>
                        </div>
                        {{-- <div class="col-sm-3">
                            <ul class="list-unstyled p-2">
                                <li class="badge bg-success " style="font-size: medium;"> price :{{$item->price}} SAR</li>
                                <li class=""> <span>Tax : {{$item->tax}}%</span> </li>
                                <li class=""> <small>Total {{$item->total}} SAR</small> </li>
                                <li class=""> <small><p> Descount: <del> {{$item->descount}} SAR</del></p> </small> </li>
                                <li class=""> <small>Net : {{$item->net}} SAR </small> </li>
                               
                            </ul>
                            <div class="row">
                                <div class="col">
                                    <a href="/shopping/showdetails/{{$item->id}}" class="btn btn-primary">Show Details >></a>
                                </div>
                            </div>
                        </div> --}}
                        
                    </div>   
                </div>
            </div>
            @endforeach
            
        </div>
     </div>
   </div>

@endsection