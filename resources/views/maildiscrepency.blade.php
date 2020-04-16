Hi,
<br/>
<p>You have just completed a Stock Check, and the following items were classed as missing:
<br/> @foreach($missingitems as $row)
<br/> ID({{$row['id']}}): {{$row['itemDescription']}}
      @endforeach
      
<br/><br/>
To view items missing follow this link {{url('stock/missing')}}
<br/><br/><br/>
Kind regards, 
<br/> 
AD-IMS Administration
<br/>
</p>