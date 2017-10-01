new Vue({
    el: '#modal',
    data: {
        name: '',
        isTeam: 0,
        genderSelect: 'M',
        ageCategorySelect: 0,
        ageMin: 0,
        alias: '',
        ageMax: 0,
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
        gradeSelect: 0,
        gradeMin: 0,
        gradeMax: 0,
        grades: [
            {value: 0, text: no_grade},
            {value: 2, text: '7 Kyu'},
            {value: 3, text: '6 Kyu'},
            {value: 4, text: '5 Kyu'},
            {value: 5, text: '4 Kyu'},
            {value: 6, text: '3 Kyu'},
            {value: 7, text: '2 Kyu'},
            {value: 8, text: '1 Kyu'},
            {value: 9, text: '1 Dan'},
            {value: 10, text: '2 Dan'},
            {value: 11, text: '3 Dan'},
            {value: 12, text: '4 Dan'},
            {value: 13, text: '5 Dan'},
            {value: 14, text: '6 Dan'},
            {value: 15, text: '7 Dan'},
            {value: 16, text: '8 Dan'}
        ],
        // categoryFullName: 'Individual Men',
        url: '/api/v1/category/create',

    },
    computed: {
        categoryFullName: function () {
            let teamText = this.isTeam == 1 ? team : single;
            this.name = teamText + ' ' +
                this.getSelectText(this.genders, this.genderSelect) + ' ' +
                this.getAgeText() + ' ' +
                this.getGradeText();

            return this.name;

        }
    },
    methods: {
        addCategory: function addCategory() {
            this.error = '';

            dualListIds = [];
            $(".listbox-filter-disabled > option").each(function () {
                dualListIds.push(this.value);
            });

            let categoryData = {
                "isTeam": this.isTeam,
                "gender": this.genderSelect,
                "alias": this.alias,
                "ageCategory": this.ageCategorySelect,
                "ageMin": this.ageMin,
                "ageMax": this.ageMax,
                "gradeCategory": this.gradeSelect,
                "gradeMin": this.gradeMin,
                "gradeMax": this.gradeMax
            };


            axios.post(this.url, categoryData).then(response => {
                if (dualListIds.indexOf('' + response.data.id) == -1) {
                    let option;
                    console.log(this.categoryData);
                    if (this.alias != '')
                        option = '<option value=' + response.data.id + ' selected>' + this.alias + '</option>';
                    else
                        option = '<option value=' + response.data.id + ' selected>' + this.categoryFullName + '</option>';
                    dualList.append(option);
                    dualList.bootstrapDualListbox('refresh');
                } else {
                    // Print message
                    this.error = " Element already exists";
                }
            });
        },
        decodeHtml: (html) => {
            let txt = document.createElement("textarea");
            txt.innerHTML = html;
            return txt.value;
        },
        getAgeText: function () {
            let ageCategoryText = '';
            if (this.ageCategorySelect != 0) {
                if (this.ageCategorySelect == 5) {
                    ageCategoryText = ' - ' + age + ' : ';
                    if (this.ageMin != 0 && this.ageMax != 0) {
                        if (this.ageMin == this.ageMax) {
                            ageCategoryText += this.ageMax + ' ' + years;
                        } else {
                            ageCategoryText += this.ageMin + ' - ' + this.ageMax + ' ' + years;
                        }
                    } else if (this.ageMin == 0 && this.ageMax != 0) {
                        ageCategoryText += ' < ' + this.ageMax + ' ' + years;
                    } else if (this.ageMin != 0 && this.ageMax == 0) {
                        ageCategoryText += ' > ' + this.ageMin + ' ' + years;
                    } else {
                        ageCategoryText = '';
                    }
                } else {
                    ageCategoryText = this.getSelectText(this.ageCategories, this.ageCategorySelect);
                }
            }
            return ageCategoryText;
        },
        getGradeText: function () {
            let gradeText = '';
            if (this.gradeSelect == 3) {
                gradeText = ' - ' + grade + ' : ';
                if (this.gradeMin != 0 && this.gradeMax != 0) {
                    if (this.gradeMin == this.gradeMax) {
                        gradeText += this.getSelectText(this.grades, this.gradeMin);
                    } else {
                        gradeText += this.getSelectText(this.grades, this.gradeMin) + ' - ' + this.getSelectText(this.grades, this.gradeMax);
                    }

                } else if (this.gradeMin == 0 && this.gradeMax != 0) {
                    gradeText += ' < ' + this.getSelectText(this.grades, this.gradeMax);
                } else if (this.gradeMin != 0 && this.gradeMax == 0) {
                    gradeText += ' > ' + this.getSelectText(this.grades, this.gradeMin);
                } else {
                    gradeText = '';
                }

            }
            return gradeText;
        },
        getSelectText: (myArray, val) => {
            let newVal = '';
            myArray.map(function (el) {
                if (val == el.value) {
                    newVal = el.text;
                }
            });
            return newVal;
        },
        resetModalValues: () => {
            this.isTeam = 0;
            this.genderSelect = 'M';
            this.ageCategorySelect = 0;
            this.ageMin = 0;
            this.ageMax = 0;
            this.gradeSelect = 0;
            this.gradeMin = 0;
            this.gradeMax = 0;
        }
    },
    filters: {
        html: function (html) {
            let txt = document.createElement("textarea");
            txt.innerHTML = html;
            return txt.value;
        }
    }
});
