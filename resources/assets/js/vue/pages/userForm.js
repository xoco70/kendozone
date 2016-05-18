let Vue = require('vue');

let vm = new Vue({
    el: 'body',
    data: {
        user: user,
        federations: [],
        federationSelected: user.id,
        associations: [],
        associationSelected: user.federation_id,
        clubs: [],
        clubSelected: user.club_id,


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
        getClubs: function (associationSelected) {
            var url = '/api/v1/federations/' + this.federationSelected + '/associations/' + associationSelected + "/clubs/";
            $.getJSON(url, function (data) {
                vm.clubs = data;
            });
        },
    }, ready: function () {
        console.log(user.federation_id);
        this.getFederations();
    },

    filters: {}
});