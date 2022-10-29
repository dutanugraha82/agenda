<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\UpdateAdminUnitRequest;
use App\Models\User;

class AdminUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminUnit = User::with('unit')->where('role','admin_unit')->get();
        if (request()->ajax()){
            return datatables()
            ->of($adminUnit)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                return '<div class="d-flex justify-content-start">
                            <a href="/superadmin/pengguna/admin-unit/'.$row->id.'/edit" class="btn btn-warning btn-sm">Edit</a> 
                            <form action='.route('admin-unit.destroy',['admin_unit' => $row->id]).' method="POST">
                                '.csrf_field().'
                                '.method_field("DELETE").'
                                <button type="submit" class="btn btn-danger btn-sm" onclick="javascript: return confirm(\'Apakah anda ingin menghapus admin unit: '.$row->name.'?\')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                        ';
              
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('superadmin.pengguna.adminUnit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adminUnit = User::find($id);

        return view('superadmin.pengguna.adminUnitEdit',compact('adminUnit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminUnitRequest $request, $id)
    {
        User::where('id',$id)->update($request->validated() + ['role' => 'admin_unit']);
        return redirect()->route('superadmin.pengguna.admin-unit')->with('msg','Admin unit berhasil disunting');
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
        return redirect()->route('superadmin.pengguna.admin-unit')->with('msg','Admin unit berhasil dihapus');
    }
}
