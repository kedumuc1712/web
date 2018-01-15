$(function() {
	$(window).scroll(function(event) {
		
		var vitri = $("body").scrollTop();

		if ( vitri >= 400) {
			$('.menutren').addClass('bienhinh');
		}

		else {
			$('.menutren').removeClass('bienhinh');
		}

		if ( vitri >= 700){
			$('.mtrai ul li:first-child').addClass('sevice');
		}
		else {
			$('.mtrai ul li:first-child').removeClass('sevice');
		}
	});
});