/*Cach lam :
+ class active la class ma image dang Hien thi
+ class turnLeft lam slide dang hien truot sang trai
+ class goToMid lam slide ke tiep truot vao trung tam
+ Sau do class active lai dang remove la chuyen sang phan tu ke tiep  var continued = $(".active").next();
*/

/*.next khi click
+ turnLeft: slide dang hien thi truot sang ben trai va hidden
+ goToMid: slide tiep theo truot tu ben phai vao giua
.prev khi click
+ turnRight: slide dang hien thi truot sang ben phai va hidden
+ rightToMid: slide tiep theo truot tu ben trai vao giua
*/

$(function() {

	/*Cu sau 3s thi tu dong goi ham click class next*/
	/*timeWait = setInterval(function() {
		$('.next').trigger('click');
	}, 3000)
*/



	$(".next").click(function(event) {
		// Khi click vao nut .next thi huy ham setInterval
		clearInterval(timeWait);

		// Xu ly phan nut tron dich chuyen
		var position = $('.circle').index() + 1;
		$('.buttonSlide ul li').removeClass('circle');

		if ( position === $('.buttonSlide ul li').length) {
			position = 0;
		}

		$('.buttonSlide ul li:nth-child('+ (position + 1) +')').addClass('circle');


		// Bien continued bang class ke tiep cua vung chon
		var continued = $(".active").next();

		//Khi den slide cuoi cung thi
		if (continued.length === 0){
				$(".active").addClass("turnLeft").one('webkitAnimationEnd', function(event) {
					$(".turnLeft").removeClass("turnLeft");
				});;

				$(".slide:first").addClass('goToMid').one('webkitAnimationEnd', function(event) {
					
					$(".slide:last").removeClass('active');

					$('.goToMid').addClass('active').removeClass('goToMid');
				});;
		}
		else {
			// Anh truot sang ben trai va hidden
			// thuoc tinh one wait chuyen dong ket thuc roi thuc hien ham removeClass
			$(".active").addClass("turnLeft").one('webkitAnimationEnd', function(event) {
				$(".turnLeft").removeClass("turnLeft");
			});;

			// Thuc hien chuyen dong cho slide ke tiep
			continued.addClass('goToMid').one('webkitAnimationEnd', function(event) {
				// Khi chuyen dong ket thuc thi remove .active, add .active va remove .goToMid
				$(".active").removeClass('active');
				$(".goToMid").addClass('active').removeClass('goToMid');
			});;
		}
	});

	$(".prev").click(function(event) {

		clearInterval(timeWait);
		
		var position = $('.circle').index() + 1;
		$('.buttonSlide ul li').removeClass('circle');

		if ( position === 1) {
			position = $('.buttonSlide ul li').length + 1;
		}

		$('.buttonSlide ul li:nth-child('+ (position - 1) +')').addClass('circle');




		var previous = $(".active").prev();

		if (previous.length === 1) {
			$(".active").addClass("turnRight").one('webkitAnimationEnd', function(event) {
				$(".turnRight").removeClass("turnRight");
			});;

			previous.addClass('rightToMid').one('webkitAnimationEnd', function(event) {
				$(".active").removeClass('active');
				$(".rightToMid").addClass('active').removeClass('rightToMid');
			});;

		}
		// khi tu slide 1 kui lai slide cuoi
		else {
			$(".active").addClass("turnRight").one('webkitAnimationEnd', function(event) {
				$(".turnRight").removeClass("turnRight");
			});;

			$('.slide:last-child').addClass('rightToMid').one('webkitAnimationEnd', function(event) {
				$(".active").removeClass('active');
				$(".rightToMid").addClass('active').removeClass('rightToMid');
			});
		}
	});

	// Xu ly khi click vao cac nut tron
	$(".buttonSlide ul li").click(function(event) {
		// Tat ca cac nut tron tro lai ban dau
		$(".buttonSlide ul li").removeClass('circle');
		// Nut tron dang duoc click thi thanh circle
		$(this).addClass('circle');

		console.log($('.circle').prev().index() + 1);
		console.log($('.circle').index() + 1);

		if ( $('.circle').prev().index() + 1  <  $('.circle').index() + 1  ) {

			$('.slide:nth-child(' + ($(this).index() + 1) +')').addClass('goToMid').one('webkitAnimationEnd', function(event) {
				
				$('.active').removeClass('active');

				$('.goToMid').addClass('active').removeClass('goToMid');
			});
		}
		else if ( $('.circle').prev().index() + 1  ===  $('.circle').index() + 1 ){
			// do nothing
		}

		else {
			$('.slide:nth-child(' + ($(this).index() + 1 ) +')').addClass('goToMid').one('webkitAnimationEnd', function(event) {
				
				$('.active').removeClass('active');

				$('.goToMid').addClass('active').removeClass('goToMid');
			});
		}
	});

});