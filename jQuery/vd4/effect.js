$(function() {
	$(".contentBlock").slideUp();

	$(".headBlock").click(function(event) {
		$(this).toggleClass("changeColor");
		$(this).next().slideToggle(700);
		$(body).animate({scrollTop: $(this).offset().top},5000);
	});

	$('.lavender').click(function(event) {
		$(this).toggleClass('scale_image');
	});

	
});