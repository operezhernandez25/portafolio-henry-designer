/*jslint browser:true */
$(document).ready(function () {

	var $scrollButton = $('.scroll');
	

	

	// Smooth scroll to content
	$scrollButton.on('click', function (e) {
		e.preventDefault();
		var $link = $(this).attr('href');
		$('html, body').animate({
			scrollTop: $($link).offset().top
		}, 900);
	});

	
});