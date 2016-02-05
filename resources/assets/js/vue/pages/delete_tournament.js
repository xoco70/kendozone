/**
 * Created by juliatzin on 04/02/2016.
 */
Vue.component('delete_tournament', {
    el: '#content',
    data: {
        tournaments: [],
    },
    methods: {
        getTournaments: function() {
            $.ajax({
                context: this,
                url: "/",
                success: function (result) {
                    this.$set("tournament", result)
                }
            })
        },
        deleteItem: function (id) {

            console.log(this.$http.delete('tournament', id));
        }
    }

});
