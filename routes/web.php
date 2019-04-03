<?php

Auth::routes();
Route::view('/', 'welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('mainmenu', 'AdminController@mainmenu')->name('mainmenu');
Route::middleware('superadmin')->prefix('master')->group(function() {
	Route::prefix('toko')->group(function() {
		Route::get('/', 'TokoController@alltoko')->name('toko.all');
		Route::post('save', 'TokoController@savetoko')->name('toko.save');
		Route::put('update/{toko}', 'TokoController@updatetoko')->name('toko.update');
		Route::get('delete/{id}', 'TokoController@deletetoko')->name('toko.delete');
	});
	Route::prefix('user')->group(function() {
		Route::get('/', 'UsersController@alluser')->name('user.all');
		Route::post('save', 'UsersController@saveuser')->name('user.save');
		Route::get('delete/{id}', 'UsersController@deleteuser')->name('user.delete');
		Route::put('update/{user}', 'UsersController@updateuser')->name('user.update');
	});
});
Route::middleware('admin' OR 'superadmin')->prefix('inventory')->group(function() {
	Route::get('/', 'AdminController@indexinventory')->name('inventory.index');
	Route::prefix('produk')->group(function() {
		Route::get('/tersedia', 'ProdukController@allproduk')->name('produk.all');
		Route::get('/habis', 'ProdukController@allproduk')->name('produk.habis');
		Route::post('save', 'ProdukController@saveproduk')->name('produk.save');
		Route::put('update/{produk}', 'ProdukController@updateproduk')->name('produk.update');
		Route::get('delete/{id}', 'ProdukController@deleteproduk')->name('produk.delete');
	});
	Route::prefix('config')->group(function() {
		Route::prefix('kategori')->group(function() {
			Route::get('/', 'KategoriController@allkategori')->name('kategori.all');
			Route::post('save', 'KategoriController@savekategori')->name('kategori.save');
			Route::get('delete/{id}', 'KategoriController@deletekategori')->name('kategori.delete');
		});
		Route::prefix('unit')->group(function() {
			Route::get('/', 'UnitController@allunit')->name('unit.all');
			Route::post('save', 'UnitController@saveunit')->name('unit.save');
			Route::get('delete/{id}', 'UnitController@deleteunit')->name('unit.delete');
		});
		Route::prefix('bahan')->group(function() {
			Route::get('/', 'BahanController@allbahan')->name('bahan.all');
			Route::post('save', 'BahanController@savebahan')->name('bahan.save');
			Route::get('delete/{id}', 'BahanController@deletebahan')->name('bahan.delete');
		});
	});
});
Route::middleware('kasir' OR 'superadmin')->group(function() {
	Route::prefix('pos')->group(function(){
		Route::get('/index', 'AdminController@indexpos')->name('pos.index');
		Route::get('/indexsementara', 'AdminController@indexpaymentsementara')->name('pos.paymentsementara-index');
		Route::post('pembayaran', 'AdminController@transaksi')->name('pos.transaksi');
		Route::post('/paymentsementara', 'AdminController@paymentsementarapos')->name('pos.paymentsementara');
		Route::get('/paymentsementara/delete/{id}', 'AdminController@deletepaymentsementarapos')->name('pos.deletepaymentsementara');
		Route::get('/payment/delete/{id}', 'AdminController@deletepaymentpos')->name('pos.deletepayment');
		Route::post('/payment/deletesemua', 'AdminController@deletesemuapaymentpos')->name('pos.deletesemuapayment');
		Route::put('stok/update/{stok}', 'AdminController@tambahstok')->name('pos.tambahstok');
	});
	Route::prefix('laporan')->group(function(){
		Route::get('/barangmasuk', 'AdminController@barangmasuk')->name('barangmasuk.all');
		Route::get('/barangkeluar', 'AdminController@barangkeluar')->name('barangkeluar.all');
	});
});
