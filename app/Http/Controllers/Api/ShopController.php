<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Shops;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ShopController extends Controller
{

    public function addShop(Request $request){


        $validateData= $request->validate([
            'shop_name'=>'required|unique:shops,shop_name|min:2',
            'location'=>'required|min:2',
            'incharge_id'=>'unique:shops,incharge_id',

        ],[
            'incharge_id'=>'This Staff is Already In Charge of a Shop',
        ]);



        $shop =Shops::create([
            'shop_name'=>$request->get('shop_name'),
            'location'=>$request->location,
            'incharge_id'=>$request->incharge_id,
            'owner_id'=>Auth::user()->id,
            'created_at'=>Carbon::now()
        ]);

        if($shop){
            return response([
                'notification' => 'Success',
                'message' => 'Shop Created Successfully',
                'shop'=>$shop
            ], 200);
        }else{
            return response([
                'notification' => 'failure',
                'message' => 'Could Not Create Shop'
            ], 401);
        }




    }

    public function addStaff(Request $request){
        $validateData = $request->validate([
            'name'=>'required|unique:users|min:2',
            'username'=>'required|unique:users|min:2',
            'email'=>'unique:users|email',
            'shop_id'=>'required',
            'phone_number'=>'required|unique:users|min:10',
        ]);

        $user = User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make('12345678'),
            'phone_number'=>$request->phone_number,
            'isAdmin'=>0,
            'shop_id'=>$request->shop_id,
            'created_at'=>Carbon::now()
        ]);

        if($user){
            return response([
                'notification' => 'Success',
                'message' => 'Staff Created Successfully',
                'staff'=>[
                    'name'=>$user->name,
                    'username'=>$user->username,
                    'email'=>$user->email,
                    'phone_number'=>$user->phone_number,
                    'shop_id'=>$user->shop_id,
                ]
            ], 200);
        }else{
            return response([
                'notification' => 'failure',
                'message' => 'Could Not Add Staff'
            ], 401);
        }

    }

    public function getStaff(Request $request){

        $staff= User::select('id','name','email','username','shop_id','created_at')->where('shop_id',$request->shop_id)->get();

        if($staff){
            return response([
                'notification' => 'Success',
                'message' => 'Staff Retrieved Successfully',
                'staffs'=>$staff
            ], 200);
        }else{
            return response([
                'notification' => 'failure',
                'message' => 'Could Not Retrieve Staff'
            ], 401);
        }

    }

    public function assignIncharge(Request $request){
        $validateData= $request->validate([
            'shop_id'=>'required',
            'incharge_id'=>'required',

        ],[
            'incharge_id:unique'=>'This Staff is Already In Charge of a Shop',
        ]);



        $shop =Shops::where('id',$request->shop_id)->update([
            'incharge_id'=>$request->incharge_id,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);

        if($shop){
            return response([
                'notification' => 'Success',
                'message' => 'Shop Updated Successfully',
                'shop'=>Shops::where('id',$request->shop_id)->get()->first()
            ], 200);
        }else{
            return response([
                'notification' => 'failure',
                'message' => 'Could Not Update Shop'
            ], 401);
        }




    }


    public function getShops(){
        $userid=Auth::user()->id;

        $shops =Shops::where('owner_id',$userid)->get();

        if($shops){
            return response([
                'shops'=>$shops
            ], 200);
        }else{
            return response([
                'notification' => 'failure',
                'message' => 'Could Not load Customers'
            ], 401);
        }

    }

}
