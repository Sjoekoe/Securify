var Vue = require('vue');
var accountId = window.securify.auth.account ? window.securify.auth.account.id : null;
var keyId = window.securify.key ? window.securify.key : null;
var apiToken = window.securify.auth ? window.securify.auth.jwt : null;

module.exports = Vue.extend({
    template: '#update-key',

    props: ['updatekey'],

    data: function() {
        return {
            error: false,
            errorMessage: '',
            name: '',
            number: '',
            key_code: '',
            description: '',
            submitting: false,
            status: 'Updating Key...',
            errors: [],
            fetching: true,
        }
    },

    ready: function() {
        $.getJSON('/api/accounts/' + accountId + '/keys/' + keyId + '?token=' + apiToken, function (key) {
            this.name = key.data.name;
            this.number = key.data.number;
            this.key_code = key.data.key_code;
            this.description = key.data.description;
            this.fetching = false;
        }.bind(this));
    },

    methods: {
        resetErrorState: function() {
            this.error = false;
        },

        submit: function() {
            this.submitting = true;

            var data = {
                "name": this.name,
                "number": this.number,
                "key_code": this.key_code,
                "description": this.description,
            }

            var vm = this;

            $.ajax({
                url: '/api/accounts/' + accountId + '/keys/' + keyId + '?token=' + apiToken,
                type: 'put',
                data: data,
                error: function (errors) {
                    if (errors.responseJSON.status_code !== 422) {
                        vm.error = true;
                        if (errors.responseJSON.status_code == 403) {
                            vm.errorMessage = 'You have no rights to perform this action.'
                        } else {
                            vm.errorMessage = 'Something went wrong. Please contact support.'
                        }
                    } else {
                        vm.errors = errors.responseJSON.errors;
                    }

                    vm.submitting = false;
                }.bind(vm),
                success: function(key) {
                    vm.status = 'Redirecting...'
                    window.location.replace('/keys');
                }.bind(vm)
            });
        }
    }
});
