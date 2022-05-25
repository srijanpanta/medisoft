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
   <div class="container mx-auto">
        <div class="row mb-5 mt-4">
            <div class="col-12">
                <form method="GET" action="#">
                    <div class="input-group rounded h-100 p-0">
                        <input type="search" name = "search" class="form-control rounded" placeholder="Search for Doctors" aria-label="Search" aria-describedby="search-addon" />
                        <span class="input-group-text border-0" id="search-addon">
                        <i class="fas fa-search"></i>
                        </span>

                </div>
            </form>
            </div>
        </div>
      <div class="row text-center">
        @foreach ($doctors as $doctor)
        <div class="col-lg-4 col-xl-4 col-md-6 col-sm-12 mb-5">
        <div class="card " style="width: 20rem;">
          <img class="card-img-top img-circle rounded-circle" src="https://dummyimage.com/100x100/000/fff" alt="Card image cap">
          <div class="card-body">
            <h4 class="card-title">{{$doctor->name}}</h4>
            <p class="card-position">{{$doctor->doctor_degree}}</p>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">{{$doctor->doctor_type}}</li>
              <li class="list-group-item">NMC: {{$doctor->nmc_no}}</li>
              <li class="list-group-item d-flex justify-content-between">
                <a href="medichat/{{$doctor->id}}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-messenger" viewBox="0 0 16 16">
                <path d="M0 7.76C0 3.301 3.493 0 8 0s8 3.301 8 7.76-3.493 7.76-8 7.76c-.81 0-1.586-.107-2.316-.307a.639.639 0 0 0-.427.03l-1.588.702a.64.64 0 0 1-.898-.566l-.044-1.423a.639.639 0 0 0-.215-.456C.956 12.108 0 10.092 0 7.76zm5.546-1.459-2.35 3.728c-.225.358.214.761.551.506l2.525-1.916a.48.48 0 0 1 .578-.002l1.869 1.402a1.2 1.2 0 0 0 1.735-.32l2.35-3.728c.226-.358-.214-.761-.551-.506L9.728 7.381a.48.48 0 0 1-.578.002L7.281 5.98a1.2 1.2 0 0 0-1.735.32z"/>
              </svg>
                </a>
                <form action="{{route('friends.store')}}" method="POST">
                  @csrf
                    @php
                        $friendship = $doctor->getFriendship(Auth::user())
                    @endphp
                    @if($friendship==null)
                      <input type="hidden" name="second_user" value="{{$doctor->id}}">
                      <button type="submit" class="fa-solid fa-user-plus text-primary" style="font-size: 20px; background-color:#ffff; outline:none; border:none"></button>
                    @elseif($friendship->status == 'pending')
                    <i class="fa-solid fa-spinner text-primary" style="font-size:20px"></i>
                    @else
                    <i class="fa-solid fa-user-check text-primary" style="font-size:20px"></i>
                    @endif
                    
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
        @endforeach
</div>
<div class="mt-3">
        {{ $doctors->appends(request()->query())->links()}}
     </div>

   </div>
@endsection