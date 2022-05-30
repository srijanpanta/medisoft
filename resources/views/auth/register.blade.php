@extends('layouts.app')

@section('content')
<style>
  
</style>
<div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 col-md-7 intro-section">
        <div class="intro-content-wrapper">
          <h1 class="intro-title">Welcome to Medisoft !</h1>
          <p class="intro-text">Get started with medisoft by simply registering to our website</p>
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
        @php
            $locations = DB::table('districts')->get();
        @endphp
        <div class="form-group">
                    <select class="form-select" name="location" style="border:none;">
                        <option selected disabled>Your Location</option>
                        @foreach ($locations as $location)
                        <option value="{{$location->id}}" style="color: black">{{$location->districtName}}</option>
                        @endforeach
                      </select> 
                    @error('location')
                        <span class="text-danger">
                        {{$message."*"}}   
                        </span>
                    @enderror
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
              <input type="hidden" name="role" value="patient">
              <input name="login" id="login" class="btn login-btn" type="submit" value="Register">
              <a href="{{route('doctors.create')}}" class="text-danger text-decoration-none"> Register as a doctor?</a>
            </div>
          </form>           
        </div>
      </div>
    </div>
  </div>
@endsection
