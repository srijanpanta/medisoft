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
          <h2 class="login-title">Sign Up</h2>
          <form action="{{route('register')}}" method="POST">
            @csrf
            <div class="form-group">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Full Name">
              

              @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Email address">
          

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <div class="phoneNo">
                <div class="countryCode" id="countryCode">
                    <span>+977</span>
                </div>
                <input type="text" name="phoneNumber" id="phoneNumber" class="form-control @error('phoneNumber') is-invalid @enderror" placeholder="Phone Number" onfocus="phoneNo()" value="{{old('phoneNumber')}}">

                @error('phoneNumber')
                <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
               </span>
                 @enderror

            </div>
        </div>
            
            <div class="form-group mb-3">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" placeholder="Password">

              @error('password')
               <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Confirm Password">
              </div>
            <div class="d-flex justify-content-between align-items-center mb-5">
              <input name="login" id="login" class="btn login-btn" type="submit" value="Register">
            </div>
          </form>           
        </div>
      </div>
    </div>
  </div>

@endsection
