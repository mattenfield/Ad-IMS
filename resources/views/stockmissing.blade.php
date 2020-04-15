@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Missing Stock</h1>
    </br>
        @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div>
        @endif
        @if(\Session::has('error'))
        <div class="alert alert-danger">
            <p>{{\Session::get('error')}}</p>
        </div>
        @endif

    </br>
    <div class="row justify-content-center">
        
        <div class="col-md-8">
        <div class="row justify-content-center">
        <h5 style="text-align:center;">{{$alertmessage}}</h5>
        
 <div class = "row">
 <br/>
 <div class="col-md-12">
 <br/><br/>
 <table class="table table-bordered">
 <tr>
     <th> ID </th>
     <th> Description </th>
     <th> Actions </th>
 </tr>
     @foreach($missingitems ?? '' as $row)
     <tr>
         <td>{{$row['id']}}</td>
         <td>{{$row['itemDescription']}}</td>
         <td><a class="btn btn-success delete" onclick="return confirm('Are you sure you have found this?')" href="/stock/found/{{$row['id']}}">Found</a></td>
     </tr>
     @endforeach
     </table>
     @if(!isset($linkcheck))
     {{ $missingitems->links() }}
     @endif
 </div>
</div>
        </div>
    </div>
</div>
@endsection