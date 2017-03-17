let VueDragula = require('../vue-dragula');
$.ajaxPrefilter(function (options, originalOptions, jqXHR) {
    jqXHR.setRequestHeader('X-CSRF-Token', csrfToken);
});
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
            $.post(url_root_api + "/teams/" + teamId + "/delete", function () {
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
            $.post(url_root_api + "/teams/" + teamId + "/competitors/" + competitorId + "/add");

        },
        removeCompetitorFromTeam(teamId, competitorId){
            $.post(url_root_api + "/teams/" + teamId + "/competitors/" + competitorId + "/remove");
        },
        moveCompetitorToAnotherTeam(competitorId, team_id1, team_id2){
            return 0;
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
                    let championship = args[1].parentNode.getAttribute("championship-id");
                    let competitorId = args[1].getAttribute("id");
                    // console.log(teamId,vm.championship_id,competitorId);
                    if (teamId == null) {
                        teamId = args[3].getAttribute("team-id");
                        console.log(teamId);
                        vm.removeCompetitorFromTeam(teamId, competitorId)
                    }
                    else if (competitorId == null) {
                        vm.moveCompetitorToAnotherTeam(competitorId, team_id1, team_id2)
                    } else {
                        // add competitor to team
                        vm.addCompetitorToTeam(teamId, competitorId);
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