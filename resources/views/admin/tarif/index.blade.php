@extends('admin.layouts.base')

@section('container')
<section class="panel">
      <header class="panel-heading">
            <div class="panel-actions">
                  <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>
            <h2 class="panel-title">Daftar Master Tarif</h2>
      </header>
      <div class="panel-body">
            <div class="row">
                  <div class="col-sm-6">
                        <div class="mb-md">
                              <a class="btn btn btn-primary" href="{{ route('tarif.create') }}">Tambah Data <i class="fa fa-plus"></i></a>
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
                              <th>Daya</th>
                              <th>Tarif/kwh</th>
                              <th>Aksi</th>
                        </tr>
                  </thead>
                  <tbody>
                        @foreach ($tarif as $t)
                        <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ number_format($t->daya, 0) }} VA</td>
                              <td>Rp {{ number_format($t->tarifperkwh, 0) }}</td>
                              <td>
                                    <a href="{{ route('tarif.edit', $t->id_tarif) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" style="text-decoration: none;">
                                          <i class="fa fa-pencil"></i>
                                    </a>
                                    @if($t->id_pelanggan == NULL)
                                    <form action="{{ route('tarif.destroy', $t->id_tarif) }}" method="POST" class="d-inline">
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