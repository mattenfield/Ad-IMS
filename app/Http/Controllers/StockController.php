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
        return view('addstock');
    }
    public function missingstock()
    {
        return view('missingstock');
    }
}
