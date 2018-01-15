/* Cau lenh Jquery thuong tao boi 3 phan 
	B1: Lua chon phan tu
	B2: Su kien tuong tac
	B3: Xu ly hieu ung
*/

$(function() {
	// dau tien la chua co gi hien ra
	// An class dang ky di khi load lai trang
	$('.dangky').animate({
		opacity:0,
		marginLeft:-100
	});

	// Khi Click vao .nutso2
	$('.nutso2').click(function(event) {
		
		// .dangnhap duoc an di
		$('.dangnhap').animate({
			opacity: 0,
			marginLeft: -100
		});

		// .dangky hien ra
		$('.dangky').animate({
			opacity:1,
			marginLeft: 0
		});
	});

	$('.nutso1').click(function(event) {
		
		$('.dangky').animate({
			opacity: 0,
			marginLeft: -100
		});

		$('.dangnhap').animate({
			opacity:1,
			marginLeft: 0
		});
	});
});