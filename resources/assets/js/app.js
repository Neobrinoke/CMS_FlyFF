try {
    window.$ = window.jQuery = require('jquery');
    Swiper = require('swiper/dist/js/swiper');

    require('semantic-ui-css/semantic');
    require('semantic-ui-calendar/dist/calendar');
    require('timeago/jquery.timeago');
    require('timeago/locales/jquery.timeago.fr');
    require('./main');
} catch (e) {}