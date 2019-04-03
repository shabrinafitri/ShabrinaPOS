@extends('master')
@section('content')
<div class="container py-6">
	<!-- START MODAL -->
	<h3 class="text-center">Data Toko</h3>
	<div id="d-tambahToko" class="dialog" data-role="dialog">
		<div class="dialog-header">
			<div class="dialog-title text-center">Tambah User</div>
		</div>
		<form action="{{route('user.save')}}" method="POST">
			<div class="dialog-content">
				<div class="dialog-body">
					@csrf
					<div class="dialog-body">
						<div class='p-2'>
							<div class='abc input'>
								<input type='text' data-role='input' data-prepend='Nama' placeholder='Nama User' data-validate='minlength=3' data-role-input='true' name='nama'>
							</div>
							<div class='abc input'>
								<input type='email' data-role='input' data-prepend='Email' placeholder='Email' data-validate='minlength=6' data-role-input='true' name='email'>
							</div>
							<div class='abc input'>
								<input type='password' data-role='input' data-prepend='Password' placeholder='Password' data-validate='minlength=4' data-role-input='true' name='password'>
							</div>
							<div class='abc input'>
								<select data-role="select" name="akses">
									<option value="">Pilih Hak Akses</option>
									@foreach($users as $key)
									<option value="{{$key->akses}}">{{$key->akses}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="dialog-actions text-right">
				<a href="{{route('user.all')}}" class="button js-dialog-close alert">Batalkan</a>
				<button type="submit" class="button primary js-dialog-close info" onclick="Metro.notify.create('Data User Berhasil Ditambahkan', 'Tambah Data User', {keepOpen: false});">Tambahkan
				</button>
			</div>
		</form>
	</div>
	<!-- END MODAL -->
	{{-- edit modal --}}
	@foreach ($users as $user)
		<div id="d-editUser{{ $user->_id }}" class="dialog" data-role="dialog">
			<div class="dialog-header">
				<div class="dialog-title text-center">Tambah User</div>
			</div>
			<form action="{{route('user.update', $user->_id)}}" method="POST">
				<div class="dialog-content">
					<div class="dialog-body">
						@csrf @method('PUT')
						<div class="dialog-body">
							<div class='p-2'>
								<div class='abc input'>
									<input type='text' data-role='input' data-prepend='Nama' placeholder='Nama User' data-validate='minlength=3' data-role-input='true' name='nama' value="{{ $user->name }}">
								</div>
								<div class='abc input'>
									<input type='email' data-role='input' data-prepend='Email' placeholder='Email' data-validate='minlength=6' data-role-input='true' name='email' value="{{ $user->email }}">
								</div>
								<div class='abc input'>
									<input type='password' data-role='input' data-prepend='Password' placeholder='Password Baru' data-validate='minlength=4' data-role-input='true' name='password'>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="dialog-actions text-right">
					<a href="{{route('user.all')}}" class="button js-dialog-close alert">Batalkan</a>
					<button type="submit" class="button primary js-dialog-close info" onclick="Metro.notify.create('Berhasil Ubah Data User', 'Ubah Data User', {keepOpen: false});">
					Ubah
					</button>
				</div>
			</form>
		</div>
	@endforeach
	{{-- end of edit modal --}}
</div>

<div class="py-2" style="margin-left: 860px;">
	<button type="button" class="button button-info" onclick="Metro.dialog.open('#d-tambahToko') ">
		<span class="mif-plus icon"></span>
	Tambah User</button><br>
</div>
<table class="table striped table-border mt-4" id="example" data-role="table" data-pagination="true">
	<thead>
		<tr>
			<th class="sortable-column sort-asc text-center">No.</th>
			<th class="sortable-column sort-asc text-center">Nama</th>
			<th class="sortable-column sort-desc text-center">Email</th>
			<th class="sortable-column sort-desc text-center">Hak Akses</th>
			<th class="sortable-column text-center">Anggota Sejak</th>
			<th class="text-center">Aksi</th>
		</tr>
	</thead>
	<tbody>
		@foreach($users as $user)

		<tr>
			<td>{{ $no++ }}</td>
			<td>{{ $user->name }}</td>
			<td>{{ $user->email }}</td>
			<td>{{ $user->akses }}</td>
			<td>{{ $user->created_at }}</td>
			<td class="text-center">
				<a href="#" data-nama="{{$user->namainstansi}}" onclick="Metro.dialog.open('#d-editUser{{ $user->_id }}')">Edit</a>
				<a href="{{route('user.delete', $user->id)}}">Delete</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
</div>
@endsection
