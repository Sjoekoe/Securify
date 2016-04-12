
var Vue = require('vue');

new Vue({
    el: 'body',
    
    components: {
        login: require('./components/auth/Register'),
    }
});
