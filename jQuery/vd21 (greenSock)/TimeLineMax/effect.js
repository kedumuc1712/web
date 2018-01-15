$(document).ready(function() {
	var keyframe = new TimelineMax();

	keyframe.to($('.node'), 1, {x : 300, scale: 1.5})
	.to($('.node'), 1, {y: 300, scale: 1}, "+=0.2")
	.to($('.node'), 1, {x: -300, rotationX : 360, scale: 1.5}, "+=0.2") // delay 0.2s so voi chuyen dong truoc
	.to($('.node'), 1, { y: -8, rotationY: 360, scale: 1}, "+=0.2")

	// click stop thi ngung chuyen dong
	$('.stop').click(function(event) {
		keyframe.stop();
	});

	// click rum thi tiep tuc chuyen dong
	$('.run').click(function(event) {
		keyframe.play();
	});

	// click reserve thi dao nguoc chuyen dong
	$('.reverse').click(function(event) {
		keyframe.reverse();
	});
});