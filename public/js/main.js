$(document).ready(function () {
	$('.ui.accordion').accordion();
	$('.ui.dropdown').dropdown();
	$('.ui.checkbox').checkbox();

	$('.message .close').on('click', function () {
		$(this).closest('.message').transition('fade');
	});

	$('.ui.menu.stackable .ui.container > .item').each(function () {
		let currentUrl = window.location.pathname;
		let hrefUrl = getLocation($(this).attr('href')).pathname;

		if (currentUrl === hrefUrl) {
			$(this).addClass('active');
		} else {
			$(this).removeClass('active');
		}
	});
});

let getLocation = function(href) {
	let l = document.createElement("a");
	l.href = href;
	return l;
};