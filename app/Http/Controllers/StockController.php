<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\MissingItems;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   if(isset($_GET['inventoryID']))
        {
            $data['id'] = $_GET['inventoryID'];

            if($data['id']==1)
            {
                $data['selected1']="selected='selected'";
            }
            else if($data['id']==2)
            {
                $data['selected2']="selected='selected'";
            }
            else if($data['id']==3)
            {
                $data['selected3']="selected='selected'";
            }
            else if($data['id']==4)
            {
                $data['selected4']="selected='selected'";
            }
            else{

            }
        }
        else{
            $data['id'] = 0;
            $data['selected0']="selected='selected'";
        }
        
        

        if($data['id'])
        {
            $data['items'] = Item::where('inventoryID', $data['id'])->Paginate(5);
            return view('stock', $data);
            
        }
        else{
           
            $data['items'] = Item::Paginate(5);
            return view('stock', $data);
        }
       
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stockadd');
    }

    public function take()
    {
        
        return view('stocktake');

    }

    public function checkitem(Request $request)
    {
        $user = auth()->user();
        $checkitem = Item::where('id',$request->get('qrCode'))->first();



        if($checkitem==null){
            return redirect()->route('stocktake')->with('error','Stock was not found');
        }
        else{
            $checkitem->itemScannedBy = $user->name;
            $checkitem->itemlastScanned = gmdate('Y-m-d'); 
            $checkitem->save();
            return redirect()->route('stocktake')->with('success','Stock was found');
        }
        
        
    }
    public function mobiletake($id)
    {
        if($id==null)
        {
            return redirect()->route('stock')->with('error','You have not scanned an item.');
        }
        $user = auth()->user();
        $checkitem = Item::where('id',$id)->first();

        if($checkitem==null){
            return redirect()->route('stocktake')->with('error','Stock was not found');
        }
        else{
            $checkitem->itemScannedBy = $user->name;
            $checkitem->itemlastScanned = gmdate('Y-m-d'); 
            $checkitem->save();
            return redirect()->route('stocktake')->with('success','Stock was found');
        
            }
}

    public function completestocktake(Request $request)
    {
        
        $data['missingitems'] = Item::where('itemlastScanned','!=', gmdate('Y-m-d'))->where('inventoryID',$request->get('inventoryID'))->Paginate(5);
        $data['alertmessage'] = "These are the missing items from the stock check you have just completed, if found - press the found button on the corresponding items.";

        if(count($data['missingitems'])>0){
            
            $check=array();

            foreach($data['missingitems'] as $m)
            {
                $check = MissingItems::where('id', $m['id'])->Paginate(5);
            }
        
            if(count($check)>0)
            {
                return view('stockmissing', $data);
            }
            else{
                foreach ($data['missingitems'] as $m){
                    $newmissingitems = new MissingItems ([
            
                        'id' => $m['id'],
                        'itemDescription' => $m['itemDescription']
                    ]);
                    $newmissingitems->save();
                    }
                    return view('stockmissing', $data);
            }
      
        }
        else{
            return redirect()->route('stocktake')->with('success','There were no items left to find.');
        }


    }

    public function missing()
    {    
        $data['alertmessage'] = "These are the missing items from all stock checks carried out, if found - press the found button on the corresponding items.";
        $data['missingitems'] = MissingItems::Paginate(5);
         return view('stockmissing', $data);
    }

    public function found($id)
    {   $user = auth()->user();
        $item = MissingItems::find($id); 

        if($item) {

            $item->delete();
            $success= true;

        }
        else{
            $success= false;
        }
        
        if($success==true)
        {
            $checkitem = Item::where('id', $id)->first();

            if($checkitem)
            {
                $checkitem->itemScannedBy = $user->name;
                $checkitem->itemlastScanned = gmdate('Y-m-d'); 
                $checkitem->save();
                return redirect()->route('missingitems')->with('success','Stock was marked as found.');
            }
            else{
                return redirect()->route('missingitems')->with('error','Unfortunately an error has occurred.');
            }
            
        }
        else{
            return redirect()->route('stock')->with('error','Unfortunately an error has occurred.');
        }
    }

 

    public function search(Request $request)
    {
        $search = $request->get('search');
        $data['items'] = Item::where('itemDescription', 'like', '%'.$search.'%')->Paginate(5);
        return view('stock', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'itemDescription' => 'required'
            ]);

        $user = auth()->user();
        $item = new Item ([
            'inventoryID' => $request->get('inventoryID'),
            'itemDescription' => $request->get('itemDescription'),
            'itemScannedBy' => $user->name
        ]);
        $item->save();
        return redirect()->route('stockcreate')->with('success','Stock was successfully added');

    }
    public function print(Request $request)
    {   
        $data['items'] = $request->get('printcheck');
        if($data['items']!=null)
        {
            return view('stockprint', $data);
        }
        else{
            return redirect()->route('stock')->with('error','You have not selected anything to print.');
        }
        
    }

    public function printall()
    {   
        $i=0;
        $ids = Item::select('id')->get();
        if($ids)
        {
            foreach($ids as $id)
        {
            $data['items'][$i] = $id['id'];
            $i++;
        }
        return view('stockprint', $data);
        }
        else
        {
            return redirect()->route('stock')->with('error','Nothing to print.');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id); 

            if($item) {

                $item->delete();
                $success= true;

            }
            else{
                $success= false;
            }
            
            if($success==true)
            {
                return redirect()->route('stock')->with('success','Item was successfully deleted.');
            }
            else{
                return redirect()->route('stock')->with('error','Failed.');
            }
    }
}
