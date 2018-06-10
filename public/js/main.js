$(document).ready(function () {
	$('.ui.accordion').accordion();
	$('.ui.dropdown').dropdown();
	$('.ui.checkbox').checkbox();
	$('.ui.progress').progress();
	$('.ui.progress.ratio').progress({
		label: 'ratio',
		text: {
			ratio   : '{value} / {total}'
		}
	});

	$('.message .close').on('click', function () {
		$(this).closest('.message').transition('fade');
	});
});

let getLocation = function (href) {
	let l = document.createElement("a");
	l.href = href;
	return l;
};