var Vue = require('vue');

module.exports = Vue.extend({
    template: '#user-settings',

    props: ['usersettings'],

    data: function() {
        return {
            name: '',
            email: '',
            errors: [],
            submitting: false,
            success: false,
            error: false,
            errorMessage: '',
        }
    },

    ready: function() {
        $.getJSON('/api/users/' + window.securify.auth.user.id, function(user) {
            this.name = user.data.name;
            this.email = user.data.email;
        }.bind(this));
    },

    methods: {
        update: function(e) {
            e.preventDefault();

            this.submitting = true;
            this.error = false;
            this.success = false;

            var data = {
                name: this.name,
                email: this.email,
            }

            var vm = this;

            $.ajax({
                url:'/api/users/' + window.securify.auth.user.id,
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
                success: function(user) {
                    vm.name = user.data.name;
                    vm.email = user.data.email;
                    vm.submitting = false;
                    vm.success = true;
                }.bind(vm)
            })
        },

        resetSuccessState: function()
        {
            this.success = false;
        },

        resetErrorState: function()
        {
            this.error = false;
        }
    }
});
