$(document).ready(function(){

	$("#slideshow > div:gt(0)").hide();

var buttons = "<button class=\"slidebtn prev\">Prev</button><button class=\"slidebtn next\">Next</button\>";

$("#slideshow").append(buttons);
var interval = setInterval(slide, 3000);

function intslide(func) {
	if (func == 'start') { 
 	interval = setInterval(slide, 3000);
	} else {
		clearInterval(interval);		
		}
}

function slide() {
		tran('next', 0, 1200);
}
	
function tran(a, ix, it) {
        var currentSlide = $('.current');
        var nextSlide = currentSlide.next('.slideitem');
        var prevSlide = currentSlide.prev('.slideitem');
		    var reqSlide = $('.slideitem').eq(ix);// eq: elementul cu indexul

		    
		
        if (nextSlide.length == 0) {
            nextSlide = $('.slideitem').first();
            }

        if (prevSlide.length == 0) {
            prevSlide = $('.slideitem').last();
            }
			
		if (a == 'next') {
			var Slide = nextSlide;
			}
			else if (a == 'prev') {
				var Slide = prevSlide;
				}
				else {
					var Slide = reqSlide;
					}

        currentSlide.fadeOut(it).removeClass('current');
        Slide.fadeIn(it).addClass('current');
		
    	
}	

$('.next').on('click', function(){
		intslide('stop');						
		tran('next', 0, 400);
		intslide('start');						
	});//next

$('.prev').on('click', function(){
		intslide('stop');						
		tran('prev', 0, 400);
		intslide('start');						
	});//prev


});
