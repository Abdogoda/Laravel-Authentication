<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller{
    
    public function logout(Request $request){
        Auth::logout();
        return redirect()->to('/')->with('success', 'You are out');
    }

    public function logoutDevice(Session $session){
        $session->delete();

        return back()->with('success', 'Logged Out');
    }
}