var Vue = require('vue');
var accountID = window.securify.auth.account ? window.securify.auth.account.id : null;
var visit = window.securify.visit;
var apiToken = window.securify.auth ? window.securify.auth.jwt : null;

module.exports = Vue.extend({
    template: '#update-visit',

    props: ['updatevisit'],

    data: function() {
        return {
            visitors: [],
            employees: [],
            companies: [],
            visitor: 0,
            visitor_name: '',
            errors: [],
            error: '',
            selected_visitor: true,
            company: 0,
            company_name: '',
            selected_company: true,
            employee_id: 0,
            expected_arrival: '',
            expected_departure: '',
            submitting: false,
            status: 'Creating visitation ...',
            fetching: true,
        }
    },

    ready: function() {
        $.getJSON('/api/accounts/' + accountID + '/visits/' + visit + '?token=' + apiToken, function (visit) {
            this.visitor = visit.data.visitorRelation.data.id;
            this.visitor_name = visit.data.visitorRelation.data.name;
            this.company = visit.data.visitorRelation.data.companyRelation.data.id;
            this.company_name = visit.data.visitorRelation.data.companyRelation.data.name;
            this.employee_id = visit.data.employeeRelation.data.id;
            this.expected_arrival = visit.data.expected_arrival;
            this.expected_departure = visit.data.expected_departure;
        }.bind(this));

        $.getJSON('/api/accounts/' + accountID + '/visitors' + '?token=' + apiToken, function(visitors) {
            this.visitors = visitors.data;
        }.bind(this));

        $.getJSON('/api/accounts/' + accountID + '/employees' + '?token=' + apiToken, function(employees) {
            this.employees = employees.data;
        }.bind(this));

        $.getJSON('/api/accounts/' + accountID + '/companies' + '?token=' + apiToken, function(companies) {
            this.companies = companies.data;
        }.bind(this));

        this.fetching = false;
    },

    methods: {
        updateVisitor: function() {
            var vm = this;

            if (parseInt(vm.visitor) !== 0) {
                $.getJSON('/api/accounts/' + accountID + '/visitors/' + vm.visitor + '?token=' + apiToken, function(visitor) {
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
                $.getJSON('/api/accounts/' + accountID + '/companies/' + vm.company + '?token=' + apiToken, function(company) {
                    vm.company_name = company.data.name;
                    vm.selected_company = true;
                }.bind(vm));
            } else {
                vm.selected_company = false;
            }
        },

        updateVisit: function(e) {
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
                url:'/api/accounts/' + accountID + '/visitations/' + visit + '?token=' + apiToken,
                type: 'put',
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
