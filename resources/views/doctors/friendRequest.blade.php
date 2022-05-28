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
    @php
        $friendrequests=Auth::user()->friend_requests;
    @endphp
    <div class="container mt-5">
        <div class="row text-center">
          @if ($friendrequests->count()==0)
            <div class="d-flex justify-content-center mt-1">
                <h1 class="font-weight-bold" style="font-size: 1.5rem">No new friend request.</h1>
            </div>  
         @endif
        @foreach ($friendrequests as $friendrequest)
        @php
            $user=$user->find($friendrequest->acted_user);
        @endphp
        <div class="col-lg-4 col-xl-4 col-md-6 col-sm-12 mb-5">
        <div class="card " style="width: 20rem;">
          <img class="card-img-top img-circle rounded-circle" src="https://dummyimage.com/100x100/000/fff" alt="Card image cap">
          <div class="card-body">
            <h4 class="card-title">{{$user->name}}</h4>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">{{$user->email}}</li>
              <li class="list-group-item">NMC: {{$user->phoneNumber}}</li>
              <li class="list-group-item d-flex justify-content-between">
                <form action="{{route('friends.update',$friendrequest->id)}}" method="POST">
                @method('PUT')
                  @csrf
                    <input type="hidden" name="second_user" value="{{$friendrequest->id}}">
                    <button type="submit" class="fa-solid fa-user-plus text-primary" style="font-size: 20px; background-color:#ffff; outline:none; border:none"></button>
                </form>
                <form action="{{route('friends.destroy',$user)}}" method="POST">
                @method('DELETE')
                  @csrf
                    <input type="hidden" name="friendship_id" value="{{$user->id}}">
                    <button type="submit" class="fa-solid fa-trash text-danger" style="font-size: 20px; background-color:#ffff; outline:none; border:none"></button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    @endforeach
        </div>
    </div>
    
@endsection