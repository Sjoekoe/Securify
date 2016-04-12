var Vue = require ('vue');

module.exports = Vue.extend({
    template: '#login',

    props: ['login'],

    data: function() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            remember: false,
            errors: [],
            submitting: false,
            status: '',
        }
    },

    ready: function() {

    },

    methods: {
        register: function(e) {
            e.preventDefault();
            this.submitting = true;
            this.status = 'Registering...';

            var data = {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            }

            var vm = this;

            $.ajax({
                url: '/api/users',
                type: 'post',
                data: data,
                success: function() {
                    vm.status = 'Redirecting...';
                    window.location.replace('/test');
                }.bind(vm),
                error: function(errors) {
                    vm.errors = errors.responseJSON.errors;
                    vm.submitting = false;
                }.bind(vm)
            })
        }
    }
});
