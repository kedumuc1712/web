$(function() {
	// Sap xep cac anh xen ke nhau bang thu vien isotope
	$('.content ul').isotope({
		itemSelector: 'li'
	});

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