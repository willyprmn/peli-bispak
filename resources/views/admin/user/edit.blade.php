@extends('admin.layouts.base')

@section('container')
<section role="main">
      <div class="row">
            <div class="col-lg-12">
                  <section class="panel">
                        <form class="form-horizontal form-bordered" method="POST" action="{{ route('user.update', $user->id) }}">
                              @csrf
                              @method('put')
                              <header class="panel-heading">
                                    <div class="panel-actions">
                                          <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                          <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                                    </div>
                                    <h2 class="panel-title">Perbaruhi Data Master User</h2>
                              </header>
                              <div class="panel-body">
                                    <div class="form-group @error('name') has-error @enderror">
                                          <label for="inputDefault" class="col-md-4 control-label">Nama <b class="required">*</b></label>
                                          <div class="col-md-6">
                                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" autofocus required>
                                                @error('name')
                                                <label id="name-error" class="error" for="name">{{ $message }}</label>
                                                @enderror
                                          </div>
                                    </div>
                                    <div class="form-group @error('email') has-error @enderror">
                                          <label for="inputDefault" class="col-md-4 control-label">Email <b class="required">*</b></label>
                                          <div class="col-md-6">
                                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                                @error('email')
                                                <label id="email-error" class="error" for="email">{{ $message }}</label>
                                                @enderror
                                          </div>
                                    </div>
                                    <div class="form-group @error('username') has-error @enderror">
                                          <label for="inputDefault" class="col-md-4 control-label">Username <b class="required">*</b></label>
                                          <div class="col-md-6">
                                                <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                                                @error('username')
                                                <label id="username-error" class="error" for="username">{{ $message }}</label>
                                                @enderror
                                          </div>
                                    </div>
                                    <div class="form-group @error('password') has-error @enderror">
                                          <label for="inputDefault" class="col-md-4 control-label">Password <b class="required">*</b></label>
                                          <div class="col-md-6">
                                                <input type="password" name="password" id="password" class="form-control"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Password minimal 8 karakter yang terdiri dari angka, huruf besar dan kecil serta simbol">
                                                @error('password')
                                                <label id="password-error" class="error" for="password">{{ $message }}</label>
                                                @enderror
                                                <div class="checkbox-custom checkbox-default">
                                                      <input type="checkbox" onclick="showPassword()"/>
                                                      <label>Lihat Password</label>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="form-group @error('role') has-error @enderror">
                                          <label for="inputDefault" class="col-md-4 control-label">Role akses <b class="required">*</b></label>
                                          <div class="col-md-6">
                                                <select name="role" id="role" class="form-control" required>
                                                      <option selected disabled></option>
                                                      <option value="0" {{ old('role') || $user->role == '0' ? 'selected' : '' }}>Admin</option>
                                                      <option value="1" {{ old('role') || $user->role == '1' ? 'selected' : '' }}>Viewer</option>
                                                </select>
                                                @error('role')
                                                <label id="role-error" class="error" for="role">{{ $message }}</label>
                                                @enderror
                                          </div>
                                    </div>
                              </div>
                              <footer class="panel-footer">
					      <div class="row">
					            <div class="col-sm-9 col-sm-offset-3">
							      <button class="btn btn-success">Perbaruhi</button>
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