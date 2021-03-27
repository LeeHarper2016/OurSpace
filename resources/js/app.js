require('./bootstrap');

import Vue from 'vue';
import ErrorList from "./components/error/ErrorList";

new Vue({
    el: '#app',
    components: {
        ErrorList
    }
})
