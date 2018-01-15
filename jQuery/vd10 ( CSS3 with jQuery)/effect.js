/*Xu ly click xong roi den xu ly class*/

$(function() {
	// click vao nut thi hien ra cua so va hinh ne mo
	$(".node").click(function(event) {
		$(".pop-up").addClass("hienRa");

		$(".hidden").addClass("hienRa-hidden");
	});

	// CLick vao nut close thi dong lai cac cua so
	$(".close").click(function(event) {
		$(".pop-up").removeClass("hienRa");

		$(".hidden").removeClass("hienRa-hidden");
	});

	$(".hidden").click(function(event) {
		$(".pop-up").removeClass("hienRa");

		$(".hidden").removeClass("hienRa-hidden");
	});
});