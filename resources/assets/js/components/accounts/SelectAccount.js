var Vue = require('vue');

module.exports = Vue.extend({
    template: '#select-account',

    props: ['selectaccount'],

    data: function() {
        return {
            teams: [],
        }
    },

    ready: function() {
        $.getJSON('/api/users/' + window.securify.auth.user.id + '/teams', function (teams) {
            this.teams = teams.data;
        }.bind(this));
    }
});
