<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fakta Aneh & Unik | Registration Page</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg"><b>Registrasi</b></p>

      @if($errors->any())
        <div class="alert alert-danger p-2 small">
          <ul class="mb-0 pl-3">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('register.proses') }}" method="post">
  @csrf
  
  <div class="input-group mb-3">
    <input type="text" name="name" class="form-control" placeholder="Full name" value="{{ old('name') }}" required>
    <div class="input-group-append"><div class="input-group-text"><span class="fas fa-user"></span></div></div>
  </div>
  
  <div class="input-group mb-3">
    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
    <div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>
  </div>
  
  <div class="input-group mb-3">
    <input type="password" name="password" class="form-control" placeholder="Password" required>
    <div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
  </div>
  
  <div class="input-group mb-3">
    <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password" required>
    <div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
  </div>
  
  <div class="row">
    <div class="col-8">
      <div class="icheck-primary">
        <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
        <label for="agreeTerms">I agree to the terms</label>
      </div>
    </div>
    <div class="col-4">
      <button type="submit" class="btn btn-primary btn-block">Register</button>
    </div>
  </div>
</form>

      <p class="text-center mt-3 mb-0">
        <a href="{{ route('login') }}" class="text-center">Sudah punya akun? Sign In</a>
      </p>
    </div>
    </div></div>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>