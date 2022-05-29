@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 col-md-7 intro-section">
        <div class="brand-wrapper">
          <h1>Logo</h1>
        </div>
        <div class="intro-content-wrapper">
          <h1 class="intro-title">Welcome to website !</h1>
          <p class="intro-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            incididunt ut labore et dolore magna</p>
          <a href="#!" class="btn btn-read-more">Read more</a>
        </div>
        <div class="intro-section-footer">
          <nav class="footer-nav">
            <a href="#!">Facebook</a>
            <a href="#!">Twitter</a>
            <a href="#!">Gmail</a>
          </nav>
        </div>
      </div>
      <div class="col-sm-6 col-md-5 form-section">
        <div class="login-wrapper">
          <h2 class="login-title">Sign in</h2>
          <form action="{{route('login')}}" method="POST">
            @csrf
            <div class="form-group">
              <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Email">
              @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
            </div>
            
            <div class="form-group mb-3" style="position:relative">
                <input id="password" type="password" class="form-control" name="password" autocomplete="current-password" placeholder="Password">
                <div style="position: absolute; right:0.5rem; top:0.5rem">
                    <i class="fa-solid fa-eye-slash" id="togglePassword"></i>
                </div>
                @error('password')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-5">
              <input name="login" id="login" class="btn login-btn" type="submit" value="Login">
              @if (Route::has('password.request'))
              <a class="forgot-password-link" href="{{ route('password.request') }}">
                  {{ __('Forgot Your Password?') }}
              </a>
          @endif
            </div>
          </form>           
          <p class="login-wrapper-footer-text">Need an account? <a href="/register" class="text-reset">Signup here</a></p>
        </div>
      </div>
    </div>
  </div>
@endsection