<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function login(){
        return view('layouts.sign.login');
    }

    public function authenticate(LoginRequest $request){

        if (Auth::attempt($request->validated())) {


            if(Auth::user()->role === 'super_admin') {
                // echo "halaman super admin";
                return redirect('/superadmin');
            } else if(Auth::user()->role === 'admin_unit') {
                echo "halaman admin unit";

            } else {
                echo "halaman admin univ";
            }

            die;
        }else{
           $response = Http::withHeaders([
                'Authorization' => '4LUD38P1uCiACFOgH1sy',
                'Content-Type' => 'application/json'
            ])->post('https://api-gateway.ubpkarawang.ac.id/external/agenda/create-user',[
                'email' => $request->validated()['email'],
                'password' => $request->validated()['password']
            ]);

        //    dd($response);
        }

        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
