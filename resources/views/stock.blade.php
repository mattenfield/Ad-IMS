@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Stock</h1>
    </br>
    </br>
    <div class="justify-content-center">
    <form action="{{url('stock')}}" method = "GET">
    <div class="form-group row">
                            <label for="inventoryID" class="col-md-4 col-form-label text-md-right">{{ __('Inventory') }}</label>
                            <select name="inventoryID">
                                <option <?=$selected0 ?? ''?>value="0">All</option>
                                <option <?=$selected1 ?? ''?>value="1">Technical Equipment</option>
                                <option <?=$selected2 ?? ''?>value="2">Costumes</option>
                                <option <?=$selected3 ?? ''?>value="3">Tools</option>
                                <option <?=$selected4 ?? ''?>value="4">Miscellaneous</option>
                        </select>
                        <button type="submit" style="margin:5px" class="btn btn-primary">
                                    {{ __('Load') }}
                        </button>
    </form>
                            
    </div>
    </div>
</br>
    <form action="/stock/search" method="GET">
        <div class="row justify-content-center">
            <input type="search" style="margin:5px; width:500px" name="search" placeholder ="Search Inventory" class="form-control">
           
                <button type = "submit" style="" class = "btn btn-primary justify-content-center"> Search </button>
            </span>
            
        </div>
    </form>

    <br/>
                        
    <div class="row justify-content-center">
 
        <div class = "row">
        <br/>
        <div class="col-md-12">
        <table class="table table-bordered">
        <tr>
            <th> Select </th>
            <th> ID </th>
            <th> Description </th>
            <th> Last Scanned </th>
            <th> Scanned By</th>
            <th> Actions </th>
        </tr>
            @foreach($items as $row)
            <tr>
                <td><input type="checkbox" id="{{$row['id']}}" name="{{$row['id']}}" value="{{$row['id']}}" ></td>
                <td>{{$row['id']}}</td>
                <td>{{$row['itemDescription']}}</td>
                <td>{{$row['itemLastScanned']}}</td>
                <td>{{$row['itemScannedBy']}}</td>
                <td><button class="btn-danger" href="/stock/delete/{{$row['id']}}">Delete</button></td>
            </tr>
            @endforeach
        </div>
    </div>
</div>
@endsection