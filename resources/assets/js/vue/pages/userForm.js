var Vue = require('vue');

new Vue({
    el: 'body',
    data: {

    },
    computed: {},

    methods: {
        getFederations: function getFederations() {
            let url = '/api/v1/federations';
            $.getJSON(url, function (data) {

            });
        },

    },
    filters: {}
});