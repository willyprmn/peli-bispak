@extends('auth.base')

@section('container')
<section class="body-sign">
	<div class="center-sign">
		<a href="#" class="logo pull-left">
			<img src="{{ asset('porto-admin') }}/assets/images/listrik.png" height="54" alt="APLPAS" />
		</a>

		<div class="panel panel-sign">
			<div class="panel-title-sign mt-xl text-right">
				<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
			</div>
			<div class="panel-body">
				<h4 class="text-center mb-xlg">Aplikasi Pembayaran Listrik Pascabayar</h4>
				@if(session()->has('loginError')) 
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<strong>Gagal - </strong> {{ session('loginError') }}
				</div> 
				@endif
				@if(session()->has('registerSuccess')) <div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <strong>Berhasil - </strong> {{ session('registerSuccess') }}
                        </div> 
				@endif
				<form action="{{ url('/login') }}" method="post">
					@csrf
					<div class="form-group mb-lg @error('username') has-error @enderror">
						<label>Username</label>
						<div class="input-group input-group-icon">
							<input name="username" id="username" type="text" class="form-control input-lg"  autofocus required/>
							<span class="input-group-addon">
								<span class="icon icon-lg">
									<i class="fa fa-user"></i>
								</span>
							</span>
						</div>
						@error('username') 
						<label id="username" class="error" for="username">{{ $message }}</label> 
						@enderror
					</div>

					<div class="form-group mb-lg @error('password') has-error @enderror">
						<div class="clearfix">
							<label class="pull-left">Password</label>
							<a href="#" onclick="showPassword()" class="pull-right" id="show" style="text-decoration: none;">Lihat Password</a>
						</div>
						<div class="input-group input-group-icon">
							<input name="password" id="password" type="password" class="form-control input-lg" required/>
							<span class="input-group-addon">
								<span class="icon icon-lg">
									<i class="fa fa-lock"></i>
								</span>
							</span>
						</div>
						@error('password') 
						<label id="password" class="error" for="password">{{ $message }}</label> 
						@enderror
					</div>

					<div class="row">
						<div class="col-sm-8">
							<div class="checkbox-custom checkbox-default">
								<input id="RememberMe" name="rememberme" type="checkbox"/>
								<label for="RememberMe">Ingat saya</label>
							</div>
						</div>
						<div class="col-sm-4 text-right">
							<button type="submit" class="btn btn-primary hidden-xs">Sign In</button>
							<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
						</div>
					</div>
					<span class="mt-lg mb-lg line-thru text-center text-uppercase">
                                    <span>Atau</span>
                              </span>
                              <p class="text-center">Tidak memiliki akun? Silahkan <a href="/register" style="text-decoration: none;">Register!</a>
                              </p>
				</form>
			</div>
		</div>

		<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2024. All Rights Reserved by Willy Permana.</p>
	</div>
</section>
<script>
	function showPassword() {
		var x = document.getElementById("password")
		if (x.type === "password") {
			x.type = "text"
			document.getElementById("show").innerText = 'Tutup Password'
		} else {
			x.type = "password"
			document.getElementById("show").innerText = 'Lihat Password'
		}
	}
</script>
@endsection