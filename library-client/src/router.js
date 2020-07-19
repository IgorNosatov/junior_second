import Vue from 'vue';
import Router from 'vue-router';

const CreateBook = () =>
    import ('./pages/CreateBook.vue');
const Books = () =>
    import ('./pages/Books.vue');
const EditBook = () =>
    import ('./pages/EditBook.vue');

// auth pages using same chunk name
const Login = () =>
    import ('./pages/Login.vue');
const Register = () =>
    import ('./pages/Register.vue');

Vue.use(Router);

const router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [{
            path: '/',
            name: 'list-books',
            component: Books
        },
        {
            path: '/create',
            name: 'createBook',
            component: CreateBook,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/edit/:id',
            name: 'editBook',
            component: EditBook,

        },
        {
            path: '/login',
            name: 'login',
            component: Login,

        },
        {
            path: '/register',
            name: 'register',
            component: Register,

        },

    ],

});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (localStorage.getItem('authKey.jwt') == null) {
            next({
                path: '/login',
                params: { nextUrl: to.fullPath }
            })
        } else {
            let user = JSON.parse(localStorage.getItem('authKey.user'))
            if (to.matched.some(record => record.meta.is_user)) {
                if (user !== null) {
                    next({
                        path: '/'
                    })
                }
            }
            next()
        }
    } else {
        next()
    }
})

export default router;