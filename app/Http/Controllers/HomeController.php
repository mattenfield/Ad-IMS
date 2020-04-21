<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\MissingItems;
use App\Requests;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['auth_level'] = auth()->user()->user_level;

        if($data['auth_level']==1)
        {   
            $items = Item::all();
            $missingitems = MissingItems::all();
            $requests = Requests::all();
            $data['missingitemscount'] = count($missingitems);
        }
        else
        {
            $items = Item::all();
            $requests = Requests::where('requestbyID',auth()->user()->id)->get();
        }
        

        $data['itemcount'] = count($items);
        $data['requestcount'] = count($requests);

        return view('dashboard', $data);
    }
}
