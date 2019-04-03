<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Toko;

class TokoController extends Controller
{
    public function alltoko(){
      $tokos = Toko::first();
      return view('master.toko.all', compact('tokos'));
    }

    public function savetoko(Request $request){
      $new = new Toko;
      $new->namainstansi = $request->nama;
      $new->telp = $request->telepon;
      $new->kodepos = $request->kodepos;
      $new->alamat = $request->alamat;

      $new->save();
      return redirect()->route('toko.all');
    }
    public function updatetoko(Request $request, $id)
    {
      $edit = Toko::findOrFail($id);
      $edit->namainstansi = $request->nama;
      $edit->telp = $request->telepon;
      $edit->kodepos = $request->kodepos;
      $edit->alamat = $request->alamat;
      $edit->save();
      return redirect()->back();
    }

    public function deletetoko($id){
      $toko = Toko::find($id);
      if (isset($toko)) {
        $toko->delete();
      }else{
        echo "ada kesalahan !";
      }
      return redirect()->route('toko.all');
    }
}
