<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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

        if (Auth::attempt($request->validated())) {

            if(auth()->user()->role == 'super_admin') {
                return redirect('/superadmin');

            } elseif(auth()->user()->role == 'admin_unit')
            {
                if(!is_null(auth()->user()->unit_id)) {
                    Alert::success('Login Berhasil','Selamat Datang!');
                    return redirect('/adminunit');
                } else {
                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();
                    Alert::info('Unit Anda belum diploting!','Silahkan menghubungi Super Admin!');
                    return redirect('/');
                }
                
            }elseif(auth()->user()->role == 'admin_univ')
            {
                return redirect('/adminuniv');
            }

        }else{
            $response = Http::withHeaders([
                'Authorization' => env('AGENDA_ACCESS_KEY'),
                'Content-Type' => 'application/json'
            ])->post('https://api-gateway.ubpkarawang.ac.id/external/agenda/create-user',$request->validated());
            
            
            if($response->getStatusCode() === 404) {
                Alert::warning('Login Failed!','email or password wrong!');
                return redirect('/');
            } else {
                $user = $response->json()['data'];
            
                User::create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => Hash::make($user['password']),
                    'role' => 'admin_unit'
                ]);

                Alert::info('Informasi!','persetujuan akses diterima jika sudah mendapatkan unit ploting, hubungi admin segera');
                return redirect('/');

            }
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
