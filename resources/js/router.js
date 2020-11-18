import Vue from "vue";
import store from "./store";
import VueRouter from "vue-router";
import { Index, Login, Register, ForgotPassword, DashboardLayout, DashboardIndex, DashboardCadres, DashboardUsers, DashboardProfile, DashboardCreateCadre, DashboardUpdateCadre } from "./components";
import { auth, guest } from "./middleware";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "index",
            component: Index
        },
        {
            path: "/dashboard",
            component: DashboardLayout,
            children: [
                {
                    path: "",
                    beforeEnter: auth,
                    name: "dashboard.index",
                    component: DashboardIndex,
                    meta: {
                        title: "Dashboard"
                    },
                },
                {
                    path: "cadres",
                    beforeEnter: auth,
                    name: "dashboard.cadres",
                    component: DashboardCadres,
                    meta: {
                        title: "Kader - Dashboard"
                    },
                },
                {
                    path: "cadres/create",
                    beforeEnter: auth,
                    name: "dashboard.cadres.create",
                    component: DashboardCreateCadre,
                    meta: {
                        title: "Tambah Kader - Dashboard"
                    },
                },
                {
                    path: "cadres/:id",
                    beforeEnter: auth,
                    name: "dashboard.cadres.update",
                    component: DashboardUpdateCadre,
                    meta: {
                        title: "Perbarui Kader - Dashboard"
                    },
                },
                {
                    path: "users",
                    beforeEnter: auth,
                    name: "dashboard.users",
                    component: DashboardUsers,
                    meta: {
                        title: "Pengguna - Dashboard"
                    },
                },
                {
                    path: "profile",
                    beforeEnter: auth,
                    name: "dashboard.profile",
                    component: DashboardProfile,
                    meta: {
                        title: "Profile - Dashboard"
                    }
                }
            ]
        },
        {
            path: "/logout",
            name: "logout",
            beforeEnter: auth,
            component: {
                beforeRouteEnter(to, from, next) {
                    store.commit('auth/resetState');
                    next({name: 'login'});
                },
                template: '<div></div>'
            }
        },
        {
            path: "/login",
            name: "login",
            beforeEnter: guest,
            component: Login
        },
        {
            path: "/register",
            name: "register",
            beforeEnter: guest,
            component: Register
        },
        {
            path: "/forgot-password",
            name: "forgot_password",
            beforeEnter: guest,
            component: ForgotPassword
        },
        {
            path: "*",
            name: "404",
            component: {
                beforeRouteEnter() {
                    window.location.href = '/404'
                },
            }
        }
    ],
});

router.beforeEach((to, from, next) => {
    if (to.meta.title) {
        document.title = to.meta.title + ' | ' + process.env.MIX_APP_NAME;
    } else {
        document.title = process.env.MIX_APP_NAME;
    }

    next();
});

router.afterEach((to, from, next) => {
    window.scroll({
        top: 0, 
        left: 0, 
    });
});

export default router;