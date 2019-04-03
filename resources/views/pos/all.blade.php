@extends('master')
@section('content')
<div class="container py-6">
	<!-- START MODAL -->
	<h3 class="text-center">Data POS</h3>
	<div id="d-tambahbahan" class="dialog" data-role="dialog">
		<form action="{{route('bahan.save')}}" method="POST">
			<div class="dialog-content">
				<div class="dialog-body">
					@csrf
					<div class="dialog-body">
						<div class='p-2'>
							<div class='abc input'>
								<input type='text' data-role='input' data-prepend='Nama' placeholder='Nama Bahan' data-validate='minlength=3' data-role-input='true' name='nama'>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="dialog-actions text-right">
				<a href="{{route('bahan.all')}}" class="button js-dialog-close alert">Batalkan</a>
				<button type="submit" class="button primary js-dialog-close info" onclick="Metro.notify.create('Produk Berhasil Ditambahkan', 'Tambah Produk', {keepOpen: false});">
					Tambahkan
				</button>
			</div>
		</form>
	</div>
	@foreach ($pos as $key)
		<div id="d-editStok{{ $key->_id }}" class="dialog" data-role="dialog">
			<form action="{{ route('pos.tambahstok', $key->_id) }}" method="POST">
				<div class="dialog-content">
					<div class="dialog-body">
						@csrf @method("PUT")
						<div class="dialog-body">
							<div class='p-2'>
								<label for="stok_skrng">Tambah Stok</label>
								<div class='abc input'>
									<input type='number' min="{{ $key->jumlah }}" value="{{ $key->jumlah }}" name='tambah_stok'>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="dialog-actions text-right">
					<a href="{{route('bahan.all')}}" class="button js-dialog-close alert"><span class="mif-cancel"></span>&nbsp;Batalkan</a>
					<button type="submit" class="button primary js-dialog-close info" onclick="Metro.notify.create('This is a notify.', 'Title', {keepOpen: false});">
						<span class="mif-checkmark"></span>&nbsp;Tambahkan
					</button>
				</div>
			</form>
		</div>
	@endforeach
</div>
<!-- END MODAL -->
<table class="table striped table-border mt-4" id="example" data-role="table" data-pagination="true">
	<thead>
		<tr>
			<th class="sortable-column sort-asc text-center">Nama</th>
			<th class="sortable-column sort-asc text-center">Kode Transaksi</th>
			<th class="sortable-column sort-asc text-center">Qty</th>
			<th class="sortable-column sort-asc text-center">Harga</th>
			<th class="sortable-column sort-asc text-center">Aksi</th>
		</tr>
	</thead>
	<tbody>
		@foreach($pos as $key)
		<tr>
			<td>{{$key->nama}}</td>
			<td>{{$key->kodetransaksi}}</td>
			<td>{{$key->jumlah}} {{$key->unit}}</td>
			<td>Rp. {{ $key->jumlah * $key->harga}}</td>
			<td><!-- 
				<a href="javascript:void(0);" onclick="Metro.dialog.open('#d-editStok{{ $key->id_ }}')">Tambah Stok</a> -->
				<a href="{{route('pos.deletepayment', $key->id)}}">Hapus</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
<form method="POST" action="{{route('pos.deletesemuapayment')}}">
	@csrf
	<div class="py-2">
		<button type="submit" class="button button-info float-right pembayaran-sementara" style="margin-top: -70px;">
			<span class="mif-delete icon"></span>
		Hapus Semua Transaksi</button><br><br>
	</div>
</form>
</div>
@endsection
