var Vue = require('vue');
var accountId = window.securify.auth.account ? window.securify.auth.account.id : null;

module.exports = Vue.extend({
    template: '#create-key',

    props: ['createkey'],

    data: function() {
        return {
            error: false,
            errorMessage: '',
            name: '',
            number: '',
            key_code: '',
            description: '',
            submitting: false,
            status: 'Creating Key...',
            errors: [],
        }
    },

    ready: function() {

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
                url: '/api/accounts/' + accountId + '/keys',
                type: 'post',
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
