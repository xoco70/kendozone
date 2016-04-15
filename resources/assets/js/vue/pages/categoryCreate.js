/**
 * Created by julien on 14/04/16.
 */
var Vue = require('vue');


new Vue({
    el: 'body',
    data: {
        isTeam: 1,
        categoryName: 'Individual Varonil init',
        gender: 'M',
        ageCategory: 0,
        ageIni: '0',
        ageFin: '0'
    },

    computed: {
        categoryFullName: function () {

            var isTeam = this.isTeam;
            var gender = this.gender;

            var ageCategory = this.ageCategory;
            var ageIni = this.ageIni;
            var ageFin = this.ageFin;

            return this.categoryName;
        }
    },
    methods: {
        getCategoryName: function () {
            // Get fields value
            var isTeam = this.isTeam;
            var gender = this.gender;
            var ageCategory = this.ageCategory;
            var categoryBaseName = '';


            // Get Data and Display it
            if (ageCategory >= 4) {
                $.getJSON('/api/v1/category/' + isTeam + '/' + gender + '/' + ageCategory, function (data) {
                    // console.log( data.name);
                    categoryName = data.name;
                }.bind(this));
            }


        },
        calculateCategoryName: function () {
            var isTeam = this.isTeam;
            var gender = this.gender;

            var ageCategory = this.ageCategory;
            var ageIni = this.ageIni;
            var ageFin = this.ageFin;
            // console.log(ageCategory);
            // if (ageCategory < 4) {
            //     this.categoryName = ageCategory.value + this.categoryName;
            // }
            // if (ageIni == 0)
            //     this.categoryName += ' - Max Age:' + ageFin;
            // else if (ageFin == 0)
            //     this.categoryName += ' - Min Age:' + ageIni;
            // else if (ageIni != 0 && ageFin != 0)
            //     this.categoryName += ' - Age:' + ageIni + ' - ' + ageFin;
        }
    }
});