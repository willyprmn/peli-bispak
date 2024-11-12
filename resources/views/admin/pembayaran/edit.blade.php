@extends('admin.layouts.base')

@section('container')
<section role="main">
      <div class="row">
            <div class="col-lg-12">
                  @if($pembayaran == NULL)
                  <section class="panel panel-featured-left panel-featured-info">
                        <div class="panel-body">
                              <h2>Tagihan saat ini belum tersedia kembali!</h2>
                        </div>
                  </section>
                  @else
                  <section class="panel">
                        <form class="form-horizontal form-bordered" method="post" action="{{ url('/pembayaran/' . $pembayaran->id_pembayaran) }}" enctype="multipart/form-data">
                              @csrf
                              <header class="panel-heading">
                                    <div class="panel-actions">
                                          <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                          <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                    </div>
                                    <h2 class="panel-title">Pembayaran Tagihan Anda</h2>
                              </header>
                              <div class="panel-body">
                                    <div class="form-group">
                                          <label for="inputDefault" class="col-md-4 control-label">Periode</label>
                                          <div class="col-md-6">
                                                <input type="text" name="periode" id="periode" class="form-control" value="{{ $pembayaran->bulan . ' - ' . $pembayaran->tahun }}" readonly>
                                                <input type="hidden" name="id_tagihan" id="id_tagihan" value="{{ $pembayaran->id_tagihan }}">
                                          </div>
                                    </div>
                                    <div class="form-group">
                                          <label for="inputDefault" class="col-md-4 control-label">Jumlah Bayar</label>
                                          <div class="col-md-6">
                                                <input type="text" name="periode" id="periode" class="form-control" value="Rp {{ number_format($pembayaran->jumlah_bayar, 0, '.', ',') }}" readonly>
                                          </div>
                                    </div>
                                    <div class="form-group @error('bukti_bayar') has-error @enderror">
                                          <label class="col-md-4 control-label">Bukti bayar (.png/.jpg, maks 5 Mb) <b class="required">*</b></label>
                                          <div class="col-md-6">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                      <div class="input-append">
                                                            <div class="uneditable-input">
                                                                  <i class="fa fa-file fileupload-exists"></i>
                                                                  <span class="fileupload-preview"></span>
                                                            </div>
                                                            <span class="btn btn-default btn-file">
                                                                  <span class="fileupload-exists">Ganti</span>
                                                                  <span class="fileupload-new">Unggah</span>
                                                                  <input type="file" name="bukti_bayar" id="bukti_bayar" accept="image/png, image/jpg" onchange="previewImage()" required/>
                                                            </span>
                                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Hapus</a>
                                                      </div>
                                                      <br>
                                                      <img class="img-preview img-fluid mt-3 mb-3 col-sm-6">
                                                </div>
                                                @error('bukti_bayar')
                                                <label id="bukti_bayar-error" class="error" for="bukti_bayar">{{ $message }}</label>
                                                @enderror
                                          </div>
                                    </div>
                              </div>
                              <footer class="panel-footer">
					      <div class="row">
					            <div class="col-sm-9 col-sm-offset-3">
							      <button class="btn btn-success">Unggah</button>
						      </div>
					      </div>
				      </footer>
                        </form>
                  </section>
                  @endif
            </div>
      </div>
</section>
<script>
      function previewImage() {
            const image = document.querySelector('#bukti_bayar')
            const imgPreview = document.querySelector('.img-preview')

            imgPreview.style.display = 'block'

            const oFReader = new FileReader()
            oFReader.readAsDataURL(image.files[0])

            oFReader.onload = function(oFREvent) {
                  imgPreview.src = oFREvent.target.result
            }
      }
</script>
@endsection