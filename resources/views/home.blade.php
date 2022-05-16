@extends('layouts.app')

@section('content')
<div class="container" style="margin-bottom: 20rem">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Accounts') }}</div>
               @if ($errors->any())
                 <script>revealInput();</script>
               @endif
                <div class="card-body">
                    <form action="{{route('home.update')}}" method="POST">
                        @csrf
                        @method('PUT')
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row py-2">
                        <div class="col-md-4">
                            <div class="card-body">
                              <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{asset('images/profile.png')}}" class="card-img-top" style="max-width:10rem">
                              </div>
                            </div>
                        </div>
                          <div class="col-md-8">
                              <div class="card-body">
                                <div class="row py-2">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                    <input class="inputProfile @error('name') is-invalid @enderror" name="name" type="text" value="{{Auth::user()->name}}" disabled>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                </div>
                                <hr>
                                <div class="row py-2">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                    <input class="inputProfile @error('email') is-invalid @enderror" name="email" type="text" value="{{Auth::user()->email}}" disabled>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                  </div>
                                </div>
                                <hr>
                                <div class="row py-2">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Phone:</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      <input class="inputProfile @error('phoneNumber') is-invalid @enderror" name="phoneNumber" type="text" value="{{Auth::user()->phoneNumber}}" disabled>
                                      @error('phoneNumber')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                  </div>
                                <hr>
                                <div class="row py-2">
                                    <div class="col-6">
                                    <button class="btn btn-primary w-75" id="editButton" type="button"> Edit Profile</button>
                                    <button class="btn btn-success w-75" id="updateButton" type="submit"> Update Profile</button>
                                    </div>
                                    <div class="col-6">
                                    <a class="btn btn-warning w-75" id="changePassword" type="button"> Change Password</a>
                                    <button class="btn btn-danger w-75" id="cancelButton" type="button"> Cancel</button>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </form>
                    
            </div>
        </div>
    </div>
</div>
<script>
    editButton.addEventListener('click',revealInput);
    function revealInput(){
        const editButton = document.getElementById('editButton');
        const updateButton = document.getElementById('updateButton');
        const changePassword = document.getElementById('changePassword');
        const cancelButton = document.getElementById('cancelButton');
        cancelButton.addEventListener('click', function(){
        document.location.reload();
        });
        var inputField = document.querySelectorAll(".inputProfile");
        editButton.style.display="none";
        updateButton.style.display="block";
        changePassword.style.display="none";
        cancelButton.style.display="block";
        for (var i = 0; i < inputField.length; i++) {
            inputField[i].disabled=false;
            inputField[i].classList.add('form-control');
        }
        inputField[0].focus();
    }
    
</script>
@endsection
