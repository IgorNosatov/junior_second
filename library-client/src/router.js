import Vue from 'vue';
import Router from 'vue-router';
import Storage from '@/services/Storage';


const CreateBook = () =>
    import ('./components/pages/CreateBook.vue');
const EditBook = () =>
    import ('./components/pages/EditBook.vue');
const ListBooks = () =>
    import ('./components/pages/ListBooks.vue');

// auth pages using same chunk name
const SignIn = () =>
    import ('./components/pages/SignIn.vue');
const SignUp = () =>
    import ('./components/pages/SignUp.vue');

Vue.use(Router);

const router = new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes: [{
            path: '/',
            name: 'listBooks',
            component: ListBooks
        },
        {
            path: '/create/',
            name: 'createBook',
            component: CreateBook
        },
        {
            path: '/edit/:id',
            name: 'editBook',
            component: EditBook
        },
        {
            path: '/auth/sign-in',
            name: 'auth.signIn',
            component: SignIn,
            meta: { handleAuth: true },
        },
        {
            path: '/auth/sign-up',
            name: 'auth.signUp',
            component: SignUp,
            meta: { handleAuth: true },
        },
    ],

});

// проверяем роуты на авторизацию
router.beforeEach(
    (to, from, next) => {
        const isAuthenticatedRoute = to.matched.some(record => record.meta.requiresAuth);
        const isAuthSectionRoute = to.matched.some(record => record.meta.handleAuth);

        if (isAuthenticatedRoute && !Storage.hasToken()) {
            next({ name: 'auth.signIn' });
            return;
        }

        if (isAuthSectionRoute && Storage.hasToken()) {
            next({ path: '/' });
            return;
        }

        next({ path: to });
    },
);


export default router;