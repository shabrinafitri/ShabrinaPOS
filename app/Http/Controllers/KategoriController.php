<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
{
  public function allkategori(){
    $kategoris = Kategori::all();
    return view('inventory.config.kategori.all', compact('kategoris'));
  }

  public function savekategori(Request $request){
    $new = new Kategori;
    $new->nama = $request->nama;
    $new->save();
    return redirect()->route('kategori.all');
  }

  public function deletekategori($id){
    $kategori = Kategori::find($id);
    if (isset($kategori)) {
      $kategori->delete();
    }else{
      echo "ada kesalahan !";
    }
    return back();
  }
}
