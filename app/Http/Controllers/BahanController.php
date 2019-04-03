<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bahan;
use App\Unit;

class BahanController extends Controller
{
  public function allbahan(){
    $units = Unit::all();
    $bahans = Bahan::all();
    return view('inventory.config.bahan.all', compact('units', 'bahans'));
  }

  public function savebahan(Request $request){
    $new = new Bahan;
    $new->nama = $request->nama;
    $new->unit = $request->unit;
    $new->save();
    return redirect()->route('bahan.all');
  }

  public function deletebahan($id){
    $bahan = Bahan::findOrFail($id);
    $bahan->delete();
    return back();
  }
}
