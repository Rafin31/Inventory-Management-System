<?php

namespace App\Http\Controllers;

use App\Models\stocks;
use Illuminate\Http\Request;

class stocksController extends Controller
{


    public function allStocks()
    {
        $data = stocks::orderBy('id', 'DESC')->get();
        return response()->json($data);
    }
}
