<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requests;
use App\Item;
use Mail;

class RequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $data['auth_level'] = auth()->user()->user_level; 
        if(isset($_GET['approval'])&&$data['auth_level']==1)
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
                    $data['requests'] = Requests::where('approved', 0)->Paginate(5);
                }
                else if($data['approve']==2)
                {
                    $data['selected2']="selected='selected'";
                    $data['requests'] = Requests::where('approved', 1)->Paginate(5);
                }
                else
                {
                    $data['selected3']="selected='selected'";
                    $data['requests'] = Requests::where('approved', null)->Paginate(5);
                }
        }
        else if(isset($_GET['approval'])&&$data['auth_level']==0)
        {   $data['approve'] = $_GET['approval'];
            if($data['approve']==0)
            {
                $data['selected0']="selected='selected'";
                $data['requests'] = Requests::where('requestbyID', auth()->user()->id)->Paginate(5);
            }
            else if($data['approve']==1)
            {
                $data['selected1']="selected='selected'";
                $data['requests'] = Requests::where('requestbyID', auth()->user()->id)->where('approved', 0)->Paginate(5);
            }
            else if($data['approve']==2)
            {
                $data['selected2']="selected='selected'";
                $data['requests'] = Requests::where('requestbyID', auth()->user()->id)->where('approved', 1)->Paginate(5);
            }
            else
            {
                $data['selected3']="selected='selected'";
                $data['requests'] = Requests::where('requestbyID', auth()->user()->id)->where('approved', null)->Paginate(5);
            }
        }
        else if(!isset($_GET['approval'])&&$data['auth_level']==1)
        {
            $data['selected0']="selected='selected'";
            $data['requests'] = Requests::Paginate(5);
        }
        else if(!isset($_GET['approval'])&&$data['auth_level']==0)
        {
            $data['selected0']="selected='selected'";
            $data['requests'] = Requests::where('requestbyID', auth()->user()->id)->Paginate(5);
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
        if(count($request->all()) == 0)
        {
            return redirect()->route('home');
        }

        if($request->get('inventoryID')==0)
        {
            $invID = null;
        }
        else
        {
            $invID = $request->get('inventoryID');
        }
        $this->validate($request, [
            'itemDescription' => 'required',
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
        
        $image = $request->file('select_file');
        $path = $image->store('evidence', 's3');

        $user = auth()->user();
        $request = new Requests ([
            'inventoryID' => $invID,
            'itemDescription' => $request->get('itemDescription'),
            'photoEvidenceUploadLink' => $path,
            'uploaded' => true,
            'requestbyname' => $user->email,
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
    {   if(count($request->all()) == 0)
        {
            return redirect()->route('home');
        }
        $data['auth_level'] = auth()->user()->user_level;
        $search = $request->get('search');

        if($data['auth_level']==1)
        {
            $data['requests'] = Requests::where('itemDescription', 'like', '%'.$search.'%')->Paginate(5);
        }
        else
        {
            $data['requests'] = Requests::where('itemDescription', 'like', '%'.$search.'%')->where('requestbyID', auth()->user()->id)->Paginate(5);
        }
       
        return view('requests', $data);
    }

    public function approve($id)
    {
        $approvereq = Requests::where('id',$id)->first();
        $approvereq->approved = 1;
        $approvereq->save();
        $email = $approvereq->requestbyname;
        $data['itemDescription']=$approvereq->itemDescription;
        $data['id'] = $id;
        Mail::send('mailaccept', $data, function ($m) use ($email) {
            $m->from('noreply-adims@acoding.ninja', 'AD-IMS');
            $m->to($email)->subject('Your request was accepted.');
        });
        if($approvereq->inventoryID !=null)
        {   $user = auth()->user();

            $item = new Item ([
            'inventoryID' => $approvereq->inventoryID,
            'itemDescription' => $approvereq->itemDescription,
            'itemScannedBy' => $user->name
            ]);
            $item->save();
            
            return redirect()->route('requestsview')->with('success','Request successfully approved and uploaded to Inventory.');
        }
        else{
            return redirect()->route('requestsview')->with('success','Request successfully approved.');
        }

    }
    public function decline($id)
    {
        $approvereq = Requests::where('id',$id)->first();
        $approvereq->approved = 0;
        $approvereq->save();
        $email = $approvereq->requestbyname;
        $data['itemDescription']=$approvereq->itemDescription;
        $data['id'] = $id;
        Mail::send('maildecline', $data, function ($m) use ($email) {
            $m->from('noreply-adims@acoding.ninja', 'AD-IMS');
            $m->to($email)->subject('Your request unfortunately was declined.');
        });
        return redirect()->route('requestsview')->with('success','Request successfully was declined.');
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
    {   $user = auth()->user();

        if($user->user_level==1)
        {
            $delrequest = Requests::find($id);
        }
        else
        {
            $delrequest = Requests::where('id', $id)->where('requestbyID', $user->id)->first();
        }
         
            if(!isset($delrequest)){

                return redirect()->route('requestsview')->with('error','Failed to delete item.');

            }
            else
            {   
                $delrequest->delete();
                return redirect()->route('requestsview')->with('success','Request was successfully deleted.');
            }
            
    }
}
