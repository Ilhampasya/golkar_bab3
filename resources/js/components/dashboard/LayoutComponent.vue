<template>
  <div id="--dashboard-base" class="relative bg-dark">
    <div class="flex">
      <div class="w-1/4 min-h-screen hidden lg:block relative">
        <Sidebar ref="sidebar" />
      </div>
      <div class="w-full min-h-screen relative">
        <Navbar ref="navbar" />
        <div id="--dashboard-route" class="flex flex-col justify-between">
          <router-view key="$route.fullPath" />
        </div>
      </div>
    </div>
    <Modal ref="modal">
      <template v-slot:modal-icon>
        <svg
          class="h-6 w-6 text-red-600"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
          />
        </svg>
      </template>
      <template v-slot:modal-title> Konfirmasi Keluar </template>
      <template v-slot:modal-contents>
        Anda akan di arahkan ke halaman masuk, ketika anda ingin mengakses halaman dashboard kembali, anda harus masuk kembali.
      </template>
      <template v-slot:modal-footer>
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
          <router-link
            :to="{name: 'logout'}"
            type="button"
            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
          >
            Keluar
          </router-link>
        </span>
        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
          <button
            @click="$refs.modal.hide"
            type="button"
            class="inline-flex justify-center w-full rounded-md border border-dark-gray px-4 py-2 bg-semi-dark text-base leading-6 font-medium text-gray-100 shadow-sm hover:text-gray-100 focus:outline-none focus:border-dark-gray focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5 bg-dark-gray"
          >
            Batal
          </button>
        </span>
      </template>
    </Modal>
  </div>
</template>
<script>
import { Navbar, Sidebar } from "./partials";
import { Modal } from "../partials";

export default {
  components: {
    Navbar,
    Sidebar,
    Modal,
  },

  data: () => ({
    app_name: process.env.MIX_APP_NAME,
  }),

  methods: {
    logout() {
      this.$refs.modal.show();
    },
  },
};
</script>

<style lang="scss" scoped>
#--dashboard-base {
  background: #f6f8fa;
}
#--dashboard-route {
  padding: 2rem;
}
</style>