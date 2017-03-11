let VueDragula = require('../vue-dragula');

Vue.config.debug = true;

Vue.use(VueDragula);

vm = new Vue({
    el: '#dragula_top',
    data: {
        colOne: [
        ],
        colTwo: [
        ],

        teamsArea: [
        ],
        teams:myTeams,
        team_id:0,
        competitorsArea: names,
        copyOne: [
        ],
    },
    created: function () {
        Vue.vueDragula.options('', {
            copy: false
        })
    },
    mounted: function () {
        this.$nextTick(function () {
            let _this = this;
            console.log(_this);
            Vue.vueDragula.eventBus.$on(
                'drop',
                function (args) {
                    console.log('drop: ' + JSON.stringify(args));

                }
            );
            Vue.vueDragula.eventBus.$on(
                'dropModel',
                function (args) {
                    console.log('dropModel: ' + JSON.stringify(args));


                }
            )
        })
    },
    methods: {

    }
});