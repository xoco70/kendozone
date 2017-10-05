vm = new Vue({
    el: '#container',
    data: {
        federationId: federationId,
        federations: [],
        federationSelected: currentFederationId,
        associations: [],
        associationSelected: currentAssociationId,
        clubs: [],
        clubSelected: currentClubId,
        association_name: '',
        association_address: '',
        association_phone: '',
        form: {
            name: '',
            address: '',
            phone: '',
        }


    },
    computed: {
        federationSelectedText: function () {

            let federation = this.federations.find(function (elt) {
                return elt.value == this.federationSelected;
            }.bind(this));

            return federation ? federation.text : '';

        },
        associationSelectedText: function () {

            let association = this.associations.find(function (elt) {
                return elt.value == this.associationSelected;
            }.bind(this));

            return association ? association.text : '';

        }

    },


    methods: {
        storeAssociation: function () {
            this.form.federation_id = this.federationSelected;

            axios.post('/api/v1/associations/create', this.form)
                .then(response => {
                    let association = {
                        value: response.data.data.id,
                        text: response.data.data.name
                    };
                    this.associations.push(association);
                    console.log(association);

                    this.form.name = '';
                    this.form.address = '';
                    this.form.phone = '';

                    flash(response.data.msg);
                    $('#create_association').modal('hide');

                })
                .catch(response => {
                    flash(response, 'error');
                    $('#create_association').modal('show');

                });

        },

        storeClub: function () {
            this.form.federation_id = this.federationSelected;
            this.form.association_id = this.associationSelected;


            axios.post('/api/v1/club/create', this.form)
                .then(response => {
                    let clubs = {
                        value: response.data.data.id,
                        text: response.data.data.name
                    };
                    this.clubs.push(clubs);

                    this.form.name = '';
                    this.form.address = '';
                    this.form.phone = '';
                    flash(response.data.msg);
                    $('#create_club').modal('hide');

                })
                .catch(response => {
                    flash(response, 'error');
                    $('#create_club').modal('show');
                });

        },

        getFederations: function () {
            let url = '/api/v1/users/' + user + '/federations/';
            axios.get(url).then(response => {
                vm.federations = response.data;
            });

            this.associationSelected = 0;
        },

        getAssociations: function (federationSelected) {

            let url = '/api/v1/users/' + user + '/federations/' + federationSelected + '/associations';
            axios.get(url).then(response => {
                vm.associations = response.data;
            });
            this.clubSelected = 0;

            // We should also get all clubs
            this.getClubs(this.federationSelected, this.associationSelected != '' ? this.associationSelected : 0);
        },

        getClubs: function (federationSelected, associationSelected) {
            let url = '/api/v1/users/' + user + '/federations/' + federationSelected + '/associations/' + associationSelected + "/clubs/";
            axios.get(url).then(response => {
                vm.clubs = response.data;
            });
        },
    }
    ,
    mounted: function () {
        this.$nextTick(function () {
            this.getFederations();
            this.associationSelected = currentAssociationId;
            if (this.federationSelected != 0) {
                this.getAssociations(this.federationSelected);
                this.clubSelected = currentClubId;
            }
        })
    },
});