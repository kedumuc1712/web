$(function() {
	$('nav ul li a').click(function(event) {
		var image_type = $(this).data('class');
		console.log(image_type);

		var name = $(this).text();

		$('section h1').text(name);

		// Nhan vao nut nao thi hien ra cac anh thuoc loai do ( vd anh phong canh)
		$('.content ul li').each(function(index, el) {
			if ( $(this).hasClass(image_type)) {
				$(this).show(300);
			}
			else {
				$(this).hide(300);
			}
		});
		
		return false;
	});
});