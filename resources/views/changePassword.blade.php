@extends('layouts.app')

@section('content')

<div class="container py-2" style="margin-bottom: 20rem">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Change Password') }}</div>
                    <form action="{{route('changePassword.update')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row m-3">
                                    <div class="col-lg-4 col-xs-12">
                                        <label for="currentPassword"> Current Password</label>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password">
                                        @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="row m-3">
                                    <div class="col-lg-4 col-xs-12">
                                        <label for="currentPassword"> New Password</label>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password">
                                        @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="row m-3">
                                    <div class="col-lg-4 col-xs-12">
                                        <label for="currentPassword"> Confirm Password</label>
                                    </div>
                                    <div class="col-lg-6 col-xs-12">
                                        <input type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password">
                                        @error('new_confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="row p-4">
                                    <button class="btn btn-primary col-4" type="submit"> Update Password</button>
                                    <a class="btn btn-warning col-4 ml-5"> Cancel</a>

                                </div>
                               
                              </div>
                            
                    </form>
    
@endsection