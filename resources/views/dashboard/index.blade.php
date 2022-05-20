@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light mt-2">
                <h1 class="d-lg-none dashboard">Dashboard</h1>
                <button class="navbar-toggler ms-auto" type="button" data-toggle="collapse" data-target="#sidebarContent" aria-controls="sidebarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                <div class="navbar navbar-collapse collapse justify-content-center" id="sidebarContent">
                    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width:280px">
                        <ul class="nav nav-pills flex-column mb-auto">
                            <li class="nav-item mb-3">
                                <a href="{{route('reports.create')}}" class="newButton"><i class="fa-solid fa-plus addIcon"></i> New Report</a>
                                <hr>
                            </li>
                        <li class="nav-item">
                            <a href="/reports" class="nav-link active" aria-current="page">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                            Reports
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link link-dark">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                            Doctors
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link link-dark">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                            Orders
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link link-dark">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                            Products
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link link-dark">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                            Customers
                            </a>
                        </li>
                        </ul>
                        <hr>
                      </div>
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
           @yield('dashboardContent')
        </div>
    </div>  
    
</div>


@endsection