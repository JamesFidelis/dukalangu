<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class RegisterController extends Controller
{

    public function __construct()
    {

        $this->middleware('guest')->only('create');


    }


    public function create()
    {
        return inertia('Auth/Register');
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
