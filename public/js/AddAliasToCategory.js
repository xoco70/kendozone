/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "./";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 34);
/******/ })
/************************************************************************/
/******/ ({

/***/ 12:
/***/ (function(module, exports) {

// // var Vue = require('vue');
//
// new Vue({
//     el: 'body',
//     data: {
//         isTeam: 0,
//         alias: '',
//         genderSelect: 'M',
//         ageCategorySelect: 0,
//         ageMin: 0,
//         ageMax: 0,
//         gradeSelect: 0,
//         gradeMin: 0,
//         gradeMax: 0,
//         error: '',
//         grades: [
//             {value: 0, text: no_grade},
//             {value: 2, text: '7 Kyu'},
//             {value: 3, text: '6 Kyu'},
//             {value: 4, text: '5 Kyu'},
//             {value: 5, text: '4 Kyu'},
//             {value: 6, text: '3 Kyu'},
//             {value: 7, text: '2 Kyu'},
//             {value: 8, text: '1 Kyu'},
//             {value: 9, text: '1 Dan'},
//             {value: 10, text: '2 Dan'},
//             {value: 11, text: '3 Dan'},
//             {value: 12, text: '4 Dan'},
//             {value: 13, text: '5 Dan'},
//             {value: 14, text: '6 Dan'},
//             {value: 15, text: '7 Dan'},
//             {value: 16, text: '8 Dan'}
//         ],
//         ageCategories: [
//             {value: 0, text: no_age},
//             {value: 1, text: childs},
//             {value: 2, text: students},
//             {value: 3, text: adults},
//             {value: 4, text: masters},
//             {value: 5, text: custom}
//         ],
//
//         genders: [
//             {value: 'M', text: male},
//             {value: 'F', text: female},
//             {value: 'X', text: mixt}
//         ],
//         categoryFullName: 'Individual Men'
//
//
//     },
//     computed: {
//         categoryFullName: function categoryFullName() {
//             var teamText = this.isTeam == 1 ? team : single;
//             var ageCategoryText = '';
//             var gradeText = '';
//
//             if (this.ageCategorySelect != 0) {
//                 if (this.ageCategorySelect == 5) {
//                     ageCategoryText = ' - ' + age + ' : ';
//                     if (this.ageMin != 0 && this.ageMax != 0) {
//                         if (this.ageMin == this.ageMax) {
//                             ageCategoryText += this.ageMax + ' ' + years;
//                         } else {
//                             ageCategoryText += this.ageMin + ' - ' + this.ageMax + ' ' + years;
//                         }
//                     } else if (this.ageMin == 0 && this.ageMax != 0) {
//                         ageCategoryText += ' < ' + this.ageMax + ' ' + years;
//                     } else if (this.ageMin != 0 && this.ageMax == 0) {
//                         ageCategoryText += ' > ' + this.ageMin + ' ' + years;
//                     } else {
//                         ageCategoryText = '';
//                     }
//                 } else {
//                     ageCategoryText = this.getSelectText(this.ageCategories, this.ageCategorySelect);
//                 }
//             }
//
//             if (this.gradeSelect == 3) {
//                 gradeText = ' - ' + grade + ' : ';
//                 if (this.gradeMin != 0 && this.gradeMax != 0) {
//                     if (this.gradeMin == this.gradeMax) {
//                         gradeText += this.getSelectText(this.grades, this.gradeMin);
//                     } else {
//                         gradeText += this.getSelectText(this.grades, this.gradeMin) + ' - ' + this.getSelectText(this.grades, this.gradeMax);
//                     }
//
//                 } else if (this.gradeMin == 0 && this.gradeMax != 0) {
//                     gradeText += ' < ' + this.getSelectText(this.grades, this.gradeMax);
//                 } else if (this.gradeMin != 0 && this.gradeMax == 0) {
//                     gradeText += ' > ' + this.getSelectText(this.grades, this.gradeMin);
//                 } else {
//                     gradeText = '';
//                 }
//             }
//
//             return teamText + ' ' + this.getSelectText(this.genders, this.genderSelect) + ' ' + ageCategoryText + ' ' + gradeText;
//         }
//     },
//
//     methods: {
//         addCategory: function addCategory() {
//             this.error = '';
//             // Get Get Category Name and Id
//             // var url = '/api/v1/category/team/' + this.isTeam + '/gender/' + this.genderSelect
//             //     + '/age/' + this.ageCategorySelect + '/' + this.ageMin + '/' + +this.ageMax
//             //     + '/grade/' + this.gradeSelect + '/' + this.gradeMin + '/' + this.gradeMax;
//
//
//             dualListIds = [];
//             $(".listbox-filter-disabled > option").each(function () {
//                 dualListIds.push(this.value);
//             });
//             $.ajax({
//                 url: '/api/v1/category/create',
//                 type: 'POST',
//                 data: {
//                     "isTeam": this.isTeam, "gender": this.genderSelect, "alias": this.alias,
//                     "age": this.ageCategorySelect, "ageMin": this.ageMin, "ageMax": this.ageMax,
//                     "grade": this.gradeSelect, "gradeMin": this.gradeMin, "gradeMax": this.gradeMax
//                 },
//                 dataType: "json"
//             })
//                 .done(function (data, textStatus, jqXHR) {
//                     if (dualListIds.indexOf('' + data.id) == -1) {
//                         var option;
//                         console.log(this.alias);
//                         if (this.alias != '')
//                             option = '<option value=' + data.id + ' selected>' + this.alias + '</option>';
//                         else
//                             option = '<option value=' + data.id + ' selected>' + this.categoryFullName + '</option>';
//                         // console.log(option);
//                         dualList.append(option);
//                         dualList.bootstrapDualListbox('refresh');
//                     } else {
//                         // Print message
//                         this.error = " Ya existe el elemento";
//                     }
//                 }.bind(this))
//                 .fail(function (jqXHR, textStatus, errorThrown) {
//                     console.log("error:" + textStatus + "- " + errorThrown.toString());
//                 });
//         },
//         decodeHtml: function decodeHtml(html) {
//             var txt = document.createElement("textarea");
//             txt.innerHTML = html;
//             return txt.value;
//         },
//         getSelectText: function getSelectText(myArray, val) {
//             var newVal = '';
//             myArray.map(function (el) {
//                 if (val == el.value) {
//                     newVal = el.text;
//                 }
//             });
//             return newVal;
//         },
//         resetModalValues: function resetModalValues() {
//             this.isTeam = 0;
//             this.genderSelect = 'M';
//             this.ageCategorySelect = 0;
//             this.ageMin = 0;
//             this.ageMax = 0;
//             this.gradeSelect = 0;
//             this.gradeMin = 0;
//             this.gradeMax = 0;
//         }
//     },
//     filters: {
//         selectText: function selectText(val, myArray) {
//             return this.getSelectText(myArray, val);
//         },
//         html: function html(_html) {
//             return this.decodeHtml(_html);
//         }
//     }
// });

/***/ }),

/***/ 34:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(12);


/***/ })

/******/ });