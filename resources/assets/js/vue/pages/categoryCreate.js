/**
 * Created by julien on 14/04/16.
 */
var Vue = require('vue');


new Vue({
    el: 'body',
    data: {
        isTeam: 1,
        categoryName: 'Individual Varonil init',
        gender: 'X',
        ageCategory: 0,
        genderValues: [
            'core.no_age',
            'core.children',
            'core.teenagers',
            'core.adults',
            'core.masters',
            'core.custom'
        ],
        ageValues: [
            'core.no_age',
            'core.children',
            'core.teenagers',
            'core.adults',
            'core.masters',
            'core.custom'
        ],
        ageIni: '0',
        ageFin: '0'
    },

    computed: {
        categoryFullName: function () {

            var isTeam = this.isTeam;
            var gender = this.gender;

            var ageIni = this.ageIni;
            var ageFin = this.ageFin;
            var $ageCategorySelect = this.$els.ageCategory;
            var ageCategoryOption = $ageCategorySelect.options[$ageCategorySelect.selectedIndex];
            var ageCategoryName = ageCategoryOption.text;

            console.log(isTeam);
            console.log(gender);
            console.log(isTeam);

            return this.categoryName; // this.categoryName
        }
    },
    methods: {
        getCategoryName: function getCategoryName() {
            // Get fields value
            var isTeam = this.isTeam;
            var gender = this.gender;
            var ageCategory = this.ageCategory;
            var categoryBaseName = '';

            // Get Data and Display it
            if (ageCategory >= 4) {
                $.getJSON('/api/v1/category/' + isTeam + '/' + gender + '/' + ageCategory, (function (data) {
                    // console.log( data.name);
                    this.categoryName = data.name;
                }).bind(this));
            }
        },
        calculateCategoryName: function calculateCategoryName() {
            var isTeam = this.isTeam;
            var gender = this.gender;

            var ageCategory = this.ageCategory;
            var ageIni = this.ageIni;
            var ageFin = this.ageFin;

            var $ageCategorySelect = this.$els.ageCategory;
            var ageCategoryOption = $ageCategorySelect.options[$ageCategorySelect.selectedIndex];
            var ageCategoryName = ageCategoryOption.text;

            console.log(ageCategoryName);

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