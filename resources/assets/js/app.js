window.$ = window.jQuery = require('jquery');
window.locale = $('html').attr('lang');

Swiper = require('swiper/dist/js/swiper');

require('semantic-ui-css/semantic');
require('semantic-ui-calendar/dist/calendar');
require('timeago/jquery.timeago');
require('timeago/locales/jquery.timeago.' + window.locale);

$(document).ready(function () {
    $('.ui.accordion').accordion();
    $('.ui.dropdown').dropdown();
    $('.ui.checkbox').checkbox();
    $('.ui.progress').progress();
    $('.ui.popup_element').popup();
    $('.ui.progress.ratio').progress({
        label: 'ratio',
        text: {
            ratio: '{value} / {total}',
        },
    });

    $('.message .close').click(function () {
        $(this).closest('.message').transition('fade');
    });

    // Auto open modal with only data attr in HTML
    $('[data-modal]').click(function (e) {
        e.preventDefault();
        $($(this).attr('data-modal')).modal('show');
    });

    // Auto submit form with only data attr in HTML
    $('[data-submit]').click(function (e) {
        e.preventDefault();
        $($(this).attr('data-submit')).submit();
    });

    // Auto show element with only data attr in HTML
    $('[data-show]').click(function (e) {
        e.preventDefault();
        $($(this).attr('data-show')).css('display', 'block');
    });

    // Auto hide element with only data attr in HTML
    $('[data-hide]').click(function (e) {
        e.preventDefault();
        $($(this).attr('data-hide')).css('display', 'none');
    });

    // Auto toggle element with only data attr in HTML
    $('[data-toggle]').click(function (e) {
        e.preventDefault();
        let element = $($(this).attr('data-toggle'));

        if (element.css('display') === 'none') {
            element.css('display', 'block');
            $(this).html($(this).attr('data-hideMessage'));
        } else {
            element.css('display', 'none');
            $(this).html($(this).attr('data-showMessage'));
        }
    });

    $('#reset_form').click(function (e) {
        e.preventDefault();
        $(this).parent().form('clear');
    });

    $('a.activable[href]').each(function () {
        let currentHref = window.location.href;
        let linkHref = $(this).attr('href');

        if (currentHref === linkHref) {
            $(this).addClass('active');
        }
    });

    $('.datetime-picker').calendar({
        firstDayOfWeek: calendarDayOfWeek(),
        text: calendarText(),
    });

    $('.date-picker').calendar({
        firstDayOfWeek: calendarDayOfWeek(),
        text: calendarText(),
        type: 'date',
        formatter: {
            date: calendarDateFormatter(),
        },
    });

    $('.time-picker').calendar({
        firstDayOfWeek: calendarDayOfWeek(),
        text: calendarText(),
        ampm: false,
        type: 'time',
    });

    $('time').timeago();
});

function calendarDateFormatter()
{
    return function (date, settings) {
        if (!date) {
            return '';
        }

        let year = date.getFullYear();
        let month = (date.getMonth() + 1);
        month = month >= 10 ? month : '0' + month;
        let day = date.getDate();

        return year + '-' + month + '-' + day;
    };
}

function calendarDayOfWeek()
{
    if (window.locale === 'fr') {
        return 1;
    } else {
        return 0;
    }
}

function calendarText()
{
    if (window.locale === 'fr') {
        return {
            days: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
            months: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            monthsShort: ['Janv', 'Févr', 'Mars', 'Avr', 'Mai', 'Juin', 'Juill', 'Août', 'Sept', 'Oct', 'Nov', 'Dec'],
            today: 'Aujourd\'hui',
            now: 'Maintenant',
            am: 'AM',
            pm: 'PM',
        };
    } else {
        return {
            days: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
            months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            today: 'Today',
            now: 'Now',
            am: 'AM',
            pm: 'PM',
        };
    }
}