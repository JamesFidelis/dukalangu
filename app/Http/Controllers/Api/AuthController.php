<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{


    public function login(LoginRequest $request)
    {

        if(is_numeric($request->get('username'))){
            if(Auth::attempt(['phone_number' => $request->get('username'), 'password' => request('password')])||Auth::attempt(['cashier_code' => $request->get('username'), 'password' => request('password')])){
                $user = Auth::user();
                $token = Auth::user()->createToken('auth_token')->accessToken;
                return response([
                    'notification' => 'success',
                    'message' => 'Login Successfull',
                    'user' => $user,
                    'token'=>$token
                ], 200);
            } else {
                return response([
                    'notification' => 'failure',
                    'message' => 'Invalid Credentials'
                ], 401);
            }
        }else{
            $credentials = $request->getCredentials();
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = Auth::user()->createToken('auth_token')->accessToken;
                return response([
                    'notification' => 'success',
                    'message' => 'Login Successfull',
                    'user' => $user,
                    'token'=>$token
                ], 200);
            } else {
                return response([
                    'notification' => 'failure',
                    'message' => 'Invalid Credentials'
                ], 401);
            }
        }









    }

    public function register(RegisterRequest $request){

        $validateData = $request->validate([
            'name'=>'required|unique:users|min:2',
            'username'=>'required|unique:users|min:2',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:6|confirmed',
            'phone_number'=>'required|unique:users|min:10',
            'tin_number'=>'required|unique:users|min:4',
        ]);

        $user = User::create($request->validated());



        if (Auth::attempt($validateData)) {
            $user = Auth::user();
            $token = Auth::user()->createToken('auth_token')->accessToken;
            return response([
                'notification' => 'success',
                'message' => 'Login Successfull',
                'user' => $user,
                'token'=>$token
            ], 200);
        } else {
            return response([
                'notification' => 'failure',
                'message' => 'Invalid Credentials'
            ], 401);
        }




    }


    public function logout(Request $request){

        Session::flush();
        $token= $request->user()->token();
        $token->revoke();


        return response([
            'notification' => 'success',
            'message' => 'User logged out successfully'
        ],200);
    }






}
