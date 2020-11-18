import api from "./api";
import store from "./store";

export async function auth(to, from, next) {
    if (!store.state.auth.token) {
        return next({name: 'login'});
    }

    try {
        const response = await api.get('/user', {
            headers: {
                'Authorization': `Bearer ${store.state.auth.token}`
            }
        });

        store.commit('auth/setUser', response.data.data);

        return next();
    } catch (e) {
        store.commit('auth/resetState');
        return next({name: 'login'});
    }
};

export async function guest(to, from, next) {
    if (!store.state.auth.token) {
        return next();
    }

    try {
        const response = await api.get('/user', {
            headers: {
                'Authorization': `Bearer ${store.state.auth.token}`
            }
        });

        store.commit('auth/setUser', response.data.data);

        return next({name: 'dashboard.index'});
    } catch (e) {
        store.commit('auth/resetState');
        return next();
    }
}