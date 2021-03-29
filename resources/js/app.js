require('./bootstrap');

import Vue from 'vue';
import ErrorMessageList from "./components/error/ErrorMessageList";

new Vue({
    el: '#app',
    components: {
        ErrorMessageList
    }
})
