$(document).ready(function() {
	var keyframe = new TimelineMax();

	keyframe.from($('.loading'), 0.7, {opacity: 0})
	.from($('.running'), 1, {scale: 2, opacity: 0})

	// lap lai
	.to($('.running'), 1, {scale: 0.3, ease:Power4.easeOut})  
	.to($('.running'), 1, {scale: 1, ease:Elastic.easeOut}) 
	.to($('.running'), 1, {scale: 0.3, ease:Power4.easeOut})  
	.to($('.running'), 1, {scale: 1, ease:Elastic.easeOut}) 
	.to($('.running'), 1, {scale: 0.3, ease:Power4.easeOut})  
	.to($('.running'), 1, {scale: 1, ease:Elastic.easeOut}) 

	//ket thuc
	.to($('.running'),1, {scale: 7, opacity: 0})
	.to($('.loading'), 1, {x : -2000, ease:Power1.easeOut})


});