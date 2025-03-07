<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller{
    
    public function register(RegisterRequest $request){
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'User created successfully',
            'data' => [
                'user' => UserResource::make($user)
            ]
        ], 201);
    }

    public function login(LoginRequest $request){

        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'status' => 'Error',
                'message' => 'The Provided credentials are incorrect!'
            ], 401);
        }

        $token = $user->createToken('auth-token')->plainTextToken;
        return response()->json([
            'status' => 'Success',
            'message' => 'Logged In Successfully',
            'data' => [
                'user' => UserResource::make($user),
                'token' => $token
            ]
        ]);
    }

    public function profile(){
        return response()->json([
            'status' => 'Success',
            'data' => [
                'user' => UserResource::make(Auth::user()),
            ]
        ]);
    }

    public function logout(Request $request){

        Auth::user()->tokens()->delete();

        return response()->json([
            'status' => 'Success',
            'message' => 'Logged out'
        ]);
    }
}
