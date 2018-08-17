try {
    window.$ = window.jQuery = require('jquery');
    window.locale = $('html').attr('lang');

    console.log(window.locale);

    Swiper = require('swiper/dist/js/swiper');

    require('semantic-ui-css/semantic');
    require('semantic-ui-calendar/dist/calendar');
    require('timeago/jquery.timeago');
    require('timeago/locales/jquery.timeago.' + window.locale);
    require('./main');
} catch (e) {}