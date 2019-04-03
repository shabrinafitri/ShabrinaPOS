@extends('master')
@section('content')
<div class="container py-6">
	<!-- START MODAL -->
	<h3 class="text-center">Data Produk</h3>
	<div id="d-tambahProduk" class="dialog" data-role="dialog">
		<div class="dialog-header">
			<div class="dialog-title text-center">Tambah Produk</div>
		</div>
		<form action="{{route('produk.save')}}" method="POST">
			<div class="dialog-content">
				<div class="dialog-body">
					@csrf
					<div class="dialog-body">
						<div class='p-2'>
							<div class='abc input'>
								<input type='text' data-role='input' data-prepend='Nama' placeholder='Nama Produk' data-validate='minlength=3' data-role-input='true' name='nama'>
							</div>
							<div class='abc input'>
								<select data-role="select" name="kategori">
									<option value="">Pilih Kategori</option>
									@foreach($kategoris as $kategori)
									<option value="{{$kategori->nama}}">{{$kategori->nama}}</option>
									@endforeach
								</select>
							</div>
							@if (\Request::is('inventory/produk/tersedia'))
							<div class='abc input'>
									<input type='number' data-role='input' data-prepend='Jumlah' placeholder='Jumlah' data-validate='minlength=6' data-role-input='true' name='jumlah'>
							</div>
							@elseif (\Request::is('inventory/produk/habis'))
							<input type='hidden' data-role='input' data-prepend='Jumlah' placeholder='Jumlah' data-role-input='true' name='jumlah' value="0">
							@endif
							<div class='abc input'>
								<label>&nbsp;&nbsp;Satuan Produk</label>
								@foreach ($units as $unit)
									<label class="checkbox" for="checkbox-{{ $unit->nama }}">
										<input type="checkbox" data-role="checkbox" data-caption="Checkbox" id="checkbox-{{ $unit->nama }}" class="" data-role-checkbox="true" value="{{ $unit->nama }}" name="unit">
										<span class="check"></span>
										<span class="caption">{{ $unit->nama }}</span>
									</label>
								@endforeach
							</div>
							<div class='abc input'>
								<input type='number' data-role='input' data-prepend='Harga Beli' placeholder='Harga Beli' data-validate='minlength=5' data-role-input='true' name='hargabeli'>
							</div>
							<div class='abc input'>
								<input type='number' data-role='input' data-prepend='Harga Jual' placeholder='Harga Jual' data-validate='minlength=5' data-role-input='true' name='hargajual'>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="dialog-actions text-right">
				<a href="{{route('produk.all')}}" class="button js-dialog-close alert">Batalkan</a>
				<button type="submit" class="button primary js-dialog-close info" onclick="Metro.notify.create('Produk Berhasil Ditambahkan', 'Tambah Produk', {keepOpen: false});">Tambahkan
				</button>
			</div>
		</form>
	</div>
	@foreach ($produks as $produk)
		<div id="d-editProduk{{ $produk->_id }}" class="dialog" data-role="dialog">
			<div class="dialog-header">
				<div class="dialog-title text-center">Tambah Produk</div>
			</div>
			<form action="{{route('produk.update', $produk->_id)}}" method="POST">
				<div class="dialog-content">
					<div class="dialog-body">
						@csrf @method('PUT')
						<div class="dialog-body">
							<div class='p-2'>
								<div class='abc input'>
									<input type='text' data-role='input' data-prepend='Nama' placeholder='Nama Produk' data-validate='minlength=3' data-role-input='true' name='nama' value="{{ $produk->nama }}">
								</div>
								<div class='abc input'>
									<select data-role="select" name="kategori">
										<option disabled selected>Pilih Kategori</option>
										@foreach($kategoris as $kategori)
										<option value="{{ $kategori->nama }}">{{ $kategori->nama }}</option>
										@endforeach
									</select>
								</div>
								@if (\Request::is('inventory/produk/tersedia'))
								<div class='abc input'>
									<input type='number' data-role='input' data-prepend='Jumlah' placeholder='Jumlah' data-validate='minlength=6' data-role-input='true' name='jumlah' value="{{ $produk->jumlah }}">
								</div>
								@elseif (\Request::is('inventory/produk/habis'))
								<input type='hidden' data-role='input' data-prepend='Jumlah' placeholder='Jumlah' data-role-input='true' name='jumlah' value="0">
								@endif
								<div class='abc input'>
									<label>&nbsp;&nbsp;Satuan Produk</label>
									@foreach ($units as $unit)
										<label class="checkbox" for="checkbox-pcs">
											<input type="checkbox" data-role="checkbox" data-caption="Checkbox" id="checkbox-pcs" class="" data-role-checkbox="true" value="Pcs"
											name="unit" @if ($unit->nama) checked @endif>
											<span class="check"></span>
											<span class="caption">Picis</span>
										</label>
									@endforeach
								</div>
								<div class='abc input'>
									<input type='number' data-role='input' data-prepend='Harga Beli' placeholder='Harga Beli' data-validate='minlength=5' data-role-input='true' name='hargabeli'
									value="{{ $produk->hargabeli }}">
								</div>
								<div class='abc input'>
									<input type='number' data-role='input' data-prepend='Harga Jual' placeholder='Harga Jual' data-validate='minlength=5' data-role-input='true' name='hargajual'
									value="{{ $produk->hargajual }}">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="dialog-actions text-right">
					<a href="{{route('produk.all')}}" class="button js-dialog-close alert"><span class="mif-cancel"></span>&nbsp;Batalkan</a>
					<button type="submit" class="button primary js-dialog-close info" onclick="Metro.notify.create('This is a notify.', 'Title', {keepOpen: false});">
						<span class="mif-checkmark"></span>&nbsp;Tambahkan
					</button>
				</div>
			</form>
		</div>
	@endforeach
</div>
<!-- END MODAL -->

<div class="py-2" style="margin-left: 840px;">
	<button type="button" class="button button-info" onclick="Metro.dialog.open('#d-tambahProduk') ">
		<span class="mif-plus icon"></span>
	Tambah Produk</button><br>
</div>
<table class="table striped table-border mt-4" id="example" data-role="table" data-pagination="true">
	<thead>
		<tr>
			<th class="sortable-column sort-asc text-center">No.</th>
			<th class="sortable-column sort-asc text-center">Kode</th>
			<th class="sortable-column sort-desc text-center">Barcode</th>
			<th class="sortable-column text-center">Nama</th>
			<th class="sortable-column text-center">Kategori</th>
			<th class="sortable-column text-center">Stok</th>
			<th class="sortable-column text-center">Harga Beli</th>
			<th class="sortable-column text-center">Harga Jual</th>
			<th class="text-center">Aksi</th>
		</tr>
	</thead>
	<tbody>
		@foreach($produks as $produk)

		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $produk->kode }}</td>
			<td>{{ $produk->barcode }}</td>
			<td>{{ $produk->nama }}</td>
			<td>{{ $produk->kategori }}</td>
			<td>{{ $produk->jumlah }} <i>{{ $produk->unit }}</i></td>
			<td>{{ $produk->hargabeli }}</td>
			<td>{{ $produk->hargajual }}</td>
			<td class="text-center">
				<!-- <a href="#" onclick="Metro.dialog.open('#d-editProduk{{ $produk->_id }}')">Edit</a> -->
				<a href="{{route('produk.delete', $produk->id)}}">Delete</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
</div>
@endsection
