@extends('admin.layouts.base')

@section('container')
<section role="main">
      <div class="row">
            <div class="col-lg-12">
                  <section class="panel">
                        <form class="form-horizontal form-bordered" method="POST" action="{{ route('tarif.store') }}">
                              @csrf
                              <header class="panel-heading">
                                    <div class="panel-actions">
                                          <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                          <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                    </div>
                                    <h2 class="panel-title">Tambah Data Master Tarif</h2>
                              </header>
                              <div class="panel-body">
                                    <div class="form-group @error('daya') has-error @enderror">
                                          <label for="inputDefault" class="col-md-4 control-label">Daya <b class="required">*</b></label>
                                          <div class="col-md-6">
                                                <input type="text" name="daya" id="daya" class="form-control" value="{{ old('daya') }}" autofocus required>
                                                @error('daya')
                                                <label id="name-error" class="error" for="name">{{ $message }}</label>
                                                @enderror
                                          </div>
                                    </div>
                                    <div class="form-group @error('tarifperkwh') has-error @enderror">
                                          <label for="inputDefault" class="col-md-4 control-label">Tarif/kwh (Rp) <b class="required">*</b></label>
                                          <div class="col-md-6">
                                                <input type="text" name="tarifperkwh" id="tarifperkwh" class="form-control" value="{{ old('tarifperkwh') }}" required>
                                                @error('tarifperkwh')
                                                <label id="tarifperkwh-error" class="error" for="tarifperkwh">{{ $message }}</label>
                                                @enderror
                                          </div>
                                    </div>
                              </div>
                              <footer class="panel-footer">
					      <div class="row">
					            <div class="col-sm-9 col-sm-offset-3">
							      <button class="btn btn-success">Simpan</button>
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
      $('#daya').on('keyup', function() {
		var val = $('#daya').val()
		val = val.replace(/[^0-9\.]/g,'')

		if(val != "") {
			valArr = val.split('.');
			valArr[0] = (parseInt(valArr[0],10)).toLocaleString()
			val = valArr.join('.')
		}

		$('#daya').val(val)
	})

      $('#tarifperkwh').on('keyup', function() {
		var val = $('#tarifperkwh').val()
		val = val.replace(/[^0-9\.]/g,'')

		if(val != "") {
			valArr = val.split('.');
			valArr[0] = (parseInt(valArr[0],10)).toLocaleString()
			val = valArr.join('.')
		}

		$('#tarifperkwh').val(val)
	})
</script>
@endsection