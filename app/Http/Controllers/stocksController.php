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

    public function addProduct(Request $req)
    {
        $data = new stocks;
        $data->Product_Name = $req->product_name;
        $data->Catagory = $req->catagory;
        $data->Seller_Name = $req->seller_name;
        $data->Product_Price = $req->price_each;
        $data->Quantity = $req->quantity;
        $data->Total_Price = ($req->price_each * $req->quantity);
        $data->save();

        return response()->json("Done");
    }
}
