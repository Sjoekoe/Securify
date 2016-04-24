var Vue = require('vue');
var accountId = window.securify.auth.account ? window.securify.auth.account.id : null;

module.exports = Vue.extend({
    template: '#key-overview',

    props: ['keyowerview'],

    data: function() {
        return {
            fetching: true,
            keys: [],
        }
    },

    ready: function() {
        this.fetchRecords();
    },

    methods: {
        refresh: function() {
            this.fetching = true;

            this.fetchRecords();
        },

        fetchRecords: function() {
            $.getJSON('/api/accounts/' + accountId + '/keys', function (keys) {
                this.keys = keys.data;
                this.fetching = false;
            }.bind(this));
        },

        removeKey: function (key) {
            this.keys.$remove(key);
            this.successMessage = 'The key has been removed.'

            $.ajax({
                url: '/api/accounts/' + accountId + '/keys/' + key.id,
                type: 'post',
                data: {_method: 'delete'},
            });
        }
    }
});
