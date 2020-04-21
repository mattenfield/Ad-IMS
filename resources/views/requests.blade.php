@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Expenses Claims</h1>
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
    <form action="{{url('requests')}}" method = "GET">
    <div class="form-group row">
                            <label for="approval" class="col-md-4 col-form-label text-md-right">{{ __('Filter Requests') }}</label>
                            <select name="approval">
                                <option <?=$selected0 ?? ''?>value="0">All</option>
                                <option <?=$selected1 ?? ''?>value="1">Declined</option>
                                <option <?=$selected2 ?? ''?>value="2">Approved</option>
                                <option <?=$selected3 ?? ''?>value="3">Pending</option>
                        </select>
                        <button type="submit" style="margin:5px" class="btn btn-primary">
                                    {{ __('Load') }}
                        </button>
    </form>
                            
    </div>
    </div>
</br>
    <form action="/requests/search" method="get">
        <div class="row justify-content-center">
            <input type="search" style="margin:5px; width:500px" name="search" placeholder ="Search Requests" class="form-control">
           
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
            <th> Evidence </th>
            <th> Item Description </th>
            <th> Inventory </th>
            <th> Request Time </th>
            <th> Request By </th>
            <th> Status </th>
            <th> Actions </th>
        </tr>
            @csrf
            @foreach($requests as $row)
            <?php 
            if($row['inventoryID']==1)
            {
                $inventory = "Technical Equipment";
            }
            else if($row['inventoryID']==2)
            {
                $inventory = "Costumes";
            }
            else if($row['inventoryID']==3)
            {
                $inventory = "Tools";
            }
            else if($row['inventoryID']==4)
            {
                $inventory = "Miscellaneous";
            }
            else{
                $inventory = "Not for Upload.";
            }

            if($row['approved']==1)
            {
                $approval = "Approved";
            }
            else if($row['approved']===0){
                $approval = "Declined";
            }
            else{
                $approval = "Pending";
            }
            ?>
            <tr> 
                <td><img style = "max-width: 500px; max-height: 500px;" src="https://adims.s3.eu-west-2.amazonaws.com/{{$row['photoEvidenceUploadLink']}}" alt="Evidence Image not found." ></td>
                <td>{{$row['itemDescription']}}</td>
                <td><?=$inventory?></td>
                <td>{{$row['created_at']}}</td>
                <td>{{$row['requestbyname']}}</td>
                <td><?=$approval?></td>
                <td>
                @if($row['approved']===null&&$auth_level==1)<a style="margin:5px;" class="btn btn-success" onclick="return confirm('Are you sure you wish to approve this?')" href="/requests/approve/{{$row['id']}}">Approve</a> <br/>
                <a style="margin:5px;" class="btn btn-warning" onclick="return confirm('Are you sure you wish to decline this?')" href="/requests/decline/{{$row['id']}}">Decline</a>
                    @endif
                <a style="margin:5px;" class="btn btn-danger delete" onclick="return confirm('Are you sure you wish to delete this?')" href="/requests/delete/{{$row['id']}}">Delete</a
                ></td>
            </tr>
            @endforeach
            </table>
            {{ $requests->links() }}
        </div>
        
    </div>
</div>
@endsection