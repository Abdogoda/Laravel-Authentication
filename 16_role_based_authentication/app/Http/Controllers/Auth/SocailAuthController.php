<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocailAuthController extends Controller{

    public function redirect(string $driver){
        if(!array_key_exists($driver, config('social.providers'))){
            return redirect()->to('login')->with('error', 'Invalid Driver');
        }
        return Socialite::driver($driver)->redirect();
    }

    public function callback(string $driver){
        if(!array_key_exists($driver, config('social.providers'))){
            return redirect()->to('login')->with('error', 'Invalid Driver');
        }
        
        try {
            $socialUser = Socialite::driver($driver)->user();
        } catch (\Exception $e) {
            return redirect()->to('login')->with('error', 'Authentication Failed');
        }

        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'name' => $socialUser->getName(),
                'password' => Hash::make(Str::random(14)),
                'email_verified_at' => now(),
                'otp' => random_int(100000, 999999)
            ]
        );

        Auth::login($user);
        return redirect()->intended('/profile')->with('success', 'You are in');
    }
}