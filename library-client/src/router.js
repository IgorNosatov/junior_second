import Vue from 'vue';
import Router from 'vue-router';

const Books = () =>
    import ('./views/Books.vue');

Vue.use(Router);

const router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [

        {
            path: '/',
            name: 'books',
            component: Books,
        },
    ],

});


export default router;