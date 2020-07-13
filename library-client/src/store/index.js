import Vue from 'vue';
import Vuex from 'vuex';
import Books from './modules/books';
import Auth from './modules/auth';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Books,
        Auth
    }
})