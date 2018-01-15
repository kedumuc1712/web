$(function() {
	//Cho cac phan tu thu lai noi dung, chi con tieu de
	$('.content').slideUp();

	//Click vao the h3
	$('.table h3').click(function(event) {
		console.log('Da Click roi!');

		// Sau khi click vao mot h3 thi dong noi dung cua cac phan h3 con lai ma dang xo ra
        //$('.content').slideUp();

		// Khi click vao h3 thi xo ra tat ca noi dun noi dung
		//$('.content').slideDown();

		// Xo ra chi 1 minh noi dung cua phan vua click vao
		//$(this).next().slideDown();

		// Click vao lan 1 thi xo ra, click lan 2 thi dong lai
		$(this).next().slideToggle();
	
		// CLick vao h3 thi doi mau, click lai thi mat mau ( them mot class)
		$(this).toggleClass('blue'); // tao ra class moi h3.blue
	
	});
});