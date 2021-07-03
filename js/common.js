$(document).ready(function() {

	//back to top
	$('.back-to-top').hide();
	//Check to see if the window is top if not then display button
	$(window).scroll(function () {
		if ($(this).scrollTop() > 700) {
			$('.back-to-top').fadeIn();
		} else {
			$('.back-to-top').fadeOut();
		}
	});
	//Click event to scroll to top
	$('.back-to-top').click(function () {
		$('html, body').animate({ scrollTop: 0 }, 800);
		return false;
	});
	$(".down").click(function() {
    	$('html, body').animate({
       		scrollTop: $("#home").offset().top
    	}, 800);
	});
	
	$('a.popimg').magnificPopup({
		type:'image',
		mainClass: 'mfp-fade',
		removalDelay: 800,
	});
	
	$(document).foundation();
	
	$('.socialbtn a, .ptitle a, .bsocialbtn a').append('<span class="hover"></span>').each(function () {
		var $span = $('> span.hover', this).css('opacity', 0);
		$(this).hover(function (){
			$span.stop().fadeTo(500, 1);
		},
		function (){
	    $span.stop().fadeTo(500, 0);
	  });

	
	$('.allservbtn a').hover(
    	function (){ 
        	$(this).stop().animate({ 'background-color': '#54c1ec' }, 1000 );
    	},
    	function () { 
        	$(this).stop().animate({ 'background-color': '#adc646' }, 1000 );
    	}
	);
	$('.smsbtn a').hover(
    	function () { 
        	$(this).stop().animate({ 'background-color': '#adc646' }, 1000 );
    	},
    	function () { 
        	$(this).stop().animate({ 'background-color': '#fe7676' }, 1000 );
    	}
	);
	$('input[type=submit]').hover(
    	function () { 
        	$(this).stop().animate({ 'background-color': '#54c1ec' }, 1000 );
    	},
    	function () { 
        	$(this).stop().animate({ 'background-color': '#adc646' }, 1000 );
    	}
	);
	});
	
	
	$(".curbox").hover(function(){
		if (!$(this).hasClass('animated')) {
			$(this).find(".pcont").dequeue().stop().slideDown({ duration: 500, easing: "easeOutBack" });
		}
	}, function() {
    	$(this).find(".pcont").addClass('animated').slideUp(300, "easeInCirc", function() {
			$(this).find(".pcont").removeClass('animated').dequeue();
			});
	});
	
	$(".pbox").hover(function(){
		if (!$(this).hasClass('animated')) {
			$(this).find(".pcont").dequeue().stop().slideDown({ duration: 500, easing: "easeOutBack" });
		}
	}, function() {
    	$(this).find(".pcont").addClass('animated').slideUp(300, "easeInCirc", function() {
			$(this).find(".pcont").removeClass('animated').dequeue();
			});
	});

});