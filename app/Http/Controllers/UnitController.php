<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;

class UnitController extends Controller
{
  public function allunit(){
    $data['units'] = Unit::all();
    return view('inventory.config.unit.all', $data);
  }

  public function saveunit(Request $request){
    $new = new Unit;
    $new->nama = $request->nama;
    $new->save();
    return redirect()->route('unit.all');
  }

  public function deleteunit($id){
    $unit = Unit::find($id);
    if (isset($unit)) {
      $unit->delete();
    }else{
      echo "ada kesalahan !";
    }
    return back();
  }
}
