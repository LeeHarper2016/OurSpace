require('./bootstrap');

import Vue from 'vue';
import ErrorList from "./classes/ErrorList";
import ErrorMessageList from "./components/error/ErrorMessageList";

new Vue({
    el: '#app',
    data: {
        errorList: null
    },
    provide: {
        errorList: this.errorList
    },
    components: {
        ErrorMessageList
    },
    methods: {
        addError(message) {
            this.errorList.addError(message)
        }
    },
    mounted() {
        this.errorList = new ErrorList();
    }
})
