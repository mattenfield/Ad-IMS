@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="font-size:60px;">Welcome to your dashboard, {{Auth::user()->name}}.</h1>
    </br>
    
    <div class="row justify-content-center">
    <h4 style="text-align:center;">New Users are reminded to reset their password on first login. <br/><a style ="font-weight:bold;"href="{{url('changepassword')}}"> Click here </a> to change your password.</h4>
      <img src="dashboard_img.jpg" width="600" height="400px" >
    </div>
    </br>
    @if($auth_level==1)
    <h4 style="font-weight: bold;text-align:center;">Administration Portal: Full Functionality</h4> 
    @endif

    @if($auth_level==0)
    <h4 style="font-weight: bold;text-align:center;">You can make Expense Requests and view our Stock Inventory.</h4> 
    @endif
    </br>
    <div class="row justify-content-center">
            <div style="font-size: 30px; text-align:center;" class="col-sm-3">
              <h1 style="font-size:100px;">{{$itemcount ?? ''}}</h1>
                <a href="/stock">Total Items</a>
            </div>
            @if($auth_level==1)
            <div style="font-size: 30px; text-align:center;" class="col-sm-3">
              <h1 style="font-size:100px;">{{$missingitemscount ?? ''}}</h1>
              <a href="/stock/missing">Missing Items</a>
            </div>
            @endif
            <div style="font-size: 30px; text-align:center;" class="col-sm-3">
              <h1 style="font-size:100px;">{{$requestcount ?? ''}}</h1>
              <a href="/requests"> Requests</a>
            </div>

@endsection
