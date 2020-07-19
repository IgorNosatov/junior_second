import Vue from 'vue'
import Vuex from 'vuex'
import App from './App.vue'
import VueRouter from 'vue-router'
import router from './router';

Vue.use(VueRouter);
Vue.use(Vuex);

Vue.config.productionTip = false

new Vue({
    router,
    render: h => h(App),
}).$mount('#app');