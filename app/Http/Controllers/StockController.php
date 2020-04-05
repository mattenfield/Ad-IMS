<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class StockController extends Controller
{
    public function take()
    {   
        return view('stocktake');
    }

    public function missing()
    {
        return view('stockmissing');
    }
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
            $data['items'] = Item::where('inventoryID', $data['id'])->get()->toArray();
            return view('stock', $data);
        }
        else{
           
            $data['items'] = Item::all()->toArray();
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
        return redirect()->route('stock')->with('success','Stock was successfully added');

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
        //
    }
}
