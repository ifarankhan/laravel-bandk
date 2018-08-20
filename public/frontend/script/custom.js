//
$(document).ready(function(){
equalheight('.column');
	$(".sideNav").css("height",$(".column").height() + 40 + "px")

	//
//	 
//		$(.sideNav ul li ).click(function() {
//  if ( $( "ul.child_menu" ).is( ":hidden" ) ) {
//    $( "ul.child_menu" ).show( "slow" );
//  } else {
//    $( "ul.child_menu" ).slideUp();
//  }
//	
//	
// });
//    });
$(".sideNav button").click(function(){
		$(".sideNav").toggleClass('open');
	});
    
    
$('.sideNav ul li').click(function() {

	if (!$(this).hasClass('active')) {
        $('.sideNav ul li').removeClass('active');

        $(this).addClass('active');
	//$(this).toggleClass('active');
	}
	/*if ($(this).hasClass('active')) {
	    $('.sideNav ul li').removeClass('active');
	    $(this).find('ul.child_menu').toggle();
	//$(this).toggleClass('active');
	} else {
		$('.sideNav ul li').removeClass('active');

		$(this).addClass('active');
	}*/
	
    //e.preventDefault();

//    if ($(this).hasClass('active')) {
//        $('.sideNav ul li.active ul.child_menu').slideUp('slow');
//        $('.sideNav ul li').removeClass('active');
//    } else {
//        $(this + 'ul.child_menu').slideDown('slow');
//        $('.sideNav ul li').removeClass('active');
//        $(this).addClass('active');
//
//     
//      
//    }
});
});
equalheight = function(container){

var currentTallest = 0,
     currentRowStart = 0,
     rowDivs = new Array(),
     $el,
     topPosition = 0;
 $(container).each(function() {

   $el = $(this);
   $($el).height('auto')
   topPostion = $el.position().top;

   if (currentRowStart != topPostion) {
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
     }
     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);
   } else {
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
  }
   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
   }
 });
}



$(window).resize(function(){
  equalheight('.column');
});
