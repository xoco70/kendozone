new Vue({
    el: 'body',
    data: {
        loading: false
    },
    methods: {
        loadButton: function loadButton() {
            this.loading = true;
            // GET request
            this.$http({url: url, method: 'POST'}).then(function (response) {
                    // success callback
                    this.loading = false;
                }, function (response) {
                    // error callback
                }.bind(this),
                function (response) {
                    // error callback
                });
        }
    },

});