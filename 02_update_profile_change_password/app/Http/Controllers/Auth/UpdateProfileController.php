<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileReqeust;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdateProfileController extends Controller{
    
    public function __invoke(UpdateProfileReqeust $request){
        $user = User::find(Auth::id());
        $user->update($request->validated());

        return back()->with('success', 'Profile updated successfully');
    }
}