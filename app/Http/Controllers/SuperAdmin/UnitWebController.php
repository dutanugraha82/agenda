<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\Unit;
use App\Models\UnitWebsite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Unit\UnitWebRequest;
use RealRashid\SweetAlert\Facades\Alert;

class UnitWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataUnit = UnitWebsite::all();
        if(request()->ajax()){
            return datatables()
            ->of($dataUnit)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return '<div class="d-flex justify-content-start">
                            <a href="/superadmin/unitweb/'.$row->id.'/edit" class="btn btn-warning btn-sm mr-2">Edit</a>
                            <form action='.route('unitweb.destroy',['unitweb' => $row->id]).' method="POST">
                                '.csrf_field().'
                                '.method_field("DELETE").'
                                <button type="submit" class="btn btn-danger btn-sm" onclick="javascript: return confirm(\'Apakah anda ingin menghapus unit: '.$row->unit_name.'?\')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                        ';
                    })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('SuperAdmin.unit-web.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $dataUnit = Unit::all();
        return view('SuperAdmin.unit-web.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitWebRequest $request)
    {
        UnitWebsite::create($request->validated());
        Alert::success('Berhasil','Data berhasil ditambahkan!');
        return redirect(route('unitweb'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataUnitWeb = UnitWebsite::find($id);
        // dd($dataUnitWeb);
        return view('SuperAdmin.unit-web.edit',compact('dataUnitWeb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnitWebRequest $request, $id)
    {
        UnitWebsite::find($id)->update($request->validated());
        Alert::success('Berhasil','Data berhasil disunting!');
        return redirect(route('unitweb'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UnitWebsite::find($id)->delete();
        Alert::success('Berhasil','Data berhasil terhapus!');
        return redirect(route('unitweb'));
    }
}
