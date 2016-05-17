let Vue = require('vue');

let vm = new Vue({
    el: 'body',
    data: {
        listFederation : null
    },
    computed: {},

    methods: {
        getFederations: function getFederations() {
            let url = '/api/v1/federations';
            $.getJSON(url, function (data) {
                $this.listFederation = data;
            });
        },

    },
    filters: {}
});
// vm.getFederations();

