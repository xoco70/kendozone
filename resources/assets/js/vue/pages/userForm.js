let Vue = require('vue');

let vm = new Vue({
    el: 'body',
    data: {
        federations: [],
        federationSelected: currentFederationId,
        associations: [],
        associationSelected: currentAssociationId,
        clubs: [],
        clubSelected: currentClubId,


    },
    computed: {},

    methods: {
        getFederations: function () {
            var url = '/api/v1/users/'+user+'/federations/';
            $.getJSON(url, function (data) {
                vm.federations = data;
            });
            console.log(url);
            this.associationSelected = 0;
        },
        getAssociations: function (federationSelected) {

            var url = '/api/v1/users/'+user+'/federations/' + federationSelected + '/associations';
            $.getJSON(url, function (data) {
                vm.associations = data;
            });
            console.log(url);
            this.clubSelected = 0;
        },
        getClubs: function (associationSelected) {
            var url = '/api/v1/users/'+user+'/associations/' + associationSelected + "/clubs/";
            $.getJSON(url, function (data) {
                vm.clubs = data;
            });
        },
    }, ready: function () {
        this.getFederations();
        console.log("currentFedId:"+currentFederationId);
        console.log("currentAssocId:"+currentAssociationId);
        console.log("currentClubId:"+currentClubId);
        this.associationSelected = currentAssociationId;
        if (this.federationSelected != 0) {
            this.getAssociations(this.federationSelected);
            this.clubSelected = currentClubId;
            if (this.associationSelected != 0) {
                this.getClubs(this.associationSelected);
            }
        }
    },
});