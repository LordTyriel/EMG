function cycleImages(){
      var $active = $('#img_cycler .active');
      var $next = ($('#img_cycler .active').next().length > 0) ? $('#img_cycler .active').next() : $('#img_cycler img:first');
      $next.css('z-index',1);//move the next image up the pile
	  $active.fadeOut(1500,function(){//fade out the top image
	  $active.css('z-index',-1).show().removeClass('active');//reset the z-index and unhide the image
      $next.css('z-index',3).addClass('active');//make the next image the top one
      });
    }

    $(window).load(function(){
		$('#img_cycler').fadeIn(4000);//fade the img back in once all the images are loaded
		  // run every 7s
		  setInterval('cycleImages()', 1500);
    })