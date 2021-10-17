<?php

namespace App\Http\Controllers;

use App\Http\Requests\stocks as RequestsStocks;
use App\Models\stocks;
use Illuminate\Http\Request;

class stocksController extends Controller
{


    public function allStocks()
    {
        $data = stocks::orderBy('id', 'DESC')->get();
        return response()->json($data);
    }

    public function addProduct(RequestsStocks $req)
    {

        $data = new stocks;
        $data->Product_Name = $req->product_name;
        $data->Catagory = $req->catagory;
        $data->Seller_Name = $req->seller_name;
        $data->Product_Price = $req->price_each;
        $data->Quantity = $req->quantity;
        $data->Total_Price = ($req->price_each * $req->quantity);
        $data->save();

        return response()->json($data);
    }

    public function updated(RequestsStocks $req, $id)
    {

        $data = stocks::find($id);
        $data->Product_Name = $req->product_name;
        $data->Catagory = $req->catagory;
        $data->Seller_Name = $req->seller_name;
        $data->Product_Price = $req->price_each;
        $data->Quantity = $req->quantity;
        $data->Total_Price = ($req->price_each * $req->quantity);
        $data->save();

        return response()->json($data);
    }

    public function editData($id)
    {
        $data = stocks::find($id);

        return response()->json($data);
    }

    public function deleteData($id)
    {
        $data = stocks::destroy($id);
        return response()->json($data);
    }
}
