@extends('auth.base')

@section('container')
<section class="body-sign">
      <div class="center-sign">
            <a href="/" class="logo pull-left">
                  <img src="{{ asset('porto-admin') }}/assets/images/listrik.png" height="54" alt="Porto Admin" />
            </a>
            <div class="panel panel-sign">
                  <div class="panel-title-sign mt-xl text-right">
                        <h2 class="title text-uppercase text-weight-bold m-none">
                              <i class="fa fa-user mr-xs"></i> Sign Up
                        </h2>
                  </div>
                  <div class="panel-body">
                        <form action="{{ url('/register') }}" method="post"> 
                              @csrf 
                              <h4 class="mb-xlg">Akun</h4>
                              <div class="form-group mb-lg @error('name') has-error @enderror">
                                    <label>Nama</label>
                                    <input name="name" id="name" type="text" class="form-control" value="{{ old('name') }}" autofocus required/> @error('name') <label id="name-error" class="error" for="name">{{ $message }}</label> @enderror
                              </div>
                              <div class="form-group mb-lg @error('email') has-error @enderror">
                                    <label>E-mail</label>
                                    <input name="email" id="email" type="email" class="form-control" value="{{ old('email') }}" required/> @error('email') <label id="email-error" class="error" for="email">{{ $message }}</label> @enderror
                              </div>
                              <div class="form-group mb-lg @error('username') has-error @enderror">
                                    <label>Username</label>
                                    <input name="username" id="username" type="text" class="form-control" value="{{ old('username') }}" required/> @error('username') <label id="username-error" class="error" for="username">{{ $message }}</label> @enderror
                              </div>
                              <div class="form-group mb-none">
                                    <div class="row">
                                          <div class="col-sm-12 mb-lg  @error('password') has-error @enderror">
                                                <label>Password</label>
                                                <input name="password" id="password" type="password" class="form-control" required/> @error('password') <label id="password-error" class="error" for="password">{{ $message }}</label> @enderror
                                                <div class="checkbox-custom checkbox-default">
                                                      <input type="checkbox" onclick="showPassword()"/>
                                                      <label id="showCheck">Lihat Password</label>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                              <hr class="dotted tall">
					<h4 class="mb-xlg">Data diri</h4>
                              <div class="form-group mb-lg @error('alamat') has-error @enderror">
                                    <label>Alamat Lengkap</label>
                                    <input name="alamat" id="alamat" type="text" class="form-control" value="{{ old('alamat') }}" required/> 
                                    @error('alamat') 
                                    <label id="alamat-error" class="error" for="alamat">{{ $message }}</label> 
                                    @enderror
                              </div>
                              <div class="form-group mb-lg @error('meter_id') has-error @enderror">
                                    <label>ID Meter Anda</label>
                                    <input name="meter_id" id="meter_id" type="text" class="form-control number" value="{{ old('meter_id') }}" maxlength="12" required/> 
                                    @error('meter_id') 
                                    <label id="meter_id-error" class="error" for="meter_id">{{ $message }}</label> 
                                    @enderror
                              </div>
                              <div class="form-group mb-lg @error('id_tarif') has-error @enderror">
                                    <label>Daya Listrik</label>
                                    <select name="id_tarif" id="id_tarif" class="form-control" data-plugin-selectTwo required>
                                          <option selected disabled></option>
                                          @foreach ($tarif as $t)
                                          <option value="{{ $t->id_tarif }}" {{ old('id_tarif') == $t->id_tarif ? 'selected' : '' }}>{{ number_format($t->daya, 0, '.', ',') }} VA</option>
                                          @endforeach
                                    </select>
                                    @error('id_tarif') <label id="id_tarif-error" class="error" for="id_tarif">{{ $message }}</label> @enderror
                              </div>
                              <div class="row">
                                    <div class="col-sm-8">
                                          <div class="checkbox-custom checkbox-default">
                                                <input id="AgreeTerms" name="agreeterms" type="checkbox" />
                                                <label for="AgreeTerms">Saya setuju syarat penggunaan</label>
                                          </div>
                                    </div>
                                    <div class="col-sm-4 text-right">
                                          <button type="submit" id="register" class="btn btn-primary hidden-xs">Sign Up</button>
                                          <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign Up</button>
                                    </div>
                              </div>
                              <span class="mt-lg mb-lg line-thru text-center text-uppercase">
                                    <span>Atau</span>
                              </span>
                              <p class="text-center">Sudah punya akun? Silahkan <a href="/" style="text-decoration: none;">Sign In!</a>
                              </p>
                        </form>
                  </div>
            </div>
            <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2024. All Rights Reserved.</p>
      </div>
</section>
<script>
      $(document).ready(function(){
            $('#register').prop('disabled', true)
      })

      function showPassword() {
            var x = document.getElementById("password")
            if (x.type === "password") {
                  x.type = "text"
                  document.getElementById("showCheck").innerText = 'Tutup Password'
            } else {
                  x.type = "password"
                  document.getElementById("showCheck").innerText = 'Lihat Password'
            }
      }

      $('.number').keyup(function(e){
            if (/\D/g.test(this.value))
            {
                  this.value = this.value.replace(/\D/g, '')
            }
      })

	$('#limit_cc').on('keyup', function() {
		var val = $('#limit_cc').val()
		val = val.replace(/[^0-9\.]/g,'')

		if(val != "") {
			valArr = val.split('.');
			valArr[0] = (parseInt(valArr[0],10)).toLocaleString()
			val = valArr.join('.')
		}

		$('#limit_cc').val(val)
	})

      $('#AgreeTerms').on('click', function() {
		$('#register').prop('disabled', false)
            $('#AgreeTerms').prop('disabled', true)
	})
</script>
@endsection