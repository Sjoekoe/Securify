
var Vue = require('vue');

new Vue({
    el: 'body',

    components: {
        selectaccount: require('./components/accounts/SelectAccount'),
        usersettings: require('./components/users/Settings'),
    }
});
