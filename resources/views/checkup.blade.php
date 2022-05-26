@extends('dashboard.index')

@section('dashboardContent')
<div style="width: 100%; height:120vh; overflow: hidden">
<iframe frameborder="0" src="https://symptomate.com/diagnosis/0" scrolling="no" title="description" width="100%" style=" position:relative; top:-110px; overflow:hidden; height:150vh"></iframe>
</div>

<script>
var x = document.getElementById("demo");
window.onload = getLocation();
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}
function showPosition(position) {
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
}
</script>

@endsection