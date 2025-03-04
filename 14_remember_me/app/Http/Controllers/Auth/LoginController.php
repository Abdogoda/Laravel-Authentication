<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Mail\VerifyAccountMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller{

    public function __invoke(LoginRequest $request){
        $type = filter_var($request->input('identifier'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        
        $user = User::where($type, $request->identifier)->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return back()->with('error', 'Invalid credentials!');
        }

        if(!$user->email_verified_at){
            Mail::to($user->email)->send(new VerifyAccountMail($user->otp, $user->email));
            return redirect()->route('email.verify', $user->email);
        }

        Auth::login($user, $request->filled('remember'));
        if($user->logout_other_devices){
            Auth::logoutOtherDevices($request->password);
        }
        
        return redirect()->intended('/profile')->with('success', 'You are in');
    }
}