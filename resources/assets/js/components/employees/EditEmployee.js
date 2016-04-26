var Vue = require('vue');
var apiToken = window.securify.auth ? window.securify.auth.jwt : null;

module.exports = Vue.extend({
    template: '#edit-employee',

    props: ['editemployee'],

    data: function() {
        return {
            id: '',
            name: '',
            email: '',
            number: '',
            telephone: '',
            errors: [],
            submitting: false,
            status: 'Updating Employee ...',
            error: false,
            errorMessage: '',
        }
    },

    ready: function() {
        $.getJSON('/api/accounts/' + window.securify.auth.account.id + '/employees/' + window.securify.employee  + '?token=' + apiToken, function (employee) {
            this.name = employee.data.name;
            this.email = employee.data.email;
            this.number = employee.data.number;
            this.telephone = employee.data.telephone;
            this.id = employee.data.id;
        }.bind(this));
    },

    methods: {
        editEmployee: function(employee) {
            this.submitting = true;
            var data = {
                name: this.name,
                email: this.email,
                telephone: this.telephone,
                number: this.number,
            }

            $.ajax({
                url: '/api/accounts/' + window.securify.auth.account.id + '/employees/' + employee  + '?token=' + apiToken,
                type: 'put',
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
