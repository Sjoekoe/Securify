var Vue = require('vue');
var apiToken = window.securify.auth ? window.securify.auth.jwt : null;

module.exports = Vue.extend({
    template: '#employees-table',

    props: ['employeestable'],

    data: function() {
        return {
            fetching: true,
            employees: [],
        }
    },

    ready: function() {
        $.getJSON('/api/accounts/' + securify.auth.account.id + '/employees?token=' + apiToken, function(employees) {
            this.employees = employees.data;
        }.bind(this));

        this.fetching = false;
    },

    methods: {
        removeEmployee: function(employee) {
            this.employees.$remove(employee);
            $.ajax({
                url: '/api/accounts/' + securify.auth.account.id + '/employees/' + employee.id + '?token=' + apiToken,
                type: 'post',
                data: {_method: 'delete'},
            });
        }
    }
});
