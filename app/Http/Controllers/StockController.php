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
    {
        return view('stock');
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
            'inventoryID' => 'required|numeric', 
            'itemDescription' => 'required'
            ]);

        $user = auth()->user();
        $item = new Item ([
            'inventoryID' => $request->get('inventoryID'),
            'itemDescription' => $request->get('itemDescription'),
            'itemScannedBy' => $user->id
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
