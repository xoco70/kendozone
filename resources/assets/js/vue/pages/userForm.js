let Vue = require('vue');

let vm = new Vue({
    el: 'body',
    data: {
        federations: [],
        federationSelected: 33,
        associations: [],
        associationSelected: 0

    },
    computed: {},

    methods: {
        getFederations: function () {
            var url = '/api/v1/federations';

            $.getJSON(url, function (data) {
                vm.federations = data;
            });
        },
        getAssociations: function (federationSelected) {
            var url = '/api/v1/federations/' + federationSelected + '/associations';
            $.getJSON(url, function (data) {
                vm.associations = data;
            });
        },
    }, ready: function () {
        this.getFederations();
    },

    filters: {}
});