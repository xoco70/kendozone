let vm = new Vue({
    el: '#federations',
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
            let url = '/api/v1/users/' + user + '/federations/';
            this.$http.get(url).then(response => {
                vm.federations = response.data;
            });

            this.associationSelected = 0;
        },
        getAssociations: function (federationSelected) {

            let url = '/api/v1/users/' + user + '/federations/' + federationSelected + '/associations';
            this.$http.get(url).then(response => {
                vm.associations = response.data;
            });
            this.clubSelected = 0;
        },
        getClubs: function (associationSelected) {
            let url = '/api/v1/users/' + user + '/associations/' + associationSelected + "/clubs/";
            this.$http.get(url).then(response => {
                vm.clubs = response.data;
            });
        },
    }, mounted: function () {
        this.$nextTick(function () {
            this.getFederations();
            this.associationSelected = currentAssociationId;
            if (this.federationSelected != 0) {
                this.getAssociations(this.federationSelected);
                this.clubSelected = currentClubId;
                if (this.associationSelected != 0) {
                    this.getClubs(this.associationSelected);
                }
            }

        })
    },
});