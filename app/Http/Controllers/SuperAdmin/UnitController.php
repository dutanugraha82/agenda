<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\StoreUnitRequest;
use App\Models\Unit;
use Illuminate\Http\Request;


class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataUnit = Unit::get();
        if(request()->ajax()){
            return datatables()
            ->of($dataUnit)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return '<div class="d-flex justify-content-start">
                <a href="/superadmin/unit/'.$row->id.'/edit" class="btn btn-warning btn-sm">Edit</a> 
                            <form action='.route('unit.destroy',['unit' => $row->id]).' method="POST">
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
        
        return view('superadmin.unit.unit');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnitRequest $request)
    {
        Unit::create($request->validated());
        return redirect()->route('unit.index')->with('msg','Unit berhasil ditambah');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = Unit::find($id);
        return view('superadmin.unit.edit',compact('unit'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUnitRequest $request, $id)
    {
        // dd($request->validated());
        Unit::where('id',$id)->update($request->validated());
        return redirect()->route('unit.index')->with('msg','Unit berhasil disunting');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Unit::destroy($id);
        return redirect()->back()->with('msg','Unit berhasil dihapus');
    }

    public function select2(Request $request){
      
            $search = $request->search;
      
            if($search == ''){
               $units = Unit::orderby('unit_name','asc')->select('id','unit_name')->limit(10)->get();
            }else{
               $units = Unit::orderby('unit_name','asc')->select('id','unit_name')->where('unit_name', 'like', '%' .$search . '%')->limit(10)->get();
            }
      
            $response = array();
            foreach($units as $unit){
               $response[] = array(
                    "id"=>$unit->id,
                    "text"=>$unit->unit_name
               );
            }
      
            return response()->json($response);
          
    }
}
