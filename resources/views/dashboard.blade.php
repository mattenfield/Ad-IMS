@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="font-size:60px;">Welcome to your dashboard, {{Auth::user()->name}}.</h1>
    </br>
    <div class="row justify-content-center">
      <img src="dashboard_img.jpg" width="600" height="400px" >
    </div>
    </br>
    <p style="font-weight: bold;text-align:center;">In order to add an item, please select Stock > Add Items and enter the relevant information.</p> 
    </br>
    <div class="row justify-content-center">
            <div style="font-size: 30px; text-align:center;" class="col-sm-3">
              <h1 style="font-size:100px;">{{$itemcount}}</h1>
                <a href="/stock">Total Items</a>
            </div>
            <div style="font-size: 30px; text-align:center;" class="col-sm-3">
              <h1 style="font-size:100px;">{{$missingitemscount}}</h1>
              <a href="/stock/missing">Missing Items</a>
            </div>
            <div style="font-size: 30px; text-align:center;" class="col-sm-3">
              <h1 style="font-size:100px;">{{$requestcount}}</h1>
              <a href="/requests"> Requests</a>
            </div>

@endsection
