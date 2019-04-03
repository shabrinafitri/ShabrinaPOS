@extends('master')
@section('content')
<div class="container py-6">
	<!-- START MODAL -->
	<h3 class="text-center">Data Toko</h3>
	<div id="d-tambahToko" class="dialog" data-role="dialog">
		<div class="dialog-header">
			<div class="dialog-title text-center">Tambah Toko</div>
		</div>
		<form action="{{route('toko.save')}}" method="POST">
			<div class="dialog-content">
				<div class="dialog-body">
					@csrf
					<div class="dialog-body">
						<div class='p-2'>
							<div class='abc input'>
								<input type='text' data-role='input' data-prepend='Nama' placeholder='Nama Instansi' data-validate='minlength=3' data-role-input='true' name='nama' required>
							</div>
							<div class='abc input'>
								<input type='number' data-role='input' data-prepend='Telepon' placeholder='Telepon' data-validate='minlength=6' data-role-input='true' name='telepon'>
							</div>
							<div class='abc input'>
								<input type='text' data-role='input' data-prepend='Kode Pos' placeholder='Kode Pos' data-validate='minlength=4' data-role-input='true' name='kodepos'>
							</div>
							<div class='abc textarea'>
								<textarea data-prepend='Deskripsi' placeholder='Deskripsi' data-validate='minlength=5' name='deskripsi'></textarea>
							</div>
							<div class='abc input'>
								<input type='text' data-role='input' data-prepend='Alamat' placeholder='Alamat' data-validate='minlength=5' data-role-input='true' name='alamat'>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="dialog-actions text-right">
				<a href="{{route('toko.all')}}" class="button js-dialog-close alert">Batalkan</a>
				<button type="submit" class="button primary js-dialog-close info" onclick="Metro.notify.create('Berhasil Tambah Toko', 'Tambah Toko', {keepOpen: false});">Tambahkan</button>
			</div>
		</form>
	</div>
	<!-- START EDIT TOKO -->
	@isset($tokos)
	<div id="d-editToko" class="dialog" data-role="dialog">
		<div class="dialog-header">
			<div class="dialog-title text-center">Edit Toko</div>
		</div>
		<form action="{{ route('toko.update', $tokos->_id) }}" method="POST">
			<div class="dialog-content">
				<div class="dialog-body">
					@csrf @method('PUT')
					<div class="dialog-body">
						<div class='p-2'>
							<div class='abc input'>
								<input type='text' data-role='input' data-prepend='Nama' placeholder='Nama Instansi' data-validate='minlength=3' data-role-input='true' name='nama' id='nama' value="{{ $tokos->namainstansi }}">
							</div>
							<div class='abc input'>
								<input type='number' data-role='input' data-prepend='Telepon' placeholder='Telepon' data-validate='minlength=6' data-role-input='true' name='telepon' value="{{ $tokos->telp }}">
							</div>
							<div class='abc input'>
								<input type='text' data-role='input' data-prepend='Kode Pos' placeholder='Kode Pos' data-validate='minlength=4' data-role-input='true' name='kodepos' value="{{ $tokos->kodepos }}">
							</div>
							<div class='abc input'>
								<input type='text' data-role='input' data-prepend='Alamat' placeholder='Alamat' data-validate='minlength=5' data-role-input='true' name='alamat' value="{{ $tokos->alamat }}">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="dialog-actions text-right">
				<button class="button js-dialog-close">Batalkan</button>
				<button type="submit" class="button primary js-dialog-close" onclick="Metro.notify.create('Berhasil Ubah Toko', 'Ubah Toko', {keepOpen: false});">Ubah</button>
			</div>
		</form>
	</div>
	@endisset
	<!-- END EDIT TOKO -->
</div>
<!-- END MODAL -->

@empty ($tokos)
	<div class="py-2">
		<button type="button" class="button button-info" onclick="Metro.dialog.open('#d-tambahToko') ">
			<span class="mif-plus icon"></span>
			Tambah Toko
		</button>
	</div>
@endempty
@isset ($tokos)
	<table class="table striped table-border mt-4" id="example" data-role="table" data-pagination="true">
		<thead>
			<tr>
				<th class="sortable-column sort-asc text-center">Nama</th>
				<th class="sortable-column sort-desc text-center">Telepon</th>
				<th class="sortable-column text-center">Kode Pos</th>
				<th class="sortable-column text-center" data-format="date">Alamat</th>
				<th class="text-center">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{ $tokos->namainstansi }}</td>
				<td>{{ $tokos->telp }}</td>
				<td>{{ $tokos->kodepos }}</td>
				<td>{{ $tokos->alamat }}</td>
				<td class="text-center">
					<a href="#" data-nama="{{$tokos->namainstansi}}" onclick="Metro.dialog.open('#d-editToko')">Edit</a>
					<a href="{{route('toko.delete', $tokos->id)}}">Delete</a>
				</td>
			</tr>
		</tbody>
	</table>
@endisset
</div>
@endsection
