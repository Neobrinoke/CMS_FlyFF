$(document).ready(function () {
	$('.ui.accordion').accordion();
	$('.ui.dropdown').dropdown();
	$('.ui.checkbox').checkbox();

	$('.message .close').on('click', function () {
		$(this).closest('.message').transition('fade');
	});
});