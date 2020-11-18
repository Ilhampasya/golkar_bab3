let axios = require('axios');
import store from "./store";

axios = axios.create({
    baseURL: process.env.MIX_API_URL,
    headers: {
        'X-Requested-With': 'XMLHttpRequest'
    }
})

export default {
    get(...args) {
        return axios.get(...args);
    },

    post(...args) {
        return axios.post(...args);
    },

    put(...args) {
        return axios.put(...args);
    },

    delete(...args) {
        return axios.delete(...args);
    }
}