<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    public function getUnit(Request $request){
      
      $search = $request->search;

      if($search == ''){
         $units = Unit::orderby('unit_name','asc')->select('id','unit_name')->limit(5)->get();
      }else{
         $units = Unit::orderby('unit_name','asc')->select('id','unit_name')->where('unit_name', 'like', '%' .$search . '%')->limit(5)->get();
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
