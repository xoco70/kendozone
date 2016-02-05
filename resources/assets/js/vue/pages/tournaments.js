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
                url: "/api/v1/tournaments",
                success: function (result) {
                    this.$set("tournaments", result)
                }
            })
        },
        deleteItem: function (id) {

            console.log(this.$http.delete('tournament', id));
        }
    }

});
