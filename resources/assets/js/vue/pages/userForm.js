let vm = new Vue({
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

            }
        },


        methods: {
            storeAssociation: function () {
                this.form.federation_id = this.federationSelected;

                this.$http.post('/api/v1/associations/create', this.form)
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
                        noty({
                            layout: 'bottomLeft',
                            theme: 'kz',
                            type: 'success',
                            width: 200,
                            dismissQueue: true,
                            timeout: 5000,
                            text: response.data.msg,
                            template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-trophy2 "></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'

                        });
                        $('#create_association').modal('hide');

                    })
                    .catch(response => {
                        noty({
                            layout: 'bottomLeft',
                            theme: 'kz',
                            type: 'error',
                            width: 200,
                            dismissQueue: true,
                            timeout: 5000,
                            text: response.data.name[0],
                            template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-warning"></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'
                        });
                        $('#create_association').modal('show');

                    });

            }
            ,
            getFederations: function () {
                let url = '/api/v1/users/' + user + '/federations/';
                this.$http.get(url).then(response => {
                    vm.federations = response.data;
                });

                this.associationSelected = 0;
            }
            ,
            getAssociations: function (federationSelected) {

                let url = '/api/v1/users/' + user + '/federations/' + federationSelected + '/associations';
                this.$http.get(url).then(response => {
                    vm.associations = response.data;
                });
                this.clubSelected = 0;
            }
            ,
            getClubs: function (associationSelected) {
                let url = '/api/v1/users/' + user + '/associations/' + associationSelected + "/clubs/";
                this.$http.get(url).then(response => {
                    vm.clubs = response.data;
                });
            }
            ,
        }
        ,
        mounted: function () {
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
        }
        ,
    })
;