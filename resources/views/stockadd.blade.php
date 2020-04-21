@extends('layouts.app')

@section('content')

<div class="container">
<h1><a href="{{url('stock')}}">Stock</a> > Add</h1>
</br>
        @if(count($errors) > 0)
        <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        </div>
        @endif
        @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{\Session::get('success')}}</p>
        </div>
        @endif
    </br>
 
    <div class="row justify-content-center">
      
        <div class="col-md-8">
        <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add a new Stock Item') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{url('stock')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="inventoryID" class="col-md-4 col-form-label text-md-right">{{ __('Inventory') }}</label>
                            
                            <select name="inventoryID">
                                <option value="1">Technical Equipment</option>
                                <option value="2">Costumes</option>
                                <option value="3">Tools</option>
                                <option value="4">Miscellaneous</option>
                            
                        </select>
                            
                        </div>

                        <div class="form-group row">
                            <label for="itemDescription" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            
                            <textarea  id="itemDescription" name = "itemDescription" rows="4" cols="26" required></textarea>
                            
                        </div>
                        <div class="form-group row">
                            <label for="select_file" class="col-md-4 col-form-label text-md-right">{{ __('Upload Photo') }}</label>

                            
                            <input  type="file" name = "select_file">
                            
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Items') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>
@endsection