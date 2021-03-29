require('./bootstrap');

import Vue from 'vue';
import ErrorList from "./components/error/ErrorMessageList";

new Vue({
    el: '#app',
    components: {
        ErrorList
    }
})
