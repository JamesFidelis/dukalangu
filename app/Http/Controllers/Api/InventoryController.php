<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\InventoryImages;
use Illuminate\Http\Request;

class InventoryController extends Controller
{



    public function addInventory(Request $request){


        $validateData = $request->validate([
            'barcode'=>'required|unique:inventories,barcode',
            'buy_price'=>'required',
            'price_retail'=>'required',
            'price_bulk'=>'required',
            'quantity'=>'required',
            'shop_id'=>'required',
        ]);



        $inventory = Inventory::create([
            'barcode'=>$request->barcode,
            'buy_price'=>$request->buy_price,
            'price_retail'=>$request->price_retail,
            'price_bulk'=>$request->price_bulk,
            'quantity'=>$request->quantity,
            'shop_id'=>$request->shop_id,
        ]);


        if($inventory){
            if($request->hasFile('images')){
                $images = $request->file('images');
                foreach ($images as $image){
                    $filename=$image->getClientOriginalName();
                    $path=$image->storeAs('InventoryImages',$filename,'public');
                    InventoryImages::create([
                        'inventory_id'=>$inventory->id,
                        'image_path'=>'storage/'.$path
                    ]);

                }
                return response([
                    'notification' => 'Success',
                    'message' => 'Inventory Created Successfully',
                    'inventory'=>$inventory
                ], 200);
            }else{
                return response([
                    'notification' => 'Success',
                    'message' => 'Inventory Created Successfully',
                    'inventory'=>$inventory
                ], 200);
            }
        }else{
            return response([
                'notification' => 'failure',
                'message' => 'Could Not Create Inventory'
            ], 401);
        }







    }

    public function getInventory(){
        $inventory = Inventory::with(['images','sales','stock'])->get();

        return response([
            'inventory'=>$inventory
        ], 200);
    }


    public function getInventoryimages(){

        $images = InventoryImages::all()->groupBy('inventory_id');

        return response([
            'images'=>$images
        ], 200);


    }



}
