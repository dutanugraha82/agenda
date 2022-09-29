<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\UserPostRequest;

class UserController extends Controller
{

    public function index(){
        return view('layouts.pages.dashboard');
    }

    public function createAdminUniv(){
        return view('layouts.sign.create-admin-univ');
    }

    public function storeAdminUniv(UserPostRequest $request){
        User::create($request->validate());
        return redirect('/superadmin/');
    }

}
