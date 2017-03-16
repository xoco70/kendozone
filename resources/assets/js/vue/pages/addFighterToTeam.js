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
        tournament: arrChampionshipsWithTeamsAndCompetitors,
        copyOne: [],
    },
    methods: {
        deleteTeam(teamId){
            console.log(teamId);
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
        }

    },
    computed: {
        assignedCompetitors(){
            // Get the tournament var and merge all the team->competitors
        },
        freeTournament(){
            // Get the tournament var and merge all the team->competitors
            return arrChampionshipsWithTeamsAndCompetitors;
        },
    },

    created: function () {
        Vue.vueDragula.options('', {
            copy: false
        })
    },
    mounted: function () {
        this.$nextTick(function () {
            let _this = this;
            Vue.vueDragula.eventBus.$on(
                'drop',
                function (args) {
                    let teamId = args[1].parentNode.getAttribute("team-id");
                    let competitorId = args[1].getAttribute("id");

                    $.post(url_root_api + "/teams/" + teamId + "/competitors/" + competitorId + "/add", function () {
                    })
                        .done(function () {

                        })
                        .fail(function () {

                        })
                        .always(function () {

                        });

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