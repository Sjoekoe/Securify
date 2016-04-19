var Vue = require('vue');
var moment = require('moment');

module.exports = Vue.filter('dateTimeFormat', function(date) {
    var dateFormat = window.securify.auth.account ? window.securify.auth.account.date_format : 'DD-MM-Y';
    var timeFormat = window.securify.auth.account ? window.securify.auth.account.time_format : 'HH:MM';

    return moment(date,'YYYY-MM-DDTHH:mm:ss.sssZ').format(dateFormat + ' ' + timeFormat);
});
