@extends('dashboard.index')
@section('dashboardContent')
<div class="container">
<div class="card mt-2">
    <div class="d-flex justify-content-between card-header">
        <h5 class="mb-0">Patient Reports</h5>
        <a href="{{route('user',$user->id)}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-messenger" viewBox="0 0 16 16">
        <path d="M0 7.76C0 3.301 3.493 0 8 0s8 3.301 8 7.76-3.493 7.76-8 7.76c-.81 0-1.586-.107-2.316-.307a.639.639 0 0 0-.427.03l-1.588.702a.64.64 0 0 1-.898-.566l-.044-1.423a.639.639 0 0 0-.215-.456C.956 12.108 0 10.092 0 7.76zm5.546-1.459-2.35 3.728c-.225.358.214.761.551.506l2.525-1.916a.48.48 0 0 1 .578-.002l1.869 1.402a1.2 1.2 0 0 0 1.735-.32l2.35-3.728c.226-.358-.214-.761-.551-.506L9.728 7.381a.48.48 0 0 1-.578.002L7.281 5.98a1.2 1.2 0 0 0-1.735.32z"/>
        </svg>
        </a>
    </div>
  
  <ul class="list-group list-group-flush">
    <li class="list-group-item">{{$user->name}}</li>
    <li class="list-group-item">+977-{{$user->phoneNumber}}</li>
    <li class="list-group-item">{{$user->email}}</li>
  </ul>
</div>
    <div class="row mb-5 mt-4">
        <div class="col-12">
            <form method="GET" action="#">
                <div class="input-group rounded h-100 p-0">
                
                    <input type="search" name = "search" class="form-control rounded" placeholder="Search for medical reports" aria-label="Search" aria-describedby="search-addon" value="{{request('search')}}" />
                    <span class="input-group-text border-0" id="search-addon">
                    <i class="fas fa-search"></i>
                    </span>
            </div>
        </form>
        </div>
     </div>
     <div class="row mt-3">
         @if ($reports->count()==0)
            <div class="d-flex justify-content-center mt-1">
                <h1 class="font-weight-bold" style="font-size: 1.5rem">No reports found</h1>
            </div>  
         @endif
        @foreach($reports as $report)
            <div class="col-lg-3 col-md-6 col-sm-6 mb-5">
                <div class="card report-card" onclick="location.href= '{{(route('reports.show',$report))}}'">
                    <img class="card-img-top card-image" src="{{asset('images/'.$report->reportImage)}}" alt="Card image cap">
                    <div class="card-block">
                        <div class="card-text-bg">
                            <p class="card-text"><i class="fa-solid fa-image"></i>   {{$report->reportName}}</p>
                            <p class="date">{{$report->created_at->todatestring()}}</p>
                        </div>
                    </div>
                </div>
            </div>
         @endforeach
     </div>
     <div class="mt-3">
        {{ $reports->appends(request()->query())->links()}}
     </div>
     
</div>

 
@endsection