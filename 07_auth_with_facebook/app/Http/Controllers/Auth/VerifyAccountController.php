<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifyAccountRequest;
use App\Models\User;
use Illuminate\Http\Request;

class VerifyAccountController extends Controller{

    public function __invoke(VerifyAccountRequest $request){
        $user = User::where('email', $request->email)->first();
        if($user->otp != implode("", $request->otp)){
            return back()->with('error', 'Invalid OTP or email address');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect()->route("login")->with('success', 'Email verified successfully, you can login now');
    }
}