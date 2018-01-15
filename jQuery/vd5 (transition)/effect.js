$(function() {

	//Cho cac phan tu .global chuyen dong tu duoi len trong 0.5s, moi cai cach nhau 0.1s
	TweenMax.staggerFrom($(".global"), 0.5,{top: 100, opacity:0}, 0.1)
});