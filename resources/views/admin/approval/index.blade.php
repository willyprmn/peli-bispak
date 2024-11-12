@extends('admin.layouts.base')

@section('container')
<section class="panel">
      <header class="panel-heading">
            <div class="panel-actions">
                  <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>
            <h2 class="panel-title">Approval Pembayaran Pelanggan</h2>
      </header>
      <div class="panel-body">
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
                              <th>ID Meter</th>
                              <th>Periode</th>
                              <th>Bukti Bayar</th>
                              <th>Aksi</th>
                        </tr>
                  </thead>
                  <tbody>
                        @foreach ($approval as $a)
                        <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $a->name }}</td>
                              <td>{{ $a->meter_id }}</td>
                              <td>{{ $a->bulan }} - {{ $a->tahun }}</td>
                              <td><img src="{{ url('/storage/' . $a->bukti_bayar) }}" alt="Bukti Bayar" style="max-width: 150px;"></td>
                              <td>
                                    <a href="{{ url('/approval/tagihan/' . $a->id_tagihan) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Approve" style="text-decoration: none;">
                                          <i class="fa fa-check-square" style="color: #47a447;"></i>
                                    </a>
                              </td>
                        </tr>
                        @endforeach
                  </tbody>
            </table>
      </div>
</section>
@endsection