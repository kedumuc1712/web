$(function() {
	$(window).scroll(function(event) {
		var vitribody = $('body').scrollTop();
		var vitriGiaoDien = $('.giaodien').offset().top;

        // thuc hien hieu ung truoc moc 1 khoang 300px
		if (vitribody >= vitriGiaoDien - 400) {
			$('.giaodien').addClass('fadeInDownBig animated'); // bounceInLeft trong thu vien animate

		}
	});
});