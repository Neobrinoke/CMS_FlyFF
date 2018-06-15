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

	$('.message .close').click(function () {
		$(this).closest('.message').transition('fade');
	});

	// Auto open modal with only data attr in HTML
	$('[data-modal]').click(function (e) {
		e.preventDefault();
		$($(this).attr('data-modal')).modal('show');
	})

	// Auto submit form with only data attr in HTML
	$('[data-submit]').click(function (e) {
		e.preventDefault();
		$($(this).attr('data-submit')).submit();
	})
});

let getLocation = function (href) {
	let l = document.createElement("a");
	l.href = href;
	return l;
};