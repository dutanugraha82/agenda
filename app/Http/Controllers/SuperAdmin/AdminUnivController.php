<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\StoreAdminUnivRequest;
use App\Http\Requests\SuperAdmin\UpdateAdminUnivRequest;
use App\Models\User;

class AdminUnivController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminUniv = User::with('unit')
                            ->where('role','admin_univ')
                            ->get();
        if (request()->ajax()){
            return datatables()
            ->of($adminUniv)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                return '<div class="d-flex justify-content-start">
                <a href="/superadmin/pengguna/admin-univ/'.$row->id.'/edit" class="btn btn-warning btn-sm">Edit</a> 
                            <form action='.route('admin-univ.destroy',['admin_univ' => $row->id]).' method="POST">
                                '.csrf_field().'
                                '.method_field("DELETE").'
                                <button type="submit" class="btn btn-danger btn-sm" onclick="javascript: return confirm(\'Apakah anda ingin menghapus admin univ: '.$row->name.'?\')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                        ';
              
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('superadmin.pengguna.adminUniv');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.pengguna.adminUnivCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminUnivRequest $request)
    {

        User::create($request->validated() + ['role' => 'admin_univ']);
        return redirect()->route('superadmin.pengguna.admin-univ')->with('msg','Admin universitas berhasil ditambah');
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adminUniv = User::find($id);

        return view('superadmin.pengguna.adminUnivEdit',compact('adminUniv'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminUnivRequest $request, $id)
    {

        User::where('id',$id)->update($request->validated() + ['role' => 'admin_univ']);
        return redirect()->route('superadmin.pengguna.admin-univ')->with('msg','Admin universitas berhasil disunting');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->back()->with('msg','Admin universitas berhasil dihapus');

    }
}
