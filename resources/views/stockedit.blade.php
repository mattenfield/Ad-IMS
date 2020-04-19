@extends('layouts.app')

@section('content')

<div class="container">
<h1>Stock > Edit</h1>
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
                <div class="card-header">{{ __('Edit this Stock Item') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{url('stock/edit/store').'/'.$item['id']}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="inventoryID" class="col-md-4 col-form-label text-md-right">{{ __('Inventory') }}</label>
                            
                            <select name="inventoryID">
                                <option <?=$selected1 ?? ''?>value="1">Technical Equipment</option>
                                <option <?=$selected2 ?? ''?>value="2">Costumes</option>
                                <option <?=$selected3 ?? ''?>value="3">Tools</option>
                                <option <?=$selected4 ?? ''?>value="4">Miscellaneous</option>
                            
                        </select>
                            
                        </div>

                        <div class="form-group row">
                            <label for="itemDescription" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            
                            <textarea  id="itemDescription" name = "itemDescription" rows="4" cols="26" value ="{{$item['itemDescription']}}" required>{{$item['itemDescription']}}</textarea>
                            
                        </div>
                        @if($item['photoUploadLink'])
                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>

                            
                            <img style = "width: 200px; height: 200px;" src="https://adims.s3.eu-west-2.amazonaws.com/{{$item['photoUploadLink']}}" alt="Photo not Uploaded." >
                            
                        </div>
                        @endif
                        <div class="form-group row">
                            <label for="select_file" class="col-md-4 col-form-label text-md-right">{{ __('Upload New Photo') }}</label>

                            
                            <input  type="file" name = "select_file">
                            
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
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