(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

var vm = new Vue({
    el: 'body',
    data: {
        federations: [],
        federationSelected: currentFederationId,
        associations: [],
        associationSelected: currentAssociationId,
        clubs: [],
        clubSelected: currentClubId

    },
    computed: {},

    methods: {
        getFederations: function getFederations() {
            var url = '/api/v1/users/' + user + '/federations/';
            this.$http.get(url).then(function (response) {
                vm.federations = response.data;
            });

            this.associationSelected = 0;
        },
        getAssociations: function getAssociations(federationSelected) {

            var url = '/api/v1/users/' + user + '/federations/' + federationSelected + '/associations';
            this.$http.get(url).then(function (response) {
                vm.associations = response.data;
            });
            this.clubSelected = 0;
        },
        getClubs: function getClubs(associationSelected) {
            var url = '/api/v1/users/' + user + '/associations/' + associationSelected + "/clubs/";
            this.$http.get(url).then(function (response) {
                vm.clubs = response.data;
            });
        }
    }, ready: function ready() {
        this.getFederations();
        // console.log("currentFedId:"+currentFederationId);
        // console.log("currentAssocId:"+currentAssociationId);
        // console.log("currentClubId:"+currentClubId);
        this.associationSelected = currentAssociationId;
        if (this.federationSelected != 0) {
            this.getAssociations(this.federationSelected);
            this.clubSelected = currentClubId;
            if (this.associationSelected != 0) {
                this.getClubs(this.associationSelected);
            }
        }
    }
});

},{}]},{},[1]);

//# sourceMappingURL=userForm.js.map
