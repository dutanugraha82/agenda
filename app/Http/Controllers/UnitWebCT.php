<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitWebRequest;
use App\Models\Unit;
use App\Models\UnitWeb;
use App\Models\UnitWebsite;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UnitWebCT extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {

            // $unitWeb = UnitWeb::where('unit_id',auth()->user()->unit_id)->orderBy('updated_at','desc')->get();
            $unitWeb = UnitWeb::get();
            return datatables()->of($unitWeb)
                               ->addIndexColumn()
                                ->addColumn('action',function($row){
                                    return '<div class="d-flex justify-content-around">
                                                            <a href="'.route('unitweb.edit',['unitweb' => $row->id]).'" class="btn btn-warning btn-md" style="width:5rem;">Edit</a>
                                                            <form action='.route('unitweb.destroy',['unitweb' => $row->id]).' method="POST">
                                                                '.csrf_field().'
                                                                '.method_field("DELETE").'
                                                                <button type="submit" class="btn btn-danger" style="width:5rem;" onclick="javascript: return confirm(\'Apakah anda ingin menghapus kegiatan ?\')">
                                                                    Hapus
                                                                </button>
                                                            </form>
                                                        </div>
                                                        ';

                                })
                                ->addColumn('unit',function($unitWeb){
                                    return $unitWeb->Unit->unit_name;
                                })
                                ->rawColumns(['action'])
                                ->make(true);
        }

        return view('adminunit.unit-web.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataUnit = Unit::get();
        // dd($dataUnit);
        return view('adminunit.unit-web.create', compact('dataUnit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitWebRequest $request)
    {
        // dd($request);
        
        UnitWeb::create($request->validated());
        Alert::success('Berhasil','Data berhasil disimpan!');
        return redirect('/adminunit/unitweb');
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
        $dataUnitWeb = UnitWeb::find($id);
        $dataUnit = Unit::all();
        // dd($dataUnitWeb);
        return view('adminunit.unit-web.edit',compact('dataUnitWeb','dataUnit'));

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
        // dd($validation);
        UnitWebsite::find($id)->update($request->validated());
        Alert::success('Berhasil','Data berhasil disunting!');
        return redirect('/adminunit/unitweb');
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
        Alert::success('Berhasil','Data Berhasil dihapus!');
        return redirect('/adminunit/unitweb');
    }
}
