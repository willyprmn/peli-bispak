@extends('admin.layouts.base')

@section('container')
<section role="main">
      <div class="row">
            <div class="col-lg-12">
                  <section class="panel">
                        <form class="form-horizontal form-bordered" method="post" action="{{ route('penggunaan.store') }}">
                              @csrf
                              <header class="panel-heading">
                                    <div class="panel-actions">
                                          <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                          <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                    </div>
                                    <h2 class="panel-title">Tambah Pengguna Bulanan</h2>
                              </header>
                              <div class="panel-body">
                                    <div class="form-group @error('pelanggan_id') has-error @enderror">
                                          <label for="inputDefault" class="col-md-4 control-label">Pelanggan <b class="required">*</b></label>
                                          <div class="col-md-6">
                                                <select name="pelanggan_id" id="pelanggan_id" class="form-control" width="100" data-plugin-selectTwo autofocus required>
                                                      <option selected disabled></option>
                                                      @foreach ($pelanggan as $p)
                                                      <option value="{{ $p->id_pelanggan }}" {{ old('pelanggan_id') == $p->id_pelanggan ? 'selected' : '' }}>{{ $p->meter_id . ' - ' . $p->name }}</option>
                                                      @endforeach
                                                </select>
                                                @error('pelanggan_id')
                                                <label id="name-error" class="error" for="name">{{ $message }}</label>
                                                @enderror
                                          </div>
                                    </div>
                                    <div class="form-group @error('meter_awal') has-error @enderror">
                                          <label for="inputDefault" class="col-md-4 control-label">Meter Awal <b class="required">*</b></label>
                                          <div class="col-md-6">
                                                <input type="text" name="meter_awal" id="meter_awal" class="form-control" value="{{ old('meter_awal') }}" required>
                                                @error('meter_awal')
                                                <label id="name-error" class="error" for="name">{{ $message }}</label>
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
      $('#meter_awal').on('keyup', function() {
		var val = $('#meter_awal').val()
		val = val.replace(/[^0-9\.]/g,'')

		if(val != "") {
			valArr = val.split('.');
			valArr[0] = (parseInt(valArr[0],10)).toLocaleString()
			val = valArr.join('.')
		}

		$('#meter_awal').val(val)
	})
</script>
@endsection