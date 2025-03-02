<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FacebookAuthController extends Controller{
    
    public function redirect(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(){
        $facebookUser = Socialite::driver('facebook')->user();

        $user = User::firstOrCreate(
            ['email' => $facebookUser->getEmail()],
            [
                'name' => $facebookUser->getName(),
                'password' => Hash::make(Str::random(14)),
                'email_verified_at' => now(),
                'otp' => random_int(100000, 999999)
            ]
        );

        Auth::login($user);
        return redirect()->intended('/profile')->with('success', 'You are in');
    }
}