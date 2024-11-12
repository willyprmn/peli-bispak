@extends('admin.layouts.base')

@section('container')
<div class="col-md-12 col-lg-8">
      <div class="tabs">
            <ul class="nav nav-tabs tabs-primary">
                  <li class="active">
                        <a href="#akun" data-toggle="tab">Akun</a>
                  </li>
            </ul>
            <form action="{{ url('/profil') }}" method="post"> 
                  @csrf
                  <div class="tab-content">
                        @if(session()->has('success'))
                        <div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <strong>Berhasil - </strong> {{ session('success') }}
                        </div>
                        @endif
                        <div id="akun" class="tab-pane active">
                              <h4 class="mb-md">Informasi Akun</h4>
                              <fieldset>
                                    <div class="form-group mb-lg @error('name') has-error @enderror">
                                          <label class="col-md-3 control-label" for="name">Nama</label>
                                          <div class="col-md-8">
                                                <input name="name" id="name" type="text" class="form-control" value="{{ old('name', $profil->name) }}" autofocus /> 
                                                @error('name') 
                                                <label id="name-error" class="error" for="name">{{ $message }}</label> 
                                                @enderror
                                          </div>
                                    </div>
                                    <div class="form-group mb-lg @error('email') has-error @enderror">
                                          <label class="col-md-3 control-label" for="email">E-mail</label>
                                          <div class="col-md-8">
                                                <input name="email" id="email" type="email" class="form-control" value="{{ old('email', $profil->email) }}" /> 
                                                @error('email') 
                                                <label id="email-error" class="error" for="email">{{ $message }}</label> 
                                                @enderror
                                          </div>
                                    </div>
                                    <div class="form-group mb-lg @error('username') has-error @enderror">
                                          <label class="col-md-3 control-label" for="username">Username</label>
                                          <div class="col-md-8">
                                                <input name="username" id="username" type="text" class="form-control" value="{{ old('username', $profil->username) }}" /> 
                                                @error('username') 
                                                <label id="username-error" class="error" for="username">{{ $message }}</label> 
                                                @enderror
                                          </div>
                                    </div>
                                    <div class="form-group mb-lg @error('password') has-error @enderror">
                                          <label class="col-md-3 control-label" for="password">Password</label>
                                          <div class="col-md-8">
                                                <input name="password" id="password" type="password" class="form-control"/> 
                                                @error('password') 
                                                <label id="password-error" class="error" for="password">{{ $message }}</label> 
                                                @enderror
                                                <div class="checkbox-custom checkbox-default">
                                                      <input type="checkbox" onclick="showPassword()"/>
                                                      <label>Lihat Password</label>
                                                </div>
                                          </div>
                                    </div>
                              </fieldset>
                        </div>
                  </div>
                  <div class="panel-footer">
                        <div class="row">
                              <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Ubah</button>
                              </div>
                        </div>
                  </div>
            </form>
      </div>
</div>
<script>
      function showPassword() {
            var x = document.getElementById("password")
            if (x.type === "password") {
                  x.type = "text"
            } else {
                  x.type = "password"
            }
      }
</script>
@endsection