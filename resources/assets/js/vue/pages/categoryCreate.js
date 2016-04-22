var Vue = require('vue');

new Vue({
    el: 'body',
    data: {
        isTeam: 0,
        genderSelect: 'M',
        ageCategorySelect: 0,
        ageMin: 6,
        ageMax: 10,
        gradeSelect: 0,
        gradeMin: 10,
        gradeMax: 12,

        grades:[
            {value: 0, text: no_grade},
            {value: 2, text: '7 Kyu'},
            {value: 3, text: '6 Kyu'},
            {value: 4, text: '5 Kyu'},
            {value: 5, text: '4 Kyu'},
            {value: 6, text: '3 Kyu'},
            {value: 7, text: '2 Kyu'},
            {value: 8, text: '1 Kyu'},
            {value: 9, text: '7 Kyu'},
            {value: 10, text: '1 Dan'},
            {value: 11, text: '2 Dan'},
            {value: 12, text: '3 Dan'},
            {value: 13, text: '4 Dan'},
            {value: 14, text: '5 Dan'},
            {value: 15, text: '6 Dan'},
            {value: 16, text: '7 Dan'},
            {value: 17, text: '8 Dan'}
        ],
        ageCategories: [
            {value: 0, text: no_age},
            {value: 1, text: childs},
            {value: 2, text: students},
            {value: 3, text: adults},
            {value: 4, text: masters},
            {value: 5, text: custom}
        ],

        genders: [
            {value: 'M', text: male},
            {value: 'F', text: female},
            {value: 'X', text: mixt}
        ],
        categoryFullName: 'Individual Men'


    },
    computed: {
        categoryFullName: function () {
            var teamText = this.isTeam == 1 ? team : single;
            var ageCategoryText = '';
            var gradeText = '';

            if (this.ageCategorySelect != 0) {
                if (this.ageCategorySelect == 5 ) {
                    ageCategoryText = ' - ' + age + ' : ';
                    if (this.ageMin != 0 && this.ageMax != 0) {
                        ageCategoryText += this.ageMin + ' - ' + this.ageMax + ' ' + years;
                    } else if (this.ageMin == 0 && this.ageMax != 0) {
                        ageCategoryText += ' < ' + this.ageMax + ' ' + years;
                    } else if (this.ageMin != 0 && this.ageMax == 0) {
                        ageCategoryText += ' > ' + this.ageMin + ' ' + years;
                    }else{
                        ageCategoryText='';
                    }
                } else {
                    ageCategoryText = this.getSelectText(this.ageCategories, this.ageCategorySelect);
                }
            }

            if (this.gradeSelect == 1) {
                gradeText = ' - ' + grade + ' : ';
                if (this.gradeMin != 0 && this.gradeMax != 0) {
                    gradeText += this.getSelectText(this.grades, this.gradeMin) + ' - ' + this.getSelectText(this.grades, this.gradeMax);
                }
                else if (this.gradeMin == 0 && this.gradeMax != 0) {
                    gradeText += ' < ' + this.getSelectText(this.grades, this.gradeMax);
                } else if (this.gradeMin != 0 && this.gradeMax == 0) {
                    gradeText += ' > ' + this.getSelectText(this.grades, this.gradeMin);
                } else {
                    gradeText = '';
                }
            }
            
            this.getSelectText(this.ageCategories, this.ageCategorySelect);
            return teamText + ' ' + this.getSelectText(this.genders, this.genderSelect) + ' ' + ageCategoryText + ' ' + gradeText;
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
            console.log(myArray);
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