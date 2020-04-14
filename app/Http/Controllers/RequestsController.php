<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requests;

class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return(view('requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return(view('requestsadd'));
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
            'itemDescription' => 'required',
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
        
        $image = $request->file('select_file');
        $new_name = rand().'.'.$image->getClientOriginalExtension();
        $image->move(public_path("images"), $new_name);

        $user = auth()->user();
        $request = new Requests ([
            'inventoryID' => $request->get('inventoryID'),
            'itemDescription' => $request->get('itemDescription'),
            'photoEvidenceUploadLink' => $new_name,
            'uploaded' => true,
            'requestbyname' => $user->name,
            'requestbyID' => $user->id,
        ]);
        $request->save();
        return redirect()->route('requests')->with('success','Request successfully generated.');
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
