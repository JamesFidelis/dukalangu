<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{



    public function addCustomer(Request $request){



        $validatedData= $request->validate([
            'customer_name'=>'required|unique:customers,customer_name|min:2',
            'customer_email'=>'unique:customers,customer_email|email|min:2',
            'customer_phone'=>'required|unique:customers,customer_phone|min:10',
            'shop_id'=>'required',
            'customer_address'=>'min:2',
        ]);



        $customer =Customer::create($validatedData);

        if($customer){
            return response([
                'notification' => 'Success',
                'message' => 'Customer Created Successfully',
                'customer'=>$customer
            ], 200);
        }else{
            return response([
                'notification' => 'failure',
                'message' => 'Could Not create customer'
            ], 401);
        }




    }


    public function getCustomers(){
        $userid=Auth::user()->id;

        $customer =Customer::with('bills')->get();

        if($customer){
            return response([
                'customers'=>$customer
            ], 200);
        }else{
            return response([
                'notification' => 'failure',
                'message' => 'Could Not load Customers'
            ], 401);
        }

    }


    public function deleteCustomer(Request $request){

        $validateData=$request->validate([
            'customer_id'=>'required'
        ]);

//        $customer = DB::table('customers')->where('id',$request->customer_id)->delete();
        $customer = Customer::where('id',$request->customer_id)->delete();

        if($customer){
            return response([
                'notification' => 'success',
                'message' => 'Customer Deleted'
            ], 200);
        }else{
            return response([
                'notification' => 'failure',
                'message' => 'Could Not Delete Customer'
            ], 401);
        }



    }



}
