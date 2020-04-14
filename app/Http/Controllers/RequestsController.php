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
    {    if(isset($_GET['approval']))
         {
            $data['approve'] = $_GET['approval'];
            if($data['approve']==0)
            {
                $data['selected0']="selected='selected'";
                $data['requests'] = Requests::Paginate(5);
            }
            else if($data['approve']==1)
            {
                $data['selected1']="selected='selected'";
                $data['requests'] = Requests::where('approved', null)->Paginate(5);
            }
            else if($data['approve']==2)
            {
                $data['selected2']="selected='selected'";
                $data['requests'] = Requests::where('approved', 1)->Paginate(5);
            }
         }
        else{
            
            $data['selected0']="selected='selected'";
            $data['requests'] = Requests::Paginate(5);
        }
        
        return view('requests', $data);
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

    public function search(Request $request)
    {
        $search = $request->get('search');
        $data['requests'] = Requests::where('itemDescription', 'like', '%'.$search.'%')->Paginate(5);
        return view('requests', $data);
    }

    public function approve($id)
    {
        $approvereq = Requests::where('id',$id)->first();
        $approvereq->approved = 1;
        $approvereq->save();
        return redirect()->route('requests')->with('success','Request successfully approved.');
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
        $delrequest = Requests::find($id); 

            if($delrequest) {

                $delrequest->delete();
                $success= true;

            }
            else{
                $success= false;
            }
            
            if($success==true)
            {
                return redirect()->route('requestsview')->with('success','Request was successfully deleted.');
            }
            else{
                return redirect()->route('requestsview')->with('error','Failed.');
            }
    }
}
