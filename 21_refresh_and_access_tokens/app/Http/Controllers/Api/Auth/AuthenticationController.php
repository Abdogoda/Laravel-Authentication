<?php

namespace App\Http\Controllers\Api\Auth;

use App\Enums\TokenAbility;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
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

        $access_token = $user->createToken('access-token', [TokenAbility::ACCESS_API->value], Carbon::now()->addMinutes(config('sanctum.access_token_expiration')))->plainTextToken;
        $refresh_token = $user->createToken('refresh-token', [TokenAbility::ISSUE_ACCESS_TOKEN->value], Carbon::now()->addMinutes(config('sanctum.refresh_token_expiration')))->plainTextToken;
        
        return response()->json([
            'status' => 'Success',
            'message' => 'Logged In Successfully',
            'data' => [
                'user' => UserResource::make($user),
                'access_token' => $access_token,
                'refresh_token' => $refresh_token
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

    public function refreshToken(Request $reqeust){
        $user = Auth::user();

        $user->currentAccessToken()->delete();
        $access_token = $user->createToken('access-token', [TokenAbility::ACCESS_API->value], Carbon::now()->addMinutes(config('sanctum.access_token_expiration')))->plainTextToken;
        $refresh_token = $user->createToken('refresh-token', [TokenAbility::ISSUE_ACCESS_TOKEN->value], Carbon::now()->addMinutes(config('sanctum.refresh_token_expiration')))->plainTextToken;
        
        return response()->json([
            'status' => 'Success',
            'message' => 'Token Refreshed Successfully',
            'data' => [
                'access_token' => $access_token,
                'refresh_token' => $refresh_token
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
