<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class MakeUsersCT extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataUser = User::all();
        // dd($dataUser);
        if (request()->ajax()){
            return datatables()
            ->of($dataUser)
            ->addIndexColumn()
            ->addColumn('action', function($dataUser){
                return '<div class="btn-group d-flex">
                        <a href="/superadmin/users/'.$dataUser->id.'" class="btn btn-primary mr-3">Detail</a>
                        <a href="/superadmin/users/'.$dataUser->id.'/edit" class="btn btn-warning ml-3">Edit</a>
                        </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('layouts.pages.user.data-user');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataUnit = Unit::all();
        return view('layouts.pages.user.make-user',compact('dataUnit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $validation = $request->validated();
        $validation['role'] = 'admin_univ';
        $validation['password'] = Hash::make($request->password);
        User::create($validation);
        Alert::success('User Created!','Success created user!');
        return redirect('/superadmin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataUser = User::find($id);
        // dd($dataUser);
        return view('layouts.pages.user.detail-user', compact('dataUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
