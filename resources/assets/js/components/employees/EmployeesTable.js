var Vue = require('vue');

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
        $.getJSON('/api/accounts/' + securify.auth.account.id + '/employees', function(employees) {
            this.employees = employees.data;
        }.bind(this));

        this.fetching = false;
    },

    methods: {
        removeEmployee: function(employee) {
            this.employees.$remove(employee);
            $.ajax({
                url: '/api/accounts/' + securify.auth.account.id + '/employees/' + employee.id,
                type: 'post',
                data: {_method: 'delete'},
            });
        }
    }
});
