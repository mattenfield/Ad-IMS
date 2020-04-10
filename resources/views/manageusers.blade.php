@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Users</h1>
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
        <br/>
    <div class="row justify-content-center">
    
        <div class="col-md-8">
        </br>
    <form action="{{route('managesearch')}}" method="get">
        <div class="row justify-content-center">
            <input type="search" style="margin:5px; width:500px" name="search" placeholder ="Search Users" class="form-control">
           
                <button type = "submit" style="" class = "btn btn-primary justify-content-center"> Search </button>
            </span>
            
        </div>
    </form>
    <br/>
                    
    <div class="row justify-content-center">

        <div class = "row">
        <br/>
        <div class="col-md-12">
        <a style="margin:5px" href="/manageusers/create" class = "btn btn-primary">Create New User </a>
        <br/>
        <table class="table table-bordered">
        <tr>
            <th> Email </th>
            <th> Name </th>
            <th> Actions </th>
        </tr>
            @csrf
            @foreach($users as $row)
            <tr> 
                <td>{{$row['email']}}</td>
                <td>{{$row['name']}}</td>
                <td><a style="margin:5px" class="btn btn-primary" href="/manageusers/edit/{{$row['id']}}">Edit</a><br/>
                <a style="margin:5px" class="btn btn-danger delete" onclick="return confirm('Are you sure you wish to delete this?')" href="/manageusers/delete/{{$row['id']}}">Delete</a> 
                </td>
            </tr>
            @endforeach
            </table>
            {{ $users->links() }}
        </div>
        
    </div>
        </div>
    </div>
</div>
@endsection
