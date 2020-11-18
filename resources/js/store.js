import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from "vuex-persistedstate";

const auth = {
    namespaced: true,
    
    state: {
        token: null,
        user: null
    },

    mutations: {
        setToken(state, token) {
            state.token = token
        },
        setUser(state, user) {
            state.user = user
        },
        resetState(state) {
           for (let x in state) {
                state[x] = null
           }
        }
    },
}

Vue.use(Vuex)

export default new Vuex.Store({
    plugins: [
        createPersistedState({
            getState: key => JSON.parse(localStorage.getItem(key)),
            setState: (key, value) => localStorage.setItem(key, JSON.stringify(value))
        })
    ],
    modules: {
        auth
    }
})