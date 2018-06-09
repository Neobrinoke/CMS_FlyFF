$(document).ready(function () {
	$('.ui.accordion').accordion();

	$('.message .close').on('click', function () {
		$(this).closest('.message').transition('fade');
	});
});