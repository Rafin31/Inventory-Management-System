<?php

namespace App\Http\Controllers;

use App\Http\Requests\sale as RequestsSale;
use App\Http\Requests\stocks as RequestsStocks;
use App\Models\sale;
use App\Models\stocks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class stocksController extends Controller
{


    public function allStocks()
    {
        $data = stocks::orderBy('id', 'ASC')->paginate(10);
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

    public function sold(RequestsSale $req)
    {
        $sale = new sale;
        $stocks = stocks::find($req->id);

        if ($stocks->Quantity > $req->quantity) {

            DB::beginTransaction();
            try {
                $stocks->Quantity = $stocks->Quantity - $req->quantity;
                $stocks->save();

                $sale->Product_Id = $stocks->id;
                $sale->sale_quantity = $req->quantity;
                $sale->selling_price = $req->price;
                $sale->total_selling_price = $req->quantity * $req->price;
                $sale->Profit = ($req->quantity * $req->price) - ($stocks->Product_Price * $req->quantity);
                $sale->save();
                DB::commit();

                return response()->json([
                    'status' => 200,
                    'message' => "Successfull"
                ]);
            } catch (\Throwable $th) {
                return response()->json($th);
            }
        } else {
            return response()->json([
                'status' => 201,
                'message' => "Not enough in quantity"
            ]);
        }
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {

            if ($request->search != " ") {
                $stocks = DB::table('stocks')->where('Product_Name', 'LIKE', '%' . $request->search . "%",)
                    ->orWhere('Catagory', 'LIKE', '%' . $request->search . "%",)
                    ->orWhere('Seller_Name', 'LIKE', '%' . $request->search . "%",)
                    ->orderBy('id', 'DESC')
                    ->get();
                if ($stocks->isEmpty()) {
                    return response()->json([
                        'status' => 201,
                    ]);
                } else {
                    return response()->json([
                        'status' => 200,
                        'data' => $stocks
                    ]);
                }
            } else {
                $data = stocks::orderBy('id', 'DESC')->get();
                return response()->json($data);
            }
        }
    }
}
