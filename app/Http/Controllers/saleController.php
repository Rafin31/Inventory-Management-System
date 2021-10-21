<?php

namespace App\Http\Controllers;

use App\Models\sale;
use Illuminate\Http\Request;

class saleController extends Controller
{



    public function index()
    {
        return view('sale.sale');
    }

    public function saleData()
    {
        $data = sale::join("stocks", "stocks.id", "=", "sale_table.Product_Id")
            ->orderBy('sale_table.id', "DESC")
            ->get();

        return response()->json($data);
    }
}
