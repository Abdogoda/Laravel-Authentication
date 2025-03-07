<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendVerificationOtpRequest;
use App\Http\Requests\Auth\VerifyAccountRequest;
use App\Mail\VerifyAccountMail;
use App\Models\User;
use App\Services\PhoneVerificationService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VerifyAccountController extends Controller{

    public function __construct(public PhoneVerificationService $phoneVerificationService){}

    public function sendOtp(SendVerificationOtpRequest $request){
        $type = filter_var($request->input('identifier'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        
        $user = User::where($type, $request->identifier)->first();

        if($user->account_verified_at){
            return redirect()->to('login')->with('success', 'You are already verified!');
        }

        if($request->method == 'email'){
            Mail::to($user->email)->send(new VerifyAccountMail($user->otp, $user->email));
        } 
        
        if($request->method == 'phone'){
            if(!$user->phone || $user->phone == ''){
                return back()->with('error', 'You do not have a phone number!');
            }

            try {
                $response = $this->phoneVerificationService->sendOtpMessage($user->phone, $user->otp);
                if($response->failed()){
                    Log::info($response);
                    return back()->with('error', 'Failed to send otp to this phone, try again later!');
                }
            } catch (\Throwable $th) {
                return back()->with('error', $th->getMessage());
            }
        }
        
        return redirect()->route('account.verify', $request->method == 'phone' ? $user->phone : $user->email);
    }

    public function verifyOtp(VerifyAccountRequest $request){

        $type = filter_var($request->input('identifier'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        
        $user = User::where($type, $request->identifier)->first();
        if($user->otp != implode("", $request->otp)){
            return back()->with('error', 'Invalid OTP or account data');
        }

        $user->account_verified_at = now();
        $user->save();

        return redirect()->route("login")->with('success', 'Your Account verified successfully, you can login now');
    }
}