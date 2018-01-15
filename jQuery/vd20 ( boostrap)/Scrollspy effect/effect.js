$(document).ready(function() {
	$('body').scrollspy({
		target: '.menu'
	})

	// kich hoat wow js
	new WOW().init();

	$('.menu ul li a').click(function(event) {
		var position = $(this).attr('href');
		var Oxy = $(position).offset().top;

		$('body').animate({scrollTop: Oxy});
		return false;
	});
});