@extends('dashboard.index')
@section('dashboardContent')
<div class="container">
    <div class="row mb-5 mt-4">
        <div class="col-12">
         <div class="input-group rounded h-100 p-0">
             <input type="search" class="form-control rounded" placeholder="Search for medical reports" aria-label="Search" aria-describedby="search-addon" />
             <span class="input-group-text border-0" id="search-addon">
               <i class="fas fa-search"></i>
             </span>
           </div>
        </div>
     </div>
     <div class="row mt-3">
        @foreach($reports as $report)
            <div class="col-lg-3 col-md-6 col-sm-6 mb-5">
                <div class="card report-card" onclick="location.href= '{{(route('reports.show',$report->id))}}'">
                    <img class="card-img-top card-image" src="images/{{$report->reportImage}}" alt="Card image cap">
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
        {{ $reports->links() }}
     </div>
     
</div>

 
@endsection