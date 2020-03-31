<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    public function stock()
    {
        return view('stock');
    }

    public function stocktake()
    {
        return view('stocktake');
    }
    public function addstock()
    {
        return view('stockadd');
    }
    public function newstock()
    {
        return view('stockadd');
    }
    public function missingstock()
    {
        return view('missingstock');
    }
}
