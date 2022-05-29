@extends('dashboard.index')
@section('dashboardContent')
<div class="container">
    <div class="row mb-5 mt-4">
        <div class="col-12">
            <form method="GET" action="#" id="filterForm">
                <div class="input-group rounded h-100 p-0">
                
                    <input type="search" id="search" name = "search" class="form-control rounded" placeholder="Search for medical reports" aria-label="Search" aria-describedby="search-addon" value="{{request ('search')}}" />
                    <span class="input-group-text border-0" id="search-addon">
                    <i class="fas fa-search"></i>
                    </span>
                </div>
                
                    <div class="jumbotron mb-0" id="filterSection" style="@if(request('startDate') || request('endDate')) display: block @else display:none @endif">
                            <div class="d-flex flex-row">
                                <div class="input-group w-50 px-2">
                                    <label for="" class="filterLabel">Start Date</label>
                                    <input id="startDate" class="form-control" type="date" name="startDate" value={{request('startDate')}} />
                                </div>
                                <div class="input-group w-50 px-2">
                                     <label for="" class="filterLabel">End Date</label>
                                    <input id="endDate" class="form-control" type="date" name="endDate" value={{request('endDate')}} />
                                </div>
                            </div>
                            <div class="d-flex flex-row-reverse">
                                <a class="btn btn-link text-decoration-none" onclick="resetFilter()">Reset Filter</a>
                            </div>
                    </div>
                    <div class="d-flex flex-row-reverse my-2">
                        <a class="btn btn-link text-decoration-none" onclick="toggleFilter()" id="toggleButton">@if(request('startDate') || request('endDate'))Hide Filters @else Show Filters @endif
                        </a>
                    </div>
                
        </form>
        </div>
        @if ($reports->count()==0)
            <div class="d-flex justify-content-center mt-1">
                <h1 class="font-weight-bold" style="font-size: 1.5rem">No reports found</h1>
            </div>  
         @endif
     </div>
     <div class="row mt-3 ml-3">
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
        {{ $reports->appends(request()->query())->links()}}
     </div>
     
</div>
<script>
    const startDate=document.getElementById('startDate');
    const endDate=document.getElementById('endDate');
    endDate.onchange = function(){
        document.getElementById('filterForm').submit();    
    };
    startDate.onchange = function(){
        document.getElementById('filterForm').submit();    
    };

    function toggleFilter(){
        btn=document.getElementById('toggleButton');
        const x=0;
        if(btn.innerHTML.trim()=="Show Filters")
        {
            btn.innerHTML="Hide Filters";
        }
        else
        {
           btn.innerHTML="Show Filters";
        }
         $('#filterSection').slideToggle(150);
    }
    function resetFilter()
    {
        document.getElementById('startDate').value="none";
        document.getElementById('endDate').value="none";
        document.getElementById('filterForm').submit();    
    }

</script>
 
@endsection