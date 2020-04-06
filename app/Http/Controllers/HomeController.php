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
        $items = Item::all();
        $missingitems = MissingItems::all();
        $requests = Requests::all();

        $data['itemcount'] = count($items);
        $data['missingitemscount'] = count($missingitems);
        $data['requestcount'] = count($requests);

        return view('dashboard', $data);
    }
}
