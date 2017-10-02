let VueDragula = require('../vue-dragula');
Vue.config.debug = true;

Vue.use(VueDragula);

vm = new Vue({
    el: '#dragula_top',
    data: {
        colOne: [],
        colTwo: [],

        teamsArea: [],
        team_id: 0,
        // championship_id: championshipId,
        teams: [],
        competitorsArea: arrChampionshipsWithTeamsAndCompetitors,
        championships: arrChampionshipsWithTeamsAndCompetitors,
        copyOne: [],
        championship_id: 0,
    },
    methods: {
        deleteTeam(teamId){
            axios.post(url_root_api + "/teams/" + teamId + "/delete", function () {
            })
                .done(function (data) {

                    noty({
                        layout: 'bottomLeft',
                        theme: 'kz',
                        type: 'success',
                        width: 200,
                        dismissQueue: true,
                        timeout: 13000,
                        text: data.msg,
                        template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-trophy2 "></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'

                    });
                    // Get the assigned teams, and restore it to competitors


                })
                .fail(function (data) {
                    noty({
                        layout: 'bottomLeft',
                        theme: 'kz',
                        type: 'warning',
                        width: 200,
                        dismissQueue: true,
                        timeout: 5000,
                        text: url_edit,
                        template: '<div class="noty_message"><div class="row"><div class="col-xs-4 noty_icon"><i class="icon-warning"></i> </div><div class="col-xs-8"><span class="noty_text"></span><div class="noty_close"></div></div></div>'
                    });
                })
                .always(function () {

                });
        },
        addCompetitorToTeam(teamId, competitorId){
            axios.post(url_root_api + "/teams/" + teamId + "/competitors/" + competitorId + "/add");
            // Vue.vueDragula.find('third-bag').drake.cancel(true);

        },
        removeCompetitorFromTeam(teamId, competitorId){
            axios.post(url_root_api + "/teams/" + teamId + "/competitors/" + competitorId + "/remove");
        },
        moveCompetitorToAnotherTeam(competitorId, old_team_id, new_team_id){
            axios.post(url_root_api + "/teams/" + old_team_id + "/" + new_team_id + "/competitors/" + competitorId + "/move");
        }

    },
    computed: {
        championship(){
            return this.championships.find((elem) => elem.championship == this.championship_id);
        },
        // competitors(){
        //     return this.championships.find((elem) => elem.championship == this.championship_id).competitors;
        // },
        teams(){
            return this.championships.find((elem) => elem.championship == this.championship_id).teams;
        },
    },

    created: function () {
        Vue.vueDragula.options('', {
            copy: false
        })
    },
    mounted: function () {
        this.$nextTick(function () {
            let vm = this;
            Vue.vueDragula.eventBus.$on(
                'drop',
                function (args) {
                    let teamId = args[1].parentNode.getAttribute("team-id");
                    vm.championship_id = args[1].parentNode.getAttribute("championship-id");
                    let competitorId = args[1].getAttribute("id");
                    let old_team_id = args[3].getAttribute("team-id");


                    if (competitorId != null && teamId != null && old_team_id == null) { // Add
                        console.log("adding");
                        vm.addCompetitorToTeam(teamId, competitorId);
                    }
                    else if (competitorId != null && teamId == null && old_team_id != null) { // Remove
                        console.log("removing");
                        vm.removeCompetitorFromTeam(old_team_id, competitorId)
                    }
                    else if (competitorId != null && teamId != null && old_team_id != null) { // Move
                        console.log("moving");
                        vm.moveCompetitorToAnotherTeam(competitorId, old_team_id, teamId);
                    }

                }
            );
            Vue.vueDragula.eventBus.$on(
                'dropModel',
                function (args) {
                    console.log('dropModel: ' + JSON.stringify(args));


                }
            )
        })
    }
});