window.addEventListener("scroll", reveal);
function reveal() {
 var reveals = document.querySelectorAll(".reveal");


 for (var i = 0; i < reveals.length; i++) {
   var windowHeight = window.innerHeight;
   var elementTop = reveals[i].getBoundingClientRect().top;
   var elementVisible = 50;

   if (elementTop < windowHeight - elementVisible) {
     reveals[i].classList.add("isActive");
   } else {
     reveals[i].classList.remove("isActive");
   }
 }
}



function readURL(input) {
   if (input.files && input.files[0]) {
 
     var reader = new FileReader();
 
     reader.onload = function(e) {
       $('.image-upload-wrap').hide();
 
       $('.file-upload-image').attr('src', e.target.result);
       $('.file-upload-content').show();
 
       $('.image-title').html(input.files[0].name);
     };
 
     reader.readAsDataURL(input.files[0]);
 
   } else {
     removeUpload();
   }
 }
 
 function removeUpload() {
   $('.file-upload-input').replaceWith($('.file-upload-input').clone());
   $('.file-upload-content').hide();
   $('.image-upload-wrap').show();
 }
 $('.image-upload-wrap').bind('dragover', function () {
       $('.image-upload-wrap').addClass('image-dropping');
    });
    $('.image-upload-wrap').bind('dragleave', function () {
       $('.image-upload-wrap').removeClass('image-dropping');
 });

 
 //Password Toggle
 const togglePassword = document.getElementById("togglePassword");
 const password = document.getElementById("password");
 var i=0;

 togglePassword.addEventListener("click", toggleFunction);

 function toggleFunction()
 {
     // toggle the type attribute
     const type = password.getAttribute("type") === "password" ? "text" : "password";
     password.setAttribute("type", type);
     
     // toggle the icon
     if(i==0)
     {
       this.classList.replace("fa-eye-slash","fa-eye");
   i=1;
     }
     else
     {
       this.classList.replace("fa-eye","fa-eye-slash");
   i=0;
     }
 };
 

 

 function phoneNo()
 {
   
    const phoneNumber= document.getElementById("phoneNumber");
    const countryCode = document.getElementById("countryCode");
    countryCode.style.display = "block";
    phoneNumber.classList.add("phoneNoInput");
    phoneNumber.placeholder="";
 }
 

