import axios from 'axios';
import { API_BASE_URL } from '../../config'
import Storage from '@/services/Storage';

const emptyUser = () => ({
    id: null,
    email: '',
    name: '',
});


const state = {
    user: emptyUser(),
    isLoggedIn: Storage.hasToken(),
    token: Storage.getToken(),
}

const mutations = {
    USER_LOGIN(state, { accessToken, tokenType }) {
        Storage.setToken(accessToken);
        Storage.setTokenType(tokenType);

        state.token = accessToken;
        state.isLoggedIn = true;
    },

    USER_LOGOUT(state) {
        Storage.removeToken();
        Storage.removeTokenType();

        state.token = '';
        state.isLoggedIn = false;
        state.user = emptyUser();
    },

    SET_AUTHENTICATED_USER(state) {
        state.isLoggedIn = true;
    },
}

const actions = {
    async signIn({ commit }, { email, password }) {
        try {
            const data = await axios.post(API_BASE_URL + '/auth/login', {
                email,
                password,
            });
            commit('USER_LOGIN', {
                accessToken: data.access_token,
                tokenType: data.token_type
            });
            return Promise.resolve();
        } catch (errorMsg) {
            return Promise.reject(errorMsg);
        }
    },

    async signUp({ commit }, {
        name,
        email,
        password
    }) {
        try {
            const data = await axios.post(API_BASE_URL + '/auth/register', {
                name: name,
                email,
                password,
            })
            commit('USER_LOGIN', {
                accessToken: data.access_token,
                tokenType: data.token_type
            });
            return Promise.resolve();
        } catch (error) {
            return Promise.reject(error);
        }
    },

    async signOut({ commit }) {
        try {
            await axios.post(API_BASE_URL + '/auth/logout');
            commit('USER_LOGOUT');
            return Promise.resolve();
        } catch (error) {
            return Promise.reject(error);
        }
    },
}

const getters = {
    hasToken: state => !!state.token,
    isLoggedIn: state => state.isLoggedIn,
    hasAuthenticatedUser: state => !!state.user.id,
    getAuthenticatedUser: state => state.user,
    getToken: state => state.token,
    getFullName: state => `${state.user.firstName} ${state.user.lastName}`,
}

export default {
    state,
    getters,
    mutations,
    actions
}