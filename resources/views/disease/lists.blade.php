@extends('dashboard.index')

@section('dashboardContent')
<div class="container-fluid mx-3">

    <div class="row justify-content-center mb-5 mt-4">
        <div class="col-9">
            <form method="GET" action="#">
                <div class="input-group rounded h-100 p-0">
                
                    <input type="search" name = "search" class="form-control rounded" placeholder="Search for disease" aria-label="Search" aria-describedby="search-addon" value="{{request('search')}}" />
                    <span class="input-group-text border-0" id="search-addon">
                    <i class="fas fa-search"></i>
                    </span>
            </div>
        </form>
        </div>
     </div>

    @foreach ($diseases as $disease)

    <div class="d-flex row my-2 mx-3 justify-content-center">
        <div class="col-md-10">
            <div class="row p-2 bg-white border rounded">
                <div class="col-md-6 mt-1">
                    <h3>
                       {{$disease->diseaseName}}
                    </h3>
                    <div class="mt-1 mb-1 spec-1">
                        <span>
                        
                          <a href="https://openmd.com/search?q={{$disease->diseaseName}}" class="text-decoration-none" target="_blank">Know about this disease</a> 
                        </span>
                    </div>
                </div>
                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                    <div class="d-flex flex-row align-items-center">
                        <h4 class="mr-1">{{$disease->diseaseCount}}</h4>
                    </div>
                    <h6 class="text-success">Cases last 3 months</h6>
                    <div class="d-flex flex-column mt-4"><a  href="{{route('disease.place',$disease->diseaseName)}}" class="btn btn-primary btn-sm">Location Data</a></div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="mt-3">
        {{ $diseases->appends(request()->query())->links()}}
     </div>

</div>
     
@endsection