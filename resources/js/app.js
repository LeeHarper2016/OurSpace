require('./bootstrap');

import Vue from 'vue';

import ErrorList from "./classes/ErrorList";

import ErrorMessageList from "./components/error/ErrorMessageList";
import ParticleList from "./components/particle/ParticleList";

new Vue({
    el: '#app',
    data: {
        errorList: new ErrorList()
    },
    provide() {
        return {
            errorList: this.errorList
        }
    },
    components: {
        ErrorMessageList,
        ParticleList
    },
    methods: {
        addError(message) {
            this.errorList.addError(message)
        }
    }
})
