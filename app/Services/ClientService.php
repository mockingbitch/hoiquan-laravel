<?php

namespace App\Services;

use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Mail;
use Str;

class ClientService
{
    public function create($request)
    {
        $request->validate([
            'name'=>'required',
            'password'=>'required',
            'email'=>'required',
            'confirmPassword'=>'required|same:password'
        ]);
        $data = $request->only('customerName','email','password');
        $password_hashed = Hash::make($request->password);
        $data['password']=$password_hashed;
        $token = strtoupper(Str::random(10));
        $data['rememberToken']=$token;
        $customer = Customer::create($data);

        return $customer;
    }
}
