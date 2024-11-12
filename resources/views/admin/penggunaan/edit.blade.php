@extends('admin.layouts.base')

@section('container')
<section role="main">
      <div class="row">
            <div class="col-lg-12">
                  <section class="panel">
                        <form class="form-horizontal form-bordered" method="POST" action="{{ route('penggunaan.update', $penggunaan->id_penggunaan) }}">
                              @csrf
                              @method('put')
                              <header class="panel-heading">
                                    <div class="panel-actions">
                                          <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                          <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                    </div>
                                    <h2 class="panel-title">Generate Bulan Ini</h2>
                              </header>
                              <div class="panel-body">
                                    <div class="form-group">
                                          <label for="inputDefault" class="col-md-4 control-label">Meter Awal</label>
                                          <div class="col-md-6">
                                                <input type="text" name="meter_awal" id="meter_awal" class="form-control" value="{{ $penggunaan->meter_awal }}" readonly>
                                                <input type="hidden" name="pelanggan_id" id="pelanggan_id" value="{{ $penggunaan->pelanggan_id }}">
                                          </div>
                                    </div>
                                    <div class="form-group @error('meter_akhir') has-error @enderror">
                                          <label for="inputDefault" class="col-md-4 control-label">Meter Akhir <b class="required">*</b></label>
                                          <div class="col-md-6">
                                                <input type="text" name="meter_akhir" id="meter_akhir" class="form-control" value="{{ old('meter_akhir') }}" require>
                                                @error('meter_akhir')
                                                <label id="name-error" class="error" for="name">{{ $message }}</label>
                                                @enderror
                                          </div>
                                    </div>
                              </div>
                              <footer class="panel-footer">
					      <div class="row">
					            <div class="col-sm-9 col-sm-offset-3">
							      <button class="btn btn-success" id="generate">Generate</button>
							      <button type="reset" class="btn btn-warning">Batal</button>
						      </div>
					      </div>
				      </footer>
                        </form>
                  </section>
            </div>
      </div>
</section>
<script>
      $(document).ready(function(){
            $('#generate').prop('disabled', true)
      })

      $('#meter_akhir').on('keyup', function() {
		var val = $('#meter_akhir').val()
		val = val.replace(/[^0-9\.]/g,'')

		if(val != "") {
			valArr = val.split('.');
			valArr[0] = (parseInt(valArr[0],10)).toLocaleString()
			val = valArr.join('.')
		}

		$('#meter_akhir').val(val)
	})

      $('#meter_akhir').on('change', function() {
		var awal = parseInt($('#meter_awal').val())
            var akhir = parseInt($('#meter_akhir').val())

            if(akhir < awal){
                  alert('Meter akhir tidak boleh lebih kecil meter awal')
                  $('#generate').prop('disabled', true)
            }
            else{
                  $('#generate').prop('disabled', false)
            }
	})
</script>
@endsection