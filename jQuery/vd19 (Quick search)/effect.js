$(function() {
	// Sap xep cac anh xen ke nhau bang thu vien isotope
	$('.content ul').isotope({
		itemSelector: 'li'
	});

	//Code cho quick search .keyword
	$('.keyword').keypress(function(event) {
		// ma ANSCII
		if (event.keyCode == '13') {
			var input = $('.keyword').val();
			input = "." + input;
		    console.log(input);
		    $('.content ul').isotope({filter: input});
		 }
	});

	// Tu dong quet sau 200ms, thuc hien lenh ko can an enter
	var time = setInterval(function(){
		var input = $('.keyword').val();
		input = "." + input;
		$('.content ul').isotope({filter: input});
	}, 200) 


	//Khi click vao nut
	$('nav ul li a').click(function(event) {

		var image = $(this).data('class');

		var name = $(this).text();

		// Neu data-class la 'all' thi show ra tat ca anh
		if (image === 'all') {
			$('section h1').text("All Images");

			$('.content ul').isotope({
				filter: '*'
			})
		}
		// Neu data-class # all thi show ra anh tung loai: nguoi, phong canh,...
		else {
			$('section h1').text(name);

			$('.content ul').isotope({filter:image});
		}

		return false;
	});
});