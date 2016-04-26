var Vue = require('vue');
var moment = require('moment');
var apiToken = window.securify.auth ? window.securify.auth.jwt : null;

module.exports = Vue.extend({
    template: '#visits-table',

    props: ['visitstable'],

    data: function() {
        return {
            fetching: true,
            visits: {},
            success: false,
            successMessage: '',
        }
    },

    ready: function() {
        this.fetchAllRecords();
    },

    methods: {
        removeVisitor: function(visitor) {
            this.visits.$remove(visitor);
            this.successMessage = 'The visitor has been removed.'
            this.success = true;

            $.ajax({
                url: '/api/accounts/' + window.securify.auth.account.id + '/visits/' + visitor.id + '?token=' + apiToken,
                type: 'post',
                data: {_method: 'delete'},
            });
        },

        resetSuccessState: function() {
            this.success = false;
        },

        checkin: function(index, visitor) {
            var date = moment().format('DD/MM/YYYY');

            var data = {
                arrival: date,
            }
            var vm = this;

            $.ajax({
                url: '/api/accounts/' + window.securify.auth.account.id + '/visits/' + visitor.id + '?token=' + apiToken,
                method: 'put',
                data: data,
                success: function(visitor) {
                    vm.visits[index].arrival = visitor.data.arrival;
                    vm.successMessage = visitor.data.visitorRelation.data.name + ' is checked in.';
                    vm.success = true;
                }
            });
        },

        checkout: function(index, visitor) {
            var date = moment().format('DD/MM/YYYY');

            var data = {
                departure: date,
            }
            var vm = this;

            $.ajax({
                url: '/api/accounts/' + window.securify.auth.account.id + '/visits/' + visitor.id + '?token=' + apiToken,
                method: 'put',
                data: data,
                success: function(visitor) {
                    vm.visits[index].departure = visitor.data.departure;
                    vm.visits[index].is_completed = visitor.data.is_completed;
                    vm.successMessage = visitor.data.visitorRelation.data.name + ' is checked out.';
                    vm.success = true;
                }
            });
        },

        refresh: function() {
            this.fetching = true;
            this.fetchAllRecords();
        },

        fetchAllRecords: function() {
            $.getJSON('/api/accounts/' + window.securify.auth.account.id + '/visits?token=' + apiToken, function (visits) {
                this.visits = visits.data;
                this.fetching = false;
            }.bind(this));
        }
    }
});
