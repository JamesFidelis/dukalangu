<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{



    public function getSales(){

        $sales = Sales::all();

        return response([
            'sales'=>$sales
        ], 200);


    }



    public function addSale(Request $request){

        $validateData = $request->validate([
            'barcode'=>'required',
            'quantity'=>'required',
            'item_price'=>'required',
            'item_discount'=>'required',
            'credit'=>'required',
            'shop_id'=>'required',
            'customer_id'=>'required',
        ]);



        $total = ($request->item_price-$request->item_discount) * $request->quantity;



        $sale = Sales::create([
            'bar_code'=>$request->barcode,
            'sale_no'=>'SLD'.time(),
            'quantity'=>$request->quantity,
            'item_price'=>$request->item_price,
            'item_discount'=>$request->item_discount,
            'total'=>$total,
            'credit'=>$request->credit,
            'shop_id'=>$request->shop_id,
            'customer_id'=>$request->customer_id,
            'isPaid'=>$request->isPaid,
        ]);


        if($sale){
            return response([
                'notification' => 'Success',
                'message' => 'Item Sold Successfully',
                'sale'=>$sale
            ], 200);
        }else{
            return response([
                'notification' => 'failure',
                'message' => 'Could Not Sell Inventory'
            ], 401);
        }






    }


    public function deleteSale(Request $request){

        $validateData=$request->validate([
            'sale_id'=>'required'
        ]);

        $sale = Sales::where('id',$request->sale_id)->delete();

        if($sale){
            return response([
                'notification' => 'success',
                'message' => 'Sale History Deleted'
            ], 200);
        }else{
            return response([
                'notification' => 'failure',
                'message' => 'Could Not Delete Sale'
            ], 401);
        }



    }



}
