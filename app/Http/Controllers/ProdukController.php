<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Kategori;
use App\Unit;

class ProdukController extends Controller
{
  public function allproduk() {
    $url = basename($_SERVER['REQUEST_URI']);
    $data['no'] = 1;
    $data['units'] = Unit::all();
    if($url == "tersedia"){
      $data['kategoris'] = Kategori::all();
      $data['produks'] = Produk::where('jumlah', '>', '1')->get();
      return view('inventory/produk.all', $data);
    }elseif($url == "habis"){
      $data['produks'] = Produk::where('jumlah', '<', '1')->get();
      $data['kategoris'] = Kategori::all();
      return view('inventory.produk.all', $data);
    }
  }

  public function saveproduk(Request $request){
    $panjang = 10;
    $requestandomString = substr(str_shuffle("0123456789"), 0, $panjang);
    $new = new Produk;
    $new->kode = "Prd-".str_random(7);
    $new->barcode = $requestandomString;
    $new->nama = $request->nama;
    $new->kategori = $request->kategori;
    $new->jumlah = $request->jumlah;
    $new->unit = $request->unit;
    $new->hargajual = $request->hargajual;
    $new->hargabeli = $request->hargabeli;

    $new->save();
    return redirect()->route('produk.all');
  }

  public function updateproduk(Request $request, $id)
  {
    $edit = Produk::findOrFail($id);
    $edit->nama = $request->nama;
    $edit->kategori = $request->kategori;
    $edit->jumlah = $request->jumlah;
    $edit->unit = $request->unit;
    $edit->hargajual = $request->hargajual;
    $edit->hargabeli = $request->hargabeli;
    $edit->save();
    return redirect()->back();
  }

  public function deleteproduk($id){
    $produk = Produk::find($id);
    if (isset($produk)) {
      $produk->delete();
    }else{
      echo "ada kesalahann !";
    }
    return redirect()->route('produk.all');
  }
}
