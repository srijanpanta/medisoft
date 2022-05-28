@extends('dashboard.index')
@section('dashboardContent')

<style>
      .card-img-top {
  position: absolute;
  top: -60px;
  left: 45%;
  margin-left: -30px;
  width: 100px !important;
  height: 100px;
}

.card {
  margin-top: 30px;
  padding-top: 30px;
}
</style>
   <div class="container mt-5">
@php
    $friends=$user->friends;
@endphp
@if ($friends->count()==0)
            <div class="d-flex justify-content-center mt-1">
                <h1 class="font-weight-bold" style="font-size: 1.5rem">No doctor-patient relationship</h1>
            </div>  
         @endif
 <div class="row text-center">
        @foreach ($friends as $friend)
        <div class="col-lg-4 col-xl-4 col-md-6 col-sm-12 mb-5">
        <div class="card " style="width: 20rem;">
          <img class="card-img-top img-circle rounded-circle" src="{{Chatify::getUserWithAvatar($friend)->avatar}}" alt="Card image cap">
          <div class="card-body">
            @can('isDoctor')
            <a href="{{route('friends.show',$friend)}}">
              <h4 class="card-title">{{$friend->name}}</h4>
            </a>
            @endcan
            @can('isPatient')
              <h4 class="card-title">{{$friend->name}}</h4>
            @endcan
            
            @can('isPatient')
                <p class="card-position">{{$friend->doctor_degree}}</p>
            @endcan
            <div class="p-0 mx-auto">
                <ul class="list-group list-group-flush text-left">
            @can('isPatient')
              <li class="list-group-item">
                  <div class="row">
                      <div class="col-4">Field:</div>
                      <div class="col-8">{{$friend->doctor_type}}</div>
                  </div>
            </li>
            @endcan
            @can('isPatient')
              <li class="list-group-item"><div class="row">
                      <div class="col-4">Nmc:</div>
                      <div class="col-8">{{$friend->nmc_no}}</div>
                  </div></li>
            @endcan
              <li class="list-group-item"><div class="row">
                      <div class="col-4">Phone:</div>
                      <div class="col-8">{{$friend->phoneNumber}}</div>
                  </div></li>
              <li class="list-group-item"><div class="row">
                      <div class="col-4">Email:</div>
                      <div class="col-8">{{$friend->email}}</div>
                  </div></li>
              <li class="list-group-item d-flex justify-content-between">
                <a href="medichat/{{$friend->id}}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-messenger" viewBox="0 0 16 16">
                <path d="M0 7.76C0 3.301 3.493 0 8 0s8 3.301 8 7.76-3.493 7.76-8 7.76c-.81 0-1.586-.107-2.316-.307a.639.639 0 0 0-.427.03l-1.588.702a.64.64 0 0 1-.898-.566l-.044-1.423a.639.639 0 0 0-.215-.456C.956 12.108 0 10.092 0 7.76zm5.546-1.459-2.35 3.728c-.225.358.214.761.551.506l2.525-1.916a.48.48 0 0 1 .578-.002l1.869 1.402a1.2 1.2 0 0 0 1.735-.32l2.35-3.728c.226-.358-.214-.761-.551-.506L9.728 7.381a.48.48 0 0 1-.578.002L7.281 5.98a1.2 1.2 0 0 0-1.735.32z"/>
              </svg>
                </a>
                <form action="{{route('friends.destroy',$friend->id)}}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-link p-0 text-danger"><i class="fa-solid fa-trash" style="font-size: 20px"></i></button>
                </form>
              </li>
            </ul>
            </div>
            
          </div>
        </div>
      </div>
        @endforeach
</div>
   </div>
@endsection