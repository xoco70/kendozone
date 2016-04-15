/**
 * Created by julien on 14/04/16.
 */
var Vue = require('vue');


new Vue({
    el: 'body',
    data: {
        isTeam: 1,
        categoryName: 'Individual Varonil',
        gender: 'M',
        ageCategory:0
    },
    methods: {
        getCategoryName: function () {
            // Get fields value
            var isTeam = this.isTeam;
            var gender = this.gender;
            var ageCategory = this.ageCategory;
            // make ajax request to get result
            // console.log(isTeam);
            // console.log(gender);
            // console.log(ageCategory);

            // Display it
            $.getJSON('/api/v1/category/' + isTeam + '/'+ gender + '/' + ageCategory, function(data){
                // console.log( data.name);
                this.categoryName = data.name;
            }.bind(this));

        }
    },
    created: function(){
    },
    ready(){

    }
});