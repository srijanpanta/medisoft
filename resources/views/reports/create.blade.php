@extends('layouts.app')

@section('content')

<div class="container contact-form">
    <div class="contact-image">
        <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
    </div>
    <form method="POST" action="{{route('report.store')}}" enctype="multipart/form-data">
        @csrf
        <h3>Add a medical report</h3>
       <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <input type="text" name="reportName" class="form-control" placeholder="Report Name" value="" />
                    @error('reportName')
                        <span class="text-danger">
                        {{$message."*"}}   
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" name="diseaseName" class="form-control" placeholder="Disease Name" value="" />
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
                        <option>{{$location->districtName}}</option>
                        @endforeach
                      </select> 
                    @error('location')
                        <span class="text-danger">
                        {{$message."*"}}   
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Discription of your report..." name="reportDescription"></textarea>
                </div>
                <div class="file-upload">
                    <div class="image-upload-wrap">
                      <input class="file-upload-input" name= "reportImage" type='file' onchange="readURL(this);" accept="image/*" multiple/>
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
                
                <div class="form-group">
                    <input type="text" name="userId" hidden value="{{auth()->user()->id}}">
                    <input type="submit" name="btnSubmit" class="btn btn-primary" value="Send Message" />
                </div>
            </div>
            
        </div>
    </form>
</div>
    
@endsection