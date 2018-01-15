$(function() {
	$(".noiDungThem").slideUp();

	$(".load").click(function(event) {
    	$(".noiDungThem").slideDown(0); 
    	$("body").animate({ scrollTop: 600}, 200); //600px, 200ms
	});
});