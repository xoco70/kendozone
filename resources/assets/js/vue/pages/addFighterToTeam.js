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
        competitorsArea: arrChampionshipsWithTeamsAndCompetitors,
        championships: arrChampionshipsWithTeamsAndCompetitors,
        copyOne: [],
    },
    methods: {
        deleteTeam(teamId){
            axios.post(url_root_api + "/teams/" + teamId + "/delete", function () {
            })
                .then(function (data) {
                    flash(data.data.msg)
                    // Get the assigned teams, and restore it to competitors
                })
                .catch(function (data) {
                    flash(data.msg, 'error')
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