<template>
    <div>
        <div class="row">
            <div class="col-md-10">
                <h1> {{ championship.settings.alias }}
                    <span class="text-size-small ml-20">drag_competitors_name_into_team</span>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="col-md-8" id="teams">
                    <div class="row">
                        <div v-for="team in championship.teams" v-cloak>
                            <div class="col-md-4" id="team-panel">
                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">{{team.name}}
                                            <a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a data-action="collapse"></a></li>
                                                <li><a data-action="close" @click="deleteTeam(team.id)"></a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="panel-body">
                                        <div class="container-dragula"
                                             v-dragula="copyOne"
                                             bag="third-bag">
                                            <div v-cloak
                                                 v-for="(competitor, index) in championships.competitors"
                                                 :team-id="team.id"
                                                 :id="competitor.id"
                                                 :index="index"
                                                 :key="competitor.id"
                                            >{{competitor.user.name}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xs-12 col-md-4 panel panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="https://laravel.dev/championships/1070/teams"
                                  accept-charset="UTF-8" class="form-horizontal">
                                <input name="_token" type="hidden" value=window.Laravel.csrfToken >
                                <div class="form-group"><h2 align="center">Ajouter Équipe </h2>
                                    <div align="center" class="form-inline">
                                        <input placeholder="Nom de l'équipe" name="name" type="text" value=""
                                               class="form-control">
                                        <button type="submit" class="btn btn-success" id="save">core.add</button>
                                        <input type="hidden" name="championship_id" :value=championship.id>
                                        <input type="hidden" id="activeTab" name="activeTab" :value=championship.id />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4 panel panel-body">
                    <h2 align="center">core.competitor</h2>
                    <div class="row">

                        <div class="wrapper-dragula">
                            <div class="container-dragula" v-dragula="competitorsArea" bag="third-bag">
                                <div v-cloak
                                     v-for="(competitor, index) in championship.freeCompetitors"
                                     :id="competitor.id"
                                     :index="index"
                                     :key="competitor.id"
                                >
                                    {{competitor.user.name}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import VueDragula from '../vue-dragula';

    export default {
        props: ['championship'],
        components: {Vue},
        data() {
            return {
                colOne: [],
                colTwo: [],
                teamsArea: [],
                team_id: 0,
                competitorsArea: arrChampionshipsWithTeamsAndCompetitors,
                championships: arrChampionshipsWithTeamsAndCompetitors,
                copyOne: [],
            }
        },
        methods: {
            deleteTeam(teamId) {
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
            addCompetitorToTeam(teamId, competitorId) {
                axios.post(url_root_api + "/teams/" + teamId + "/competitors/" + competitorId + "/add");
                // Vue.vueDragula.find('third-bag').drake.cancel(true);

            },
            removeCompetitorFromTeam(teamId, competitorId) {
                axios.post(url_root_api + "/teams/" + teamId + "/competitors/" + competitorId + "/remove");
            },
            moveCompetitorToAnotherTeam(competitorId, old_team_id, new_team_id) {
                axios.post(url_root_api + "/teams/" + old_team_id + "/" + new_team_id + "/competitors/" + competitorId + "/move");
            }

        },
//        created: function () {
//            Vue.vueDragula.options('', {
//                copy: false
//            })
//        },
//        mounted: function () {
//            this.$nextTick(function () {
//                let vm = this;
//                Vue.vueDragula.eventBus.$on(
//                    'drop',
//                    function (args) {
//                        let teamId = args[1].parentNode.getAttribute("team-id");
//                        vm.championship_id = args[1].parentNode.getAttribute("championship-id");
//                        let competitorId = args[1].getAttribute("id");
//                        let old_team_id = args[3].getAttribute("team-id");
//
//
//                        if (competitorId != null && teamId != null && old_team_id == null) { // Add
//                            console.log("adding");
//                            return vm.addCompetitorToTeam(teamId, competitorId);
//                        }
//                        if (competitorId != null && teamId == null && old_team_id != null) { // Remove
//                            console.log("removing");
//                            return vm.removeCompetitorFromTeam(old_team_id, competitorId)
//                        }
//                        if (competitorId != null && teamId != null && old_team_id != null) { // Move
//                            console.log("moving");
//                            return vm.moveCompetitorToAnotherTeam(competitorId, old_team_id, teamId);
//                        }
//
//                    }
//                );
//                Vue.vueDragula.eventBus.$on(
//                    'dropModel',
//                    function (args) {
//                        console.log('dropModel: ' + JSON.stringify(args));
//
//
//                    }
//                )
//            })
//        }
    }
</script>