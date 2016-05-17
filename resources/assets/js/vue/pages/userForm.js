let Vue = require('vue');

Vue.component('federations', {
    props: ['federations', 'selected'],
    template: '#federations-list'
})

let vm = new Vue({
    el: 'body',
    data: {
        federations : [{
            text: 'One',
            value: 1
        },{
            text: 'Two',
            value: 2
        },{
            text: 'Three',
            value: 3
        }],
    },
    computed: {},

    methods: {
        getFederations: function()  {
            var url = '/api/v1/federations';
            $.getJSON(url, function (data) {
                console.log(data);
                this.federations = data;
            });
        }
        // ,ready() {
        //     this.getFederations();
        // }
    },
    filters: {}
});
vm.getFederations();
