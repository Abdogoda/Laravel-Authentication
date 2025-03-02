<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GithubAuthController extends Controller{
    
    public function redirect(){
        return Socialite::driver('github')->redirect();
    }

    public function callback(){
        $githubUser = Socialite::driver('github')->user();
        
        $user = User::firstOrCreate(
            ['email' => $githubUser->getEmail()],
            [
                'name' => $githubUser->getName(),
                'password' => Hash::make(Str::random(14)),
                'email_verified_at' => now(),
                'otp' => random_int(100000, 999999)
            ]
        );

        Auth::login($user);
        return redirect()->intended('/profile')->with('success', 'You are in');
    }
}