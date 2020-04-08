@extends('layouts.app')

@section('content')
<script language="JavaScript">
    window.print();
</script>
<div class="container">
    <h1>Print Stock</h1>
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
 
        <div class = "row">
        <br/>
        <div class="col-md-12">
        <table class="table table-bordered">
        <tr>
            <th> QR Code </th>
        </tr>
            @csrf
            @foreach($items as $row)
            <tr> 
                <td>{!! QrCode::size(200)->generate("".$row); !!}<br/> <p style="text-align:center;">{{$row}}</p></td>
            </tr>
            @endforeach
            </table>
        </div>
        
    </div>
</div>
@endsection

