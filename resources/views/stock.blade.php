@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Stock</h1>
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
    <form action="/stock/search" method="get">
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
        <form action="{{url('stock/print')}}" method="post">
        <table class="table table-bordered">
        <tr>
        @if($auth_level==1) <th> Select </th> @endif
            <th> Image </th>
            <th> ID </th>
            <th> Description </th>
            <th> Last Scanned </th>
            <th> Scanned By</th>
            @if($auth_level==1) <th> Actions </th> @endif
        </tr>
            @csrf
            @foreach($items as $row)
            <tr> 
            @if($auth_level==1) <td><input type="checkbox" name="printcheck[]" value="{{$row['id']}}" ></td> @endif
                <td><img style = "width: 200px; height: 200px;" src="https://adims.s3.eu-west-2.amazonaws.com/{{$row['photoUploadLink']}}" alt="Photo not Uploaded." ></td>
                <td>{{$row['id']}}</td>
                <td>{{$row['itemDescription']}}<input type ="hidden" name="description[]" value="{{$row['itemDescription']}}"></td>
                <td>{{$row['itemLastScanned']}}</td>
                <td>{{$row['itemScannedBy']}}</td>
            @if($auth_level==1)    <td><a style="margin:5px" class="btn btn-primary" href="/stock/edit/{{$row['id']}}">Edit</a><br/>
            <a class="btn btn-danger delete" onclick="return confirm('Are you sure you wish to delete this?')" href="/stock/delete/{{$row['id']}}">Delete</a></td> @endif
            </tr>
            @endforeach
            </table>
            {{ $items->links() }}
            @if($auth_level==1)
            <button type="submit" style="margin:5px" class="btn btn-primary">
                {{ __('Print Selected QR(s)') }}
            </button>
            
            <a href="/stock/printall" style="margin:5px" class="btn btn-primary">
                {{ __('Print All QRs') }}
            </a>
            </form>
            @endif
        </div>
        
    </div>
</div>
@endsection

