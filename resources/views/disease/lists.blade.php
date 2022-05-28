@extends('dashboard.index')

@section('dashboardContent')
     @foreach ($diseases as $disease)

    <div class="d-flex justify-content-center row my-2">
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
@endsection