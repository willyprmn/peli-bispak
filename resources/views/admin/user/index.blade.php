@extends('admin.layouts.base')

@section('container')
<section class="panel">
      <header class="panel-heading">
            <div class="panel-actions">
                  <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>
            <h2 class="panel-title">List Master User</h2>
      </header>
      <div class="panel-body">
            <div class="row">
                  <div class="col-sm-6">
                        <div class="mb-md">
                              <a class="btn btn btn-primary" href="{{ route('user.create') }}">Tambah Data <i class="fa fa-plus"></i></a>
                        </div>
                  </div>
            </div>
            @if(session()->has('success'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<strong>Berhasil - </strong> {{ session('success') }}
		</div>
		@endif
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                  <thead>
                        <tr>
                              <th>#</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Username</th>
                              <th>Role</th>
                              <th>Aksi</th>
                        </tr>
                  </thead>
                  <tbody>
                        @foreach ($user as $u)
                        <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $u->name }}</td>
                              <td>{{ $u->email }}</td>
                              <td>{{ $u->username }}</td>
                              <td>{{ $u->role == 0 ? 'Admin' : 'Viewer' }}</td>
                              <td>
                                    @if(auth()->user()->id == $u->id)
                                          <button type="button" class="mb-xs mt-xs mr-xs btn btn-xs btn-success">Akun anda</button>
                                    @else
                                    <a href="{{ route('user.edit', $u->id) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" style="text-decoration: none;">
                                          <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('user.destroy', $u->id) }}" method="POST" class="d-inline">
                                          @method('delete')
                                          @csrf
                                          <button class="" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" style="padding: 0; border: none; background: none;"><span><i class="fa fa-trash-o" style="color: #ef5350;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus"></i></span></button>
                                    </form>
                                    @endif
                              </td>
                        </tr>
                        @endforeach
                  </tbody>
            </table>
      </div>
</section>
@endsection