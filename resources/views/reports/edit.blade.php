@extends('dashboard.index')

@section('dashboardContent')

<div class="container w-75 mt-5">
   <div class="reportImgEdit">
       <img id="imgViewer" src="{{asset('images/'.$report->reportImage)}}" alt="Report image"/>
       <div id="myModal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
        </div>
   </div>
        
    <form method="POST" action="{{route('reports.update',$report)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h3>Update a medical report</h3>
       <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <input type="text" name="reportName" class="form-control" placeholder="Report Name" value="{{$report->reportName}}" />
                    @error('reportName')
                        <span class="text-danger">
                        {{$message."*"}}   
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="diseaseName" class="form-control" placeholder="Disease Name" value="{{$report->diseaseName}}" />
                    @error('diseaseName')
                        <span class="text-danger">
                        {{$message."*"}}   
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <select class="form-select" name="location">
                        <option selected disabled>Your Location</option>
                        @foreach ($locations as $location)
                        <option @if($report->location == $location->id) {{"selected"}} @endif value="{{$location->id}}">{{$location->districtName}}</option>
                        @endforeach
                      </select> 
                    @error('location')
                        <span class="text-danger">
                        {{$message."*"}}   
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Discription of your report..." name="reportDescription">{{$report->reportDescription}}
                    </textarea>
                </div>
                <div class="file-upload">
                    <div class="image-upload-wrap">
                      <input class="file-upload-input" name= "reportImage" type='file' id="imageValue" onchange="readURL(this);" accept="image/*"/>
                      <div class="drag-text">
                             <i class="fa-solid fa-image"></i>
                            <h5> Drag or upload your image.</h5>
                      </div>
                    </div>
                    <div class="file-upload-content">
                      <img class="file-upload-image" src="#" alt="your image" />
                        <div onclick="removeUpload()" class="removeImg">
                            x
                        </div>
                    </div>
                    @error('reportImage')
                        <span class="text-danger">
                        {{$message."*"}}   
                        </span>
                    @enderror
                </div>
                
                <div class="form-group d-flex justify-content-between">
                    <input type="text" name="userId" hidden value="{{auth()->user()->id}}">
                    <input type="submit" name="btnSubmit" class="btn btn-primary" value="Update Report" />
                    <a href="{{URL::previous()}}" class="btn btn-warning">Cancel</a>
                </div>
            </div>
            
        </div>
    </form>
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