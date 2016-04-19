
var Vue = require('vue');

new Vue({
    el: 'body',

    filters: {
        dateTimeFormat: require('./filters/dateTimeFormat'),
    },

    components: {
        selectaccount: require('./components/accounts/SelectAccount'),
        usersettings: require('./components/users/Settings'),
        employeestable: require('./components/employees/EmployeesTable'),
        createemployee: require('./components/employees/CreateEmployee'),
        editemployee: require('./components/employees/EditEmployee'),
        visitstable: require('./components/visits/VisitsTable'),
    }
});
