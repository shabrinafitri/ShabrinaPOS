<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Produk;
use App\Kategori;
use App\Unit;
use App\TransaksiSementara;
use App\TransaksiBeneran;
use PDF;

class AdminController extends Controller
{

	public function mainmenu() {
		return view('mainmenu');
	}

	public function indexinventory(){
		return view('inventory.index');
	}

	public function indexpaymentsementara() {
		$data['produks'] = Produk::all();
		$data['trans'] = TransaksiSementara::all();
		$a = TransaksiSementara::all();
		$sum = 0;
		foreach ($a as $key => $value) {
			$sum = $sum + ($value->harga * $value->jumlah);
		}
		$data['datatotal'] = $sum;
		return view('pos.index', $data);
	}

	public function paymentsementarapos(Request $request){
		$new = new TransaksiSementara;
		if (TransaksiSementara::where('nama', $request->nama)->exists()) {
			$a = TransaksiSementara::where('nama', $request->nama)->first();
			$a->jumlah = $a->jumlah + 1;
			$a->save();
			return back();
		}
		$harga = Produk::where('nama', $request->nama)->value('hargajual');
		$unit = Produk::where('nama', $request->nama)->value('unit');
		$new->nama = $request->nama;
		$new->harga = $harga;
		$new->unit = $unit;
		$new->jumlah = "1";

		$new->save();
		return back();
	}

	public function transaksi(Request $request){
		$transaksi = TransaksiSementara::all();
		$transaksib['pos'] = TransaksiBeneran::all();
		$kodetransaksi = uniqid(10);
		foreach ($transaksi as $key => $value) {
			$barang = Produk::where('nama', $value->nama)->first();
			$barang->jumlah = $barang->jumlah - $value->jumlah;
			$transaksibeneran = new TransaksiBeneran;
			$transaksibeneran->kodetransaksi = "Pos-".$kodetransaksi;
			$transaksibeneran->nama = $value->nama;
			$transaksibeneran->jumlah = $value->jumlah;
			$transaksibeneran->unit = $value->unit;
			$transaksibeneran->harga = $value->harga;
			$transaksibeneran->hargatotal = $request->hargatotal;

			$barang->save();
			$transaksibeneran->save();
		}
		TransaksiSementara::truncate();

		$pdf = PDF::loadView('pos.pdf', $transaksib);
		return $pdf->download('transaksi.pdf');
	}

	public function deletepaymentsementarapos($id){
		$transsaksisementara = TransaksiSementara::find($id);
		if (isset($transsaksisementara)) {
			$transsaksisementara->delete();
		}else{
			echo "ada kesalahan !";
		}
		return back();
	}

	public function deletepaymentpos($id){
		$transaksibeneran = TransaksiBeneran::find($id);
		if (isset($transaksibeneran)) {
			$transaksibeneran->delete();
		}else{
			echo "ada kesalahan !";
		}
		return back();
	}

	public function deletesemuapaymentpos(){
		TransaksiBeneran::truncate();
		return back();
	}

	public function indexpos(){
		$pos = TransaksiBeneran::all();
		return view('pos.all', compact('pos'));
	}

	public function tambahstok(Request $request, $id)
	{
		$stok = Produk::find($id);
		$stok->jumlah = $request->tambah_stok;
		$stok->save();
		return redirect()->route('pos.index');
	}

	public function barangmasuk(){
		$produks = Produk::all();
		return view('laporan.barangmasuk', compact('produks'));
	}

	public function barangkeluar(){
		$produks = TransaksiBeneran::all();
		return view('laporan.barangkeluar', compact('produks'));
	}
}
