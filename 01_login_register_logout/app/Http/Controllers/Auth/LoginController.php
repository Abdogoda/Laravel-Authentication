<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{

    public function __invoke(LoginRequest $request){
        if(Auth::attempt($request->only('email', 'password'))){
            return redirect()->intended('/profile')->with('success', 'You are in');
        }

        return back()->with('error', 'Invalid Credientials!');
    }
}
