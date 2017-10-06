<template>
    <div>
        <div class="row">
            <div class="col-lg-7 col-xs-9 cat-title">
                <a data-toggle="collapse" data-parent="#accordion-styled" :href="'#accordion-styled-group'+num">

                    <div class="panel-heading">
                        <h6 class="panel-title">
                            <input class="form-control alias" type="text"
                                   id="alias" name="alias"
                                   :value=alias
                                   v-model="data.alias">
                        </h6>
                    </div>
                </a>
            </div>

            <div class="col-lg-5 col-xs-3 cat-status">
                <a data-toggle="collapse" data-parent="#accordion-styled" :href="'#accordion-styled-group'+num">
                    <div class="panel-heading">
                        <span class="text-orange-600" v-if="championship.settings == null">
                            <span class="cat-state"> {{ translations.configure }}</span>
                            <i class="glyphicon  glyphicon-exclamation-sign  status-icon"></i>
                        </span>
                        <span class="text-success" v-else>
                            <span class="cat-state"> {{ translations.configured_full }}</span>
                            <i class="glyphicon text-success glyphicon-ok  status-icon"></i>
                        </span>
                    </div>
                </a>
            </div>
        </div>

        <!--First Line-->
        <div :id="'accordion-styled-group'+num"
             :class="num==0 ? 'panel-collapse collapse in' : 'panel-collapse collapse out'">
            <div class="panel-body">
                <div class="tab-pane" id="category">
                    <div class="row">

                        <div class="col-lg-2">
                            <label for="fightDuration">{{ translations.fightDuration }}</label>
                            <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                               :data-original-title=translations.fightDurationTooltip></i>

                            <div class="input-group">
                                <input class="form-control fightDuration ui-timepicker-input"
                                       id="fightDuration" name="fightDuration" type="text"
                                       @selectTime="setFightDuration"
                                       autocomplete="off"
                                       v-model="data.fightDuration">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>

                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="cost"> {{ translations.cost }} ( {{ translations.currency }} )</label>
                                <i class="icon-help"
                                   data-popup="tooltip"
                                   :data-original-title=translations.costTooltip
                                   data-placement="right"></i>
                                <input class="form-control" name="cost" type="number" id="cost"
                                       v-model="data.cost">
                            </div>
                        </div>
                        <div class="col-lg-3" v-if="championship.category.isTeam">
                            <label for="teamSize">{{ translations.teamSize }} </label>
                            <select class="form-control" id="teamSize" name="teamSize" v-model="data.teamSize">
                                <option v-for="option in teamSize"
                                        :value="option.id">
                                    {{ option.text }}
                                </option>
                            </select>
                        </div>

                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="checkbox-switch ">
                                <label>{{ translations.hasPreliminary }}</label>
                                <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                                   :data-original-title=translations.hasPreliminaryTooltip></i>
                                <br/>
                                <input class="switch"
                                       @switchChange="setHasPreliminary"
                                       :checked=hasPreliminaryValue
                                       name="hasPreliminary"
                                       type="checkbox"
                                       :data-on-text=translations.yes
                                       :data-off-text=translations.no>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="preliminaryGroupSize">{{ translations.preliminaryGroupSize }}</label>
                                <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                                   :data-original-title=translations.preliminaryGroupSizeTooltip
                                ></i>

                                <select class="form-control" id="preliminaryGroupSize" name="preliminaryGroupSize"
                                        :disabled=!data.hasPreliminary
                                        v-model="data.preliminaryGroupSize">
                                    <option v-for="option in preliminaryGroupSize" :value="option.id">
                                        {{ option.text }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!--TODO This one is not linked with VueJS for now-->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="preliminaryWinner">{{ translations.preliminaryWinner }}</label>
                                <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                                   :data-original-title=translations.preliminaryWinnerTooltip
                                ></i>

                                <select class="form-control" id="preliminaryWinner" name="preliminaryWinner"
                                        :disabled=!data.hasPreliminary
                                        v-model="data.preliminaryWinner"
                                >
                                    <option value="1" selected>1</option>
                                </select></div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="treeType">{{ translations.treeType }}</label>
                            <select class="form-control" id="treeType" name="treeType" v-model="data.treeType">
                                <option value="0" :selected="setting.treeType == 0">{{ translations.playOff }}</option>
                                <option value="1" :selected="setting.treeType == 1">{{ translations.direct_elimination
                                    }}
                                </option>
                            </select>
                        </div>

                        <div class="col-lg-3">
                            <label for="fightingAreas">{{ translations.fightingAreas }}</label>
                            <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                               :data-original-title=translations.fightingAreaTooltip></i>
                            <select class=" form-control" id="fightingAreas" name="fightingAreas"
                                    v-model="data.fightingAreas">
                                <option v-for="option in fightingAreas"
                                        :value="option.id">
                                    {{ option.text }}
                                </option>
                            </select>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="limitByEntity">{{ translations.limitByEntity }}</label>
                                <i class="icon-help" data-popup="tooltip" title="" data-placement="right"
                                   :data-original-title=translations.limitByEntityTooltip></i>

                                <select class="form-control" disabled id="limitByEntity" name="limitByEntity">
                                    <option value="0">-</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <br/>
                    <div align="right">
                        <button class="btn btn-success" @click="persist()" :disabled="this.persisting">
                            <i class="icon-spinner spinner position-left"
                               v-if="this.persisting"></i>{{ translations.save }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props:
            ['setting', 'translations', 'championship', 'num'],
        computed: {
            // a computed getter
            alias: function () {
                return (this.setting.alias === null || !this.setting.hasOwnProperty('alias')) ? this.championship.category.name : this.setting.alias;
            },
            hasPreliminaryValue: function () {
                return this.setting.hasPreliminary ? 'checked' : '';
            }
        },

        data() {
            return {
                persisting: false,
                cost: null,
                data: {
                    alias: null,
                    fightDuration: null,
                    cost: null,
                    hasPreliminary: null,
                    treeType: null,
                    preliminaryGroupSize: null,
                    teamSize: null,
                    preliminaryWinner: null,
                    fightingAreas: null,
                },

                teamSize: [
                    {id: 2, text: '2'},
                    {id: 3, text: '3'},
                    {id: 4, text: '4'},
                    {id: 5, text: '5'},
                    {id: 6, text: '6'},
                    {id: 7, text: '7'},
                    {id: 8, text: '8'},
                    {id: 9, text: '9'},
                    {id: 10, text: '10'},
                ],
                preliminaryGroupSize: [
                    {id: 3, text: '3'},
                    {id: 4, text: '4'},
                    {id: 5, text: '5'},
                ],

                preliminaryWinner: [
                    {id: 1, text: '1'},
                ],

                fightingAreas: [
                    {id: 1, text: '1'},
                    {id: 2, text: '2'},
                    {id: 4, text: '4'},
                    {id: 8, text: '8'},
                ],

            }
        }
        ,

        methods: {
            persist() {
                const vm = this;
                this.persisting = true;

                let method = 'POST';
                let url = url_api_root + '/championships/' + this.championship.id + '/settings';

                if ((this.championship.settings)) {
                    method = 'PUT';
                    url = url_api_root + '/championships/' + this.championship.id + '/settings/' + this.championship.settings.id;
                }
                axios({
                    method: method,
                    url: url,
                    data: this.data,
                }).then(function (data) {
                    if (data.data !== null && data.data.status === 'success') {
                        vm.championship.settings = data.data.setting;
                        flash(data.data.msg);
                    } else { // Error 500
                        flash(data.message, 'error');
                    }
                }).catch(function (error) {
                    flash(error.message, 'error');
                }).then(() => {
                    vm.persisting = false;
                });
            },
            setHasPreliminary() {
                let hasPrelim = !this.data.hasPreliminary;
                this.data.hasPreliminary = hasPrelim;
                console.log(hasPrelim);
            },
            setFightDuration() {
                this.data.fightDuration = $('#fightDuration').val();
            }
        }
        ,
        mounted: function () {
//            $("[name='hasPreliminary']").bootstrapSwitch();
            $('input[name="hasPreliminary"]').on('switchChange.bootstrapSwitch', this.setHasPreliminary.bind(this));
            $('input[name="fightDuration"]').on('selectTime', this.setFightDuration.bind(this));

            this.data.alias = this.alias;
            this.data.fightDuration = this.setting.fightDuration;
            this.data.cost = this.setting.cost;
            this.data.hasPreliminary = this.setting.hasPreliminary;
            this.data.preliminaryGroupSize = this.setting.preliminaryGroupSize;
            this.data.preliminaryWinner = this.setting.preliminaryWinner;

            this.data.treeType = this.setting.treeType;
            this.data.fightingAreas = this.setting.fightingAreas;
            console.log(this.championship.category.isTeam);
            console.log(this.setting);
            if (this.championship.category.isTeam) {
                this.data.teamSize = this.setting.teamSize;
            }


        }

    }
</script>