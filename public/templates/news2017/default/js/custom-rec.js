$(document).ready(function(){
    $("#owl-video").owlCarousel({
    nav : false,
     items : 1,
     navText: false,
      autoPlay :true,
   autoplayHoverPause :true
  });
  
  var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
if (isMobile) {
  $(".news-description-detail > .description > table").css("width","100%");
  $(".news-description-detail > .description > table > tbody > tr > td").css("padding","5px");
  
   $(".news-description-detail > .description > p > iframe").css("width","100%");
   $(".news-description-detail > .description > p > iframe").css("height","150px");
 
   }
     $(".news-description-detail > .description > div > img").css("width","100%");
   $(".news-description-detail > .description > div > img").css("height","auto");
   });