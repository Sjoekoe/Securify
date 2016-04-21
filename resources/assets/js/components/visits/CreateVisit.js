var Vue = require('vue');
var accountID = window.securify.auth.account ? window.securify.auth.account.id : null;

module.exports = Vue.extend({
    template: '#create-visit',

    props: ['createvisit'],

    data: function() {
        return {
            visitors: [],
            employees: [],
            companies: [],
            visitor: 0,
            visitor_name: '',
            errors: [],
            error: '',
            selected_visitor: false,
            company: 0,
            company_name: '',
            selected_company: false,
            employee_id: 0,
            expected_arrival: '',
            expected_departure: '',
            submitting: false,
            status: 'Creating visitation ...',
        }
    },

    ready: function() {
        $.getJSON('/api/accounts/' + accountID + '/visitors', function(visitors) {
            this.visitors = visitors.data;
        }.bind(this));

        $.getJSON('/api/accounts/' + accountID + '/employees', function(employees) {
            this.employees = employees.data;
        }.bind(this));

        $.getJSON('/api/accounts/' + accountID + '/companies', function(companies) {
            this.companies = companies.data;
        }.bind(this));
    },

    methods: {
        updateVisitor: function() {
            var vm = this;

            if (parseInt(vm.visitor) !== 0) {
                $.getJSON('/api/accounts/' + accountID + '/visitors/' + vm.visitor, function(visitor) {
                    vm.visitor_name = visitor.data.name;
                    vm.selected_visitor = true;
                    vm.company = visitor.data.companyRelation.data.id;
                    vm.company_name = visitor.data.companyRelation.data.name;
                    vm.selected_company = true;
                }.bind(vm));
            } else {
                vm.selected_visitor = false;
            }
        },

        updateCompany: function() {
            var vm = this;

            if (parseInt(vm.company) !== 0) {
                $.getJSON('/api/accounts/' + accountID + '/companies/' + vm.company, function(company) {
                    vm.company_name = company.data.name;
                    vm.selected_company = true;
                }.bind(vm));
            } else {
                vm.selected_company = false;
            }
        },

        createVisit: function(e) {
            e.preventDefault();
            this.submitting = true;
            var vm = this;

            var data = {
                "expected_arrival": this.expected_arrival,
                "expected_departure": this.expected_departure,
                visitor: {
                    "id" : vm.visitor,
                    "name": vm.visitor_name,
                },
                company: {
                    "id": vm.company,
                    "name": vm.company_name,
                },
                employee: {
                    "id": vm.employee_id
                }
            }

            $.ajax({
                url:'/api/accounts/' + accountID + '/visitations',
                type: 'post',
                data: data,
                error: function(errors) {
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
                success: function(visit) {
                    vm.status = 'Redirecting...'
                    window.location.replace('/visitors');
                }.bind(vm),
            });
        }
    },
});
