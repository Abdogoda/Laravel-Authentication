<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ValidateEmailRequest;
use App\Mail\SendMagicLinkMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class MagicLoginController extends Controller{

    public function sendMagicLink(ValidateEmailRequest $request){
        $user = User::where('email', $request->email)->first();

        $url = URL::temporarySignedRoute(
            'login.magic.handler', now()->addMinutes(10), ['user' => $user->id]
        );
        Mail::to($user->email)->send(new SendMagicLinkMail($url));

        return back()->with('success', 'We have sent you a login link to your email');
    }

    public function loginHandler(User $user){

        Auth::login($user);
        return redirect()->intended('/profile')->with('success', 'You are in');
    }
}