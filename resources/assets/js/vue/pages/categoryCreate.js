var Vue = require('vue');

new Vue({
    el: 'body',
    data: {
        isTeam: 0,
        genderSelect: 'M',
        ageCategorySelect: 0,
        ageMin: 6,
        ageMax: 10,
        grades: grades,
        gradeSelect: 0,
        gradeMin: 9,
        gradeMax: 11,

        ageCategories: [
            {value: 0, text: no_age},
            {value: 1, text: childs},
            {value: 2, text: students},
            {value: 3, text: adults},
            {value: 4, text: masters},
            {value: 5, text: custom},
        ],

        genders: [
            {value: 'M', text: male},
            {value: 'F', text: female},
            {value: 'X', text: mixt},
        ],
        categoryFullName: 'Individual Men',


    },
    computed: {
        categoryFullName: function () {
            var teamText = this.isTeam == 1 ? team : single;
            var ageCategoryText = '';
            if (this.ageCategorySelect != 0) {
                if (this.ageCategorySelect == 5) {
                    if (this.ageMin!=0 && this.ageMax!=0){
                        ageCategoryText = this.ageMin + ' - ' + this.ageMax +' '+ years;
                    }
                        
                } else {
                    ageCategoryText = this.getSelectText(this.ageCategories, this.ageCategorySelect);
                }
            }
            if (this.gradeSelect != 0) {

            }

            this.getSelectText(this.ageCategories, this.ageCategorySelect);
            return teamText + ' ' + this.getSelectText(this.genders, this.genderSelect) + ' ' + ageCategoryText;
        }
    },

    methods: {
        decodeHtml: function (html) {
            var txt = document.createElement("textarea");
            txt.innerHTML = html;
            return txt.value;
        },
        getSelectText: function (myArray, val) {
            var newVal = '';
            // console.log(myArray);
            myArray.map(function (el) {
                if (val == el.value) {
                    newVal = el.text;
                }
            });
            return newVal;
        }
    },
    filters: {
        selectText: function (val, myArray) {
            return this.getSelectText(myArray, val);
        },
        html: function (html) {
            return this.decodeHtml(html);
        }
    }
});