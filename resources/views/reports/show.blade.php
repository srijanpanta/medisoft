@extends('dashboard.index')
@section('dashboardContent')
<div class="container">
    <div class="row d-flex justify-content-center mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                            <div class="text-center p-4"> <img id ="imgViewer" src="{{asset('images/'.$report->reportImage)}}" width="250" /> </div>
                            <!-- The Modal -->
                            <div id="myModal" class="modal-img">
                                <span class="close">&times;</span>
                                <img class="modal-content" id="img01">
                                <div id="caption"></div>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center flex-row" style="cursor: pointer" onclick="location.href='{{ url()->previous()}}'"> 
                                <i class="fa fa-long-arrow-left"></i> <span class="ml-1">Back</span> </div>
                                <div class="d-flex flex-row">
                               
                                   @can('manageReport',$report)
                                        <a class="btn btn-link fa fa-edit text-muted mr-3" type="submit" href="{{route('reports.edit',$report)}}">
                                        </a>
                                     <button class="btn btn-link fa fa-trash-can text-muted" data-toggle="modal" data-target="#exampleModalCenter"></button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Confirmation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Do you want to delete the report? 
                                            It cannot be undone.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                           <form action="{{route('reports.destroy',$report)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                                <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                                    
                               
                                @endcan
                                </div>
                                
                            </div>
                            <div class="mt-4 mb-3"> 
                                
                                <h5 class="text-uppercase">{{$report->reportName}}</h5>
                                <span class="text-uppercase text-muted brand">{{$report->diseaseName}}</span>
                            </div>
                            <p class="about">{{$report->reportDescription}}</p>
                            <div class="sizes mt-5">
                                <h6>
                                    Date uploaded: {{$report->created_at->todatestring()}}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("imgViewer");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() { 
    modal.style.display = "none";
    }
</script>
@endsection