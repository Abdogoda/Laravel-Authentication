<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller{
    
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }
    
    public function callback(){
        $googleUser = Socialite::driver('google')->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => Hash::make(Str::random(14)),
                'email_verified_at' => now(),
                'otp' => rand(100000, 999999)
            ]
        );

        Auth::login($user);
        return redirect()->intended('/profile')->with('success', 'You are in');
    }
}