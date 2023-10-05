<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{


    public function addStock(Request $request){

        $validateData = $request->validate([
            'barcode_no'=>'required',
            'product_name'=>'required|unique:stocks,product_name',
            'category_id'=>'required',
        ]);


        $stock = Stock::create([
            'barcode_no'=>$request->barcode_no,
            'product_name'=>$request->product_name,
            'category_id'=>$request->category_id,
            'owner_id'=>Auth::user()->id
        ]);

        if($stock){
            return response([
                'notification' => 'Success',
                'message' => 'Stock Created Successfully',
                'stock'=>$stock
            ], 200);

        }else{
            return response([
                'notification' => 'failure',
                'message' => 'Could Not Create Stock'
            ], 401);
        }


    }


    public function getStock(){
        $stock = Stock::with('category')->get();

        return response([
            'stock'=>$stock
        ], 200);


    }







}
