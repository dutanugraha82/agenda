<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function login(){
        return view('layouts.sign.login');
    }

    public function authenticate(LoginRequest $request){

        $form = $request->validated();

        if (Auth::attempt($request->validated())) {


            if(auth()->user()->role == 'super_admin') {
                return redirect('/superadmin');
            } else if(auth()->user()->role == 'admin_unit') {
                return redirect('/adminunit');

            } else if(auth()->user()->role == 'admin_univ') {
                return redirect('/adminuniv');
            }

        }else{
           $response = Http::withHeaders([
                'Authorization' => '4LUD38P1uCiACFOgH1sy',
                'Content-Type' => 'application/json'
            ])->post('https://api-gateway.ubpkarawang.ac.id/external/agenda/create-user',[
                'form-params' => [
                    'email' => $form['email'],
                    'password' => $form['password']
                ]
            ]);

            if ($response->body()) {
                // User::create([
                //     'name' => $response->name,
                //     'email' => $response->email,
                //     'password' => Hash::make($response->password)
                // ]);
                dd($response->body());
            } else {
                Alert::warning('Login Failed!','email or password wrong!');
                return redirect('/');
            }
            
            // dd($response);
        }
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        Alert::info('Logout Success!','Thank you, Have a nice day (:');
        return redirect('/');
    }
}
