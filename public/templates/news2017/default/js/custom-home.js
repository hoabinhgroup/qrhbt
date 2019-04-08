$(document).ready(function(){
 $("#owl-clients").owlCarousel({
    nav : false,
     items : 8,
     navText: false,
      autoplay :true,
      smartSpeed:100,
   autoplayHoverPause :true,
    responsiveRefreshRate: true,
	  responsiveClass: true,
	  autoHeightClass: 'owl-height-clients',
	  responsive : {
          0 : {
              items: 1
          },
          150 : {
              items: 2
          },
          300 : {
              items: 3
          },
          450 : {
              items: 4
          },
          600 : {
              items: 5
          },
          750 : {
              items: 6
          },
          900 : {
              items: 7
          }
          ,
          1100 : {
              items: 8
          }
       
      }

  });
  
 
   $("#owl-profile").owlCarousel({
   	 nav : true,
     items : 3,
     navText: ['<a class="left carousel-control" data-slide="prev"> <img src="http://hoabinh-group.com/public/templates/news2017/default/img/btn-l.png" /> </a>','<a data-slide="next" class="right carousel-control"><img src="http://hoabinh-group.com/public/templates/news2017/default/img/btn-r.png" /></a>'],
      autoplay :true,
      smartSpeed:100,
	  autoplayHoverPause :true,
	  responsiveRefreshRate: true,
	  responsiveClass: true,
	  responsive : {
          0 : {
              items: 1
          },
          768 : {
              items: 2
          },
          960 : {
              items: 3
          }
       
      }
   
	  
  });
  });
 /* 
 $(".promotions").bootstrapNews({
            newsPerPage: 6,
            autoplay: true,
            pauseOnHover: true,
            navigation: false,
            direction: 'down',
            newsTickerInterval: 2500
        });
        
		$(document).ready(function(){
      $('.carousel-clients').carousel({
         interval: 3000
      }); 
   });
   
  */
   
   