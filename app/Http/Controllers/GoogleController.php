<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AccountController ;
use App\Mail\VerifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Throwable;

class GoogleController extends AccountController
{
    public function redirect(Request $request){
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request){
        $user =  Socialite::driver('google')->user();
        $account = Account::where('email', $user->getEmail())->first();

        if($account){
            return $this->check($account,$request);
        }
        else {
            $data = [
                'username' => strtolower(Str::random(8)),
                'email' => $user->getEmail(),
            ];
            $active_token = strtoupper(Str::random(10));
           
            try{ 
                Account::createAccount($data, $active_token);
                Mail::to($data['email'])->send(new VerifyEmail($data, $active_token));
            
                return response()->view('login', [
                    "message" => __('message.create-single-account-successful'),
                    "messageType" => "success",
                ]);
        
            } catch (Throwable $e) {
                return response()->view('login', [
                    "message" => __('message.create-single-account-fail'),
                    "messageType" => "danger",
                ]);
    
            }
        }

    }
}
