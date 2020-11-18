<template>
    <div id="sidebar" class="h-full fixed z-20 bg-semi-dark">
        <div class="flex items-center pt-4 pb-4 pl-6 pr-6 text-center border-b border-dark-gray" style="height: 61px;">
            <div class="block lg:hidden">
                <svg @click="$parent.$refs.navbar.toggle = false" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x rounded text-primary border-blue-500 outline-none" data-v-1eeaed48=""><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </div>
            <div class="justify-between w-full">
                <router-link :to="{name: 'dashboard.index'}" class="text-xl font-bold tracking-widest text-primary rounded-lg dark-mode:text-white outline-none focus:outline-none">
                    <img src="/storage/sites/logo.png" class="h-10 m-auto w-auto">
                </router-link>
            </div>
        </div>
        <nav class="flex-grow px-4 pt-4 pb-8 overflow-y-auto sidebar-nav h-screen min-h-screen">
            <router-link :to="{name: 'dashboard.index'}" class="outline-none apperance-none block px-4 py-3 mt-2 text-sm font-semibold text-white hover:text-gray-900 rounded-lg flex items-center hover:bg-primary focus:outline-none">
                <i data-feather="home"> </i>
                <span class="ml-2">
                    Rumah
                </span>
            </router-link>
            <router-link :to="{name: 'dashboard.cadres'}" class="outline-none apperance-none block px-4 py-3 mt-2 text-sm font-semibold text-white hover:text-gray-900 rounded-lg flex items-center hover:bg-primary focus:outline-none">
                <i data-feather="user-check"></i>
                <span class="ml-2">
                    Kader
                </span>
            </router-link>
            <router-link :to="{name: 'dashboard.users'}" class="outline-none apperance-none block px-4 py-3 mt-2 text-sm font-semibold text-white hover:text-gray-900 rounded-lg flex items-center hover:bg-primary focus:outline-none">
                <i data-feather="users"></i>
                <span class="ml-2">
                    Pengguna
                </span>
            </router-link>
            <router-link :to="{name: 'dashboard.profile'}" class="outline-none apperance-none block px-4 py-3 mt-2 text-sm font-semibold text-white hover:text-gray-900 rounded-lg flex items-center hover:bg-primary focus:outline-none">
                <i data-feather="user"></i>
                <span class="ml-2">
                    Profil
                </span>
            </router-link>
            <a role="button" @click="$parent.logout" class="w-full outline-none apperance-none block px-4 py-3 mt-2 text-sm font-semibold text-white hover:text-gray-900 rounded-lg flex items-center hover:bg-primary focus:outline-none">
                <i data-feather="log-out"></i>
                <span class="ml-2">
                    Keluar
                </span>
            </a>
        </nav>
    </div>    
</template>
<script>
export default {
    mounted() {
        feather.replace();
        this.resize();
        window.addEventListener('resize', e => this.resize())
    },

    methods: {
        resize() {
            const sidebar = document.querySelector('#sidebar');

            if (sidebar) {
                if (window.innerWidth < 1024) {
                    if (window.innerWidth > window.innerHeight) {
                        sidebar.style.width = window.innerWidth / 2.4 + "px";
                    } else {
                        sidebar.style.width = window.innerWidth / 1.4 + "px";
                    }
                } else {
                    sidebar.style.width = (sidebar.parentNode.getBoundingClientRect().width) + 'px';
                }
            }
        }
    },
}
</script>

<style lang="scss" scoped>
    .sidebar-nav {
        .router-link-exact-active {
            @apply bg-primary;
            font-weight: 700 !important;
            color: #000 !important;
        }
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none;  /* IE 10+ */
        &::-webkit-scrollbar {
            width: 0px;
            background: transparent; /* Chrome/Safari/Webkit */
        }
    }

</style>