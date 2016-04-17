var Vue = require('vue');

module.exports = Vue.extend({
    template: '#create-employee',

    props: ['createemployee'],

    data: function() {
        return {
            name: '',
            email: '',
            number: '',
            telephone: '',
            errors: [],
            submitting: false,
            status: 'Creating Employee ...',
            error: false,
            errorMessage: '',
        }
    },

    ready: function() {

    },

    methods: {
        createEmployee: function() {
            this.submitting = true;
            var data = {
                name: this.name,
                email: this.email,
                telephone: this.telephone,
                number: this.number,
            }

            $.ajax({
                url: '/api/accounts/' + window.securify.auth.account.id + '/employees',
                type: 'post',
                data: data,
                error: function(errors) {
                    if (errors.responseJSON.status_code !== 422) {
                        this.error = true;
                        if (errors.responseJSON.status_code == 403) {
                            this.errorMessage = 'You have no rights to perform this action.'
                        } else {
                            this.errorMessage = 'Something went wrong. Please contact support.'
                        }
                    } else {
                        this.errors = errors.responseJSON.errors;
                    }

                    this.submitting = false;
                }.bind(this),
                success: function(employee) {
                    this.status = 'Redirecting ...'

                    window.location.replace('/employees');
                }
            })
        }
    }
});
