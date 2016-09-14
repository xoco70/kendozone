let Vue = require('vue');

let vm = new Vue({
    el: 'body',
    data: {
        federations: [],
        federationSelected: federationId,
        associations: [],
        associationSelected: associationId,
        clubs: [],
        clubSelected: clubId,


    },
    computed: {},

    methods: {
        getFederations: function () {
            var url = '/api/v1/federations';

            $.getJSON(url, function (data) {
                vm.federations = data;
            });
            this.associationSelected = 1;
        },
        getAssociations: function (federationSelected) {
            var url = '/api/v1/federations/' + federationSelected + '/associations';
            $.getJSON(url, function (data) {
                vm.associations = data;
            });
            this.clubSelected = 1;
        },
        getClubs: function (associationSelected) {
            var url = '/api/v1/federations/' + this.federationSelected + '/associations/' + associationSelected + "/clubs/";
            $.getJSON(url, function (data) {
                vm.clubs = data;
            });
        },
    }, ready: function () {
        this.getFederations();
        if (this.federationSelected != 1) {
            this.getAssociations(this.federationSelected);
            if (this.associationSelected != 1) {
                this.getClubs(this.associationSelected);
            }
        }
    },
});