<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordReqeust;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller{

    public function __invoke(ChangePasswordReqeust $request){
        $user = User::find(Auth::id());
        if(!Hash::check($request->current_password, $user->password)){
            return back()->with('error', 'Current password incorrect!');
        }
        $user->update(['password' => Hash::make($request->new_password)]);

        Auth::login($user);

        return back()->with('success', 'Your password changed successfully!');
    }
}