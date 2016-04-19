var Vue = require('vue');

new Vue({
    el: 'body',
    data: {
        isTeam: 0,
        gender: 'M',
        ageCategorySelect: 0,
        ageMin: 0,
        ageMax: 0,
        grades: grades,
        gradeSelect: 0,
        gradeMin: 0,
        gradeMax: 0,

        categoryFullName: 'Individual Men',


    },
    computed: {
        categoryFullName: function () {


            return this.isTeam + ' ' + this.gender
        }
    }
});