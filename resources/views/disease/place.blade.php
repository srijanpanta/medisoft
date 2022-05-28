@extends('dashboard.index')

@section('dashboardContent')
<div class="container my-3">
<div class="card">
  <h1 class="card-header text-center">
    {{ $diseaseName}}
  </h1>
  <div class="d-flex justify-content-between card-header">
      <span class="font-weight-bold"> 
       District
      </span>
      <span class="mr-4 font-weight-bold"> 
        Count
      </span>
  </div>
  @php
      $x=0;
  @endphp
@foreach ($districts as $district)
@php
    $color=array(
            "0"=>"bg-primary",
            "1"=>"bg-info",
            "2"=>"bg-warning",
            "3"=>"bg-danger",
            "4"=>"bg-success"
    );
    $percentage = $district->diseaseCount/$reportCount * 100;
    $districtName = DB::table('districts')->select('districtName')->where('id',$district->location)->get()->keyBy('districtName');

@endphp
    <div class="row card-body d-flex justify-content-between">
      <div class="col-9">
          <span class="m-2">{{$districtName->keys()[0]}}</span>
        <div class="progress p-0 mx-2">
          <div class="progress-bar {{$color[$x]}}" role="progressbar" style="width: {{$percentage}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
      <div class="col-2 text-right pr-3 mr-3 font-weight-bold">
        {{$district->diseaseCount}}
      </div>
    </div>
      @php
          $x++;
          if($x==5)
          {
            $x=0;
          }
      @endphp


@endforeach
</div>
</div>

@endsection