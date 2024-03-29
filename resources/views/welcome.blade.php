@extends('layouts.app')

@section('content')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAktRDBaNXeVPp908e4H9WEBD5bZ4hoTVA"></script>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-5 py-5">
        <form action="/newsletter" method="POST">
        @csrf
        <div class="row gx-5 align-items-center justify-content-center">
            <div class="col-lg-8 col-xl-7 col-xxl-6">
                <div class="my-5 text-center text-xl-start">
                    <h1 class="display-5 fw-bolder text-white mb-2">Medisoft takes the medical interaction to a new level</h1>
                    <p class="lead fw-normal text-white-50 mb-4">Subscribe to our newsletter to stay updated.</p>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                        <input type = "email" class="form-control px-4 me-sm-3" name ="email" placeholder="Email Address....">
                        <button class="btn btn-outline-light btn-lg px-4" type="submit">Subscribe</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3" src="{{asset('images/headerImage.png')}}" alt="..." /></div>
        </div>
        </form>
    </div>
</header>
 <!-- Features section-->
 <section class="py-5" id="features">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-4 mb-5 mb-lg-0"><h2 class="fw-bolder mb-0">A better way to start building.</h2></div>
            <div class="col-lg-8">
                <div class="row gx-5 row-cols-1 row-cols-md-2">
                    <div class="col mb-5 h-100">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="fa-solid fa-book-medical"></i></div>
                        <h2 class="h5">Featured title</h2>
                        <p class="mb-0">Paragraph of text beneath the heading to explain the heading. Here is just a bit more text.</p>
                    </div>
                    <div class="col mb-5 h-100">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="fa-solid fa-user-doctor"></i></div>
                        <h2 class="h5">Featured title</h2>
                        <p class="mb-0">Paragraph of text beneath the heading to explain the heading. Here is just a bit more text.</p>
                    </div>
                    <div class="col mb-5 mb-md-0 h-100">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="fa-solid fa-viruses"></i></div>
                        <h2 class="h5">Featured title</h2>
                        <p class="mb-0">Paragraph of text beneath the heading to explain the heading. Here is just a bit more text.</p>
                    </div>
                    <div class="col h-100">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="fa-solid fa-triangle-exclamation"></i></div>
                        <h2 class="h5">Featured title</h2>
                        <p class="mb-0">Paragraph of text beneath the heading to explain the heading. Here is just a bit more text.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonial section-->
<div class="py-5 bg-white">
    <div class="container px-5 my-5 reveal">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-10 col-xl-7">
                <div class="text-center">
                    <div class="fs-4 mb-4 fst-italic">"Using Medisoft web application makes your medical interaction easier and more advanced."</div>
                    <div class="d-flex align-items-center justify-content-center">
                        <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d" alt="..." />
                        <div class="fw-bold">
                            Srijan Panta
                            <span class="fw-bold text-primary mx-1">/</span>
                            Student, 77227232
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection