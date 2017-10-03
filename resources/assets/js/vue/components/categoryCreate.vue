<template>
    <div>
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <div class=" form-group border-grey-700">
                        <p class="full-width border-lg p-20 text-bold text-size-large text-center text-uppercase">
                            {{ categoryFullName | html }} </p>
                        <hr/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label class="text-bold">{{ gender }}</label>
                    <select v-model="genderSelect" class="form-control">
                        <option v-for="gender in genders" v-bind:value="gender.value">
                            {{ gender.text }}
                        </option>
                    </select>

                </div>
                <div class="col-md-4 col-md-offset-2">

                    <div class=" form-group">
                        <label class="text-bold">{{ team }}</label>
                        <br/>

                        <div>
                            <input type="radio" name="isTeam" id='yes' value="1" v-model="isTeam"/>
                            <label for="yes"> Yes</label>

                            &nbsp;&nbsp;&nbsp;
                            <input type="radio" name="isTeam" id='no' value="0" v-model="isTeam"/>
                            <label for="no"> No</label>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class=" form-group">
                        <label class="text-bold">{{ age_category }}</label>
                        <select v-model="ageCategorySelect" class="form-control">
                            <option v-for="ageCategory in ageCategories" v-bind:value="ageCategory.value">
                                {{ decodeHtml(ageCategory.text) }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4" v-if='ageCategorySelect==5'>
                    <div class=" form-group">
                        <label class="text-bold">{{ age_min }}</label>
                        <select v-model="ageMin" class="form-control">
                            <option value="0">{{ no_age }}</option>
                            <option :value="n+6" v-for="n in 85">{{n + 6}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4" v-if='ageCategorySelect==5'>
                    <div class=" form-group">
                        <label class="text-bold">{{ age_max }}</label>
                        <select v-model="ageMax" class="form-control">
                            <option value="0">{{ no_age }}</option>
                            <option :value="n+6" v-for="n in 85">{{n + 6}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class=" form-group">
                        <label class="text-bold">{{ grade }}</label>
                        <select v-model="gradeSelect" class="form-control">
                            <option value="0">{{ no_grade }}</option>
                            <option value="3">{{ custom }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4" v-if='gradeSelect==3'>
                    <div class=" form-group">
                        <label class="text-bold">{{ grade_min }}</label>
                        <select v-model="gradeMin" class="form-control" v-show="gradeSelect!=0">
                            <option v-for="(grade, val) in grades" :value="grade.value">{{ grade.text | html }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4" v-if='gradeSelect==3'>
                    <div class=" form-group">
                        <label class="text-bold">{{ grade_max }}</label>
                        <select v-model="gradeMax" class="form-control" v-show="gradeSelect!=0">
                            <option v-for="(grade, val) in grades"
                                    v-bind:value="grade.value">{{ grade.text | html }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-primary" v-on:click="addCategory">
                {{ add_and_close }}

            </button>
        </div>
    </div>
</template>
<script>
    export default {
        props:
            ['team', 'gender', 'single', 'no_age', 'no_grade', 'childs', 'students', 'adults', 'masters', 'custom',
                'male', 'female', 'mixt', 'age', 'age_max', 'age_min', 'years', 'grade', 'grade_min', 'grade_max', 'age_category', 'add_and_close'],

        data() {
            return {
                name: '',
                isTeam: 0,
                genderSelect: 'M',
                ageCategorySelect: 0,
                ageMin: 0,
                alias: '',
                ageMax: 0,
                ageCategories: [
                    {value: 0, text: this.no_age},
                    {value: 1, text: this.childs},
                    {value: 2, text: this.students},
                    {value: 3, text: this.adults},
                    {value: 4, text: this.masters},
                    {value: 5, text: this.custom}
                ],

                genders: [
                    {value: 'M', text: this.male},
                    {value: 'F', text: this.female},
                    {value: 'X', text: this.mixt}
                ],
                gradeSelect: 0,
                gradeMin: 0,
                gradeMax: 0,
                grades: [
                    {value: 0, text: this.no_grade},
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
                url: '/api/v1/category/create',

            }
        },
        computed:
            {
                categoryFullName: function () {
                    let teamText = this.isTeam == 1 ? this.team : this.single;
                    this.name = teamText + ' ' +
                        this.getSelectText(this.genders, this.genderSelect) + ' ' +
                        this.getAgeText() + ' ' +
                        this.getGradeText();

                    return this.name;

                }
            }
        ,
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
            }
            ,
            decodeHtml: (html) => {
                let txt = document.createElement("textarea");
                txt.innerHTML = html;
                return txt.value;
            },
            getAgeText:

                function () {
                    let ageCategoryText = '';
                    if (this.ageCategorySelect != 0) {
                        if (this.ageCategorySelect == 5) {
                            ageCategoryText = ' - ' + this.age + ' : ';
                            if (this.ageMin != 0 && this.ageMax != 0) {
                                if (this.ageMin == this.ageMax) {
                                    ageCategoryText += this.ageMax + ' ' + this.years;
                                } else {
                                    ageCategoryText += this.ageMin + ' - ' + this.ageMax + ' ' + this.years;
                                }
                            } else if (this.ageMin == 0 && this.ageMax != 0) {
                                ageCategoryText += ' < ' + this.ageMax + ' ' + this.years;
                            } else if (this.ageMin != 0 && this.ageMax == 0) {
                                ageCategoryText += ' > ' + this.ageMin + ' ' + this.years;
                            } else {
                                ageCategoryText = '';
                            }
                        } else {
                            ageCategoryText = this.getSelectText(this.ageCategories, this.ageCategorySelect);
                        }
                    }
                    return ageCategoryText;
                }

            ,
            getGradeText: function () {
                let gradeText = '';
                if (this.gradeSelect == 3) {
                    gradeText = ' - ' + this.grade + ' : ';
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
            }
            ,
            getSelectText: (myArray, val) => {
                let newVal = '';
                myArray.map(function (el) {
                    if (val == el.value) {
                        newVal = el.text;
                    }
                });
                return newVal;
            },
            resetModalValues:
                () => {
                    this.isTeam = 0;
                    this.genderSelect = 'M';
                    this.ageCategorySelect = 0;
                    this.ageMin = 0;
                    this.ageMax = 0;
                    this.gradeSelect = 0;
                    this.gradeMin = 0;
                    this.gradeMax = 0;
                }
        }
        ,
        filters: {
            html: function (html) {
                let txt = document.createElement("textarea");
                txt.innerHTML = html;
                return txt.value;
            }
        }
    }
</script>