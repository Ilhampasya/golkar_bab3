require("./bootstrap");
import Vue from "vue";
import store from "./store";
import VueContentPlaceholders from 'vue-content-placeholders'
import api from "./api";
import VueToastr from "vue-toastr";

Vue.use(VueToastr, {
    defaultStyle: { opacity: 1, boxShadow: "none" }
});
Vue.use(VueContentPlaceholders)

const app = new Vue({
    store,
    router: require("./router").default,
    template: '<div id="app"><router-view key="$route.fullPath"/></div>'
}).$mount("#app");