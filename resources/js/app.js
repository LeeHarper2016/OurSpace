require('./bootstrap');

import Vue from 'vue';

import ErrorList from "./classes/ErrorList";

import ErrorMessageList from "./components/error/ErrorMessageList";
import ParticleForm from "./components/particle/ParticleForm";
import ParticleList from "./components/particle/ParticleList";
import SpaceMenu from "./components/space/SpaceMenu";
import NavbarDropdownMenu from "./components/navbar/NavbarDropdownMenu";

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
        ParticleList,
        ParticleForm,
        SpaceMenu,
        NavbarDropdownMenu
    },
    methods: {
        addError(message) {
            this.errorList.addError(message)
        }
    }
})
