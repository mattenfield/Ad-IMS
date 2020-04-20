@extends('layouts.app')

@section('content')

<div class="container">
<h1>Stock > Stock Check</h1>
</br>
        @if(\Session::has('error'))
        <div class="alert alert-danger">
            <p>{{\Session::get('error')}}</p>
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
        <div style="text-align:center;" class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Check Stock') }}</div>

                <div class="card-body">
                    <form method="post" action="{{url('stock/checkitem')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="qrCode" class="col-md-4 col-form-label text-md-right">{{ __('QR Code') }}</label>

                            
                            <input  style="margin : 0 auto;" type="text" id="qrCode" name = "qrCode" rows="4" cols="26" required>
                            
                        </div>
                        <div class="form-group row mb-0 ">
                            <div class="col-md-6 offset-md-4 justify-content-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                    </form>
                            </div>
                        </div>
                        <br/><br/>
                        <p style="text-align:center;">Once you have completed your Stock Check for an inventory. Please select the correct inventory used and complete.</p>
                    <form action = "{{url('stock/take/complete')}}" method = "POST">
                        @csrf
                        <div class="form-group row">
                            <label for="inventoryID" class="col-md-4 col-form-label text-md-right">{{ __('Inventory') }}</label>
                            
                            <select  style="margin : 0 auto;" name="inventoryID">
                                <option value="1">Technical Equipment</option>
                                <option value="2">Costumes</option>
                                <option value="3">Tools</option>
                                <option value="4">Miscellaneous</option>
                            
                        </select>
                            
                        </div>
                    
                        <div class="form-group row mb-0 ">
                            <div class="col-md-6 offset-md-4 justify-content-center">
                                <button type="submit" onclick="confirm('Are you sure you want to complete this Stock Take?')"class="btn btn-success">
                                    {{ __('Complete') }}
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