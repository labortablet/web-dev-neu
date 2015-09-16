$(document).ready(function() {

	$('.rowlink td').click(function() {
		var redirect = !$(this).hasClass("rowlink-skip");
		console.log(redirect);

		if (redirect) {
			var href = $(this).parent().attr("href");
			if (href) {
				window.location = href;
			}
		}
	});
});