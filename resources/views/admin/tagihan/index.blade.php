@extends('admin.layouts.base')

@section('container')
<section class="panel">
      <header class="panel-heading">
            <div class="panel-actions">
                  <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                  <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>
            <h2 class="panel-title">Tagihan Bulanan Pelanggan</h2>
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
                              <th>Periode</th>
                              <th>Jumlah Meter</th>
                              <th>Status</th>
                              <th>Jumlah Bayar</th>
                              <th>Aksi</th>
                        </tr>
                  </thead>
                  <tbody>
                        @foreach ($tagihan as $t)
                        <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $t->bulan }} - {{ $t->tahun }}</td>
                              <td>{{ number_format($t->jumlah_meter, 0) }} kwh</td>
                              <td>{{ $t->status }}</td>
                              <td>Rp {{ number_format($t->jumlah_bayar, 0) }}</td>
                              <td>
                                    @if($t->status == 'Tagihan tersedia')
                                    <a href="{{ url('/tagihan/bayar/' . $t->id_tagihan) }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Bayar" style="text-decoration: none;">
                                          <i class="fa fa-arrow-circle-right" style="color: #47a447;"></i>
                                    </a>
                                    @elseif($t->status == 'Menunggu Pembayaran')
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Menunggu Pembayaran" style="text-decoration: none; color: #ed9c28;">
                                          <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                    </a>
                                    @elseif($t->status == 'Pembayaran diproses')
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pembayaran diproses" style="text-decoration: none; color: #5bc0de;">
                                          <i class="fa fa-hourglass-half" aria-hidden="true"></i>
                                    </a>
                                    @else
                                    <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Selesai" style="text-decoration: none; color: #47a447;">
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