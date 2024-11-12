@extends('admin.layouts.base')

@section('container')
<section class="panel">
      <header class="panel-heading">
            <div class="panel-actions">
                  <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>
            <h2 class="panel-title">Penggunaan Bulanan Pelanggan</h2>
      </header>
      <div class="panel-body">
            <div class="row">
                  <div class="col-sm-6">
                        <div class="mb-md">
                              <a class="btn btn btn-primary" href="{{ route('penggunaan.create') }}">Tambah Data <i class="fa fa-plus"></i></a>
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
                              <th>ID Pelanggan</th>
                              <th>Nama</th>
                              <th>Periode</th>
                              <th>Meter Awal</th>
                              <th>Meter Akhir</th>
                              <th>Aksi</th>
                        </tr>
                  </thead>
                  <tbody>
                        @foreach ($penggunaan as $p)
                        <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $p->meter_id }}</td>
                              <td>{{ $p->name }}</td>
                              <td>{{ $p->bulan }} - {{ $p->tahun }}</td>
                              <td>{{ number_format($p->meter_awal, 0) }}</td>
                              <td>{{ number_format($p->meter_akhir, 0) }}</td>
                              <td>
                                    @if(number_format($p->meter_akhir, 0) == 0)
                                    <a href="{{ route('penggunaan.edit', $p->id_penggunaan) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Generate" style="text-decoration: none;">
                                          <i class="fa fa-arrow-circle-right" style="color: #5cb85c;"></i>
                                    </a>
                                    @else
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sudah generate" style="text-decoration: none; color: #47a447;">
                                          <i class="fa fa-check" aria-hidden="true"></i>
                                    </a>
                                    @endif
                              </td>
                        </tr>
                        @endforeach
                  </tbody>
            </table>
      </div>
</section>
@endsection