let VueDragula = require('../vue-dragula');

Vue.config.debug = true;

Vue.use(VueDragula);

new Vue({
    el: '#dragula_top',
    data: {
        colOne: [
            'Fighter 1',
            'Fighter 2',
            'Fighter 3'
        ],
        colTwo: [
            'Fighter 4',
            'Fighter 5',
            'Fighter 6'
        ],

        copyOne: [
        ],
        copyTwo: names
    },
    created: function () {
        Vue.vueDragula.options('third-bag', {
            copy: false
        })
    },
    ready: function () {
        let _this = this;
        Vue.vueDragula.eventBus.$on(
            'drop',
            function (args) {
                console.log('drop: ' + args[0]);

            }
        );
        Vue.vueDragula.eventBus.$on(
            'dropModel',
            function (args) {
                console.log('dropModel: ' + args);

            }
        )
    },
    methods: {

    }
});