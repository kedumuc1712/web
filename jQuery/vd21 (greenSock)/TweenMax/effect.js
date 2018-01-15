$(document).ready(function() {
	/*TweenMax.to, TweenMax.from, TweenMax.fromTo*/
	TweenMax.from($('.node1'), 0.75, { x: -200, opacity: 0, scale: 2});
	TweenMax.from($('.node2'), 0.75, { y: 400, opacity: 0, scale: 2});
	TweenMax.from($('.node3'), 0.75, { x: 200, opacity: 0, scale: 2});

	$('.btn-group').click(function(event) {
		// click vao la tut xuong 100px, to len 5%
		TweenMax.to($(this), 1.5, { y: "+= 100", scale: "+= 0.05"});
	});

	/*Vung chon, thoi gian hieu ung, thuoc tinh, thoi gian delay
	Dat trong ham nen luc nao ap dung thi goi ham staggerFrom();*/
	function staggerFrom() {
		TweenMax.staggerFrom($('.btn-success'), 2, { y : 500, opacity: 0, ease: Elastic.easeOut}, 0.5); // chuyen dong gia toc
	}
	

	/*https://greensock.com/ease-visualizer*/
	TweenLite.to($('.btn-success'), 2.5, { ease: Power4.easeOut, rotation: 360 });

});