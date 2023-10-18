<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class LoginController extends Controller
{

    public function __construct()
    {

        $this->middleware('guest')->only('create');


    }

    public function create()
    {
        return inertia('Auth/Login');
    }

    public function login(LoginRequest $request)
    {

        if(is_numeric($request->get('username'))){
            if(Auth::attempt(['phone_number' => $request->get('username'), 'password' => request('password')])||Auth::attempt(['cashier_code' => $request->get('username'), 'password' => request('password')])){
                $request->session()->regenerate();
                return Inertia::location('/admin');
            } else {
                throw ValidationException::withMessages([
                    'email'=>'Authentication Failed',
                    'password'=>'Authentication Failed',
                ]);
            }
        }else{
            $credentials = $request->getCredentials();
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return Inertia::location('/admin');
            } else {
                throw ValidationException::withMessages([
                    'email'=>'Authentication Failed',
                    'password'=>'Authentication Failed',
                ]);
            }
        }









    }


    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Inertia::location('/');
    }


}
