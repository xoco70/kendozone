/**
 * Created by julien on 14/04/16.
 */
var Vue = require('vue');


new Vue({
    el: 'body',
    data: {
        message: 'Hello Vue World!'
    },
    ready(){
        alert('Ready');
    }
});