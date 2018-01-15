/* Cac ham can dung
1) Ham xu ly su kien chuot: click
2) Ham addClass
3) Hieu ung cuon chuot cho body: .animate({
	scrollTop: 900
})

4) Ham tinhvi tri mot phan tu: $(tenphantu).offset.top
5 ) console.log */
$(function() {
	$(".menu ul li:nth-child(1) a").on("click", function(event) {
		event.preventDefault();
		
		// $(".chapter1").offset().top : Tinh toan vi tri tu tren den vung chon
		/*cuon xuong x pixel va thoi gian 400ms va hieu ung tu thu vien easing jquery*/
		$("body").animate({ scrollTop: $(".chapter1").offset().top }, 400,"easeInOutElastic"); 
	});

	$(".menu ul li:nth-child(2) a").on("click", function(event) {
		event.preventDefault();
		$("body").animate({ scrollTop: $(".chapter2").offset().top }, 400);
	});

	$(".menu ul li:nth-child(3) a").on("click", function(event) {
		event.preventDefault();
		$("body").animate({ scrollTop: $(".chapter3").offset().top }, 400); 
	});

	$(".menu ul li:nth-child(4) a").on("click", function(event) {
		event.preventDefault();
		$("body").animate({ scrollTop: $(".chapter4").offset().top }, 400); 
	});

	$(".buttonUp").on('click', function(event) {
		event.preventDefault();
		$("body").animate({scrollTop : 0}, 400);
	});

});
	
	
