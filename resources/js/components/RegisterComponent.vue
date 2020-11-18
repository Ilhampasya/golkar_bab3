<template>
  <div>
    <div class="flex">
      <div class="w-full lg:w-1/2 xl:w-1/2 --register-interact-section min-h-screen bg-dark">
        <div class="py-6 px-6 md:py-8 md:px-8 lg:py-10 lg:px-10">
          <div class="mb-12">
            <img src="/storage/sites/logo.png" class="h-10 w-auto">
          </div>
          <FlashMessage 
            class="mb-8" 
            :type="notification.type" 
            :title="notification.title" 
            :message="notification.message"
            v-if="notification.show"
          />
          <div class="mb-6 text-white mb-2">
            <span class="block text-lg font-semibold"> Daftar </span>
            <span class="text-sm">
              Bagi anda yang belum terdaftar, silakan daftar
            </span>
          </div>
          <form @submit.prevent="register">
            <div class="mb-6">
              <label class="block text-gray-200 text-sm font-semibold mb-1"
                >Nama Depan</label
              >
              <input
                class="text-sm bg-dark-gray focus:bg-dark-gray appearance-none border-2 rounded w-full py-2 px-4 text-gray-200 leading-tight focus:outline-none focus:bg-white"
                :class="
                  form_errors.first_name
                    ? 'border-red-400 focus:border-red-400'
                    : 'border-dark-gray'
                "
                type="text"
                placeholder="Nama Depan"
                v-model="form.first_name"
              />
              <div class="mt-1" v-if="form_errors.first_name">
                <span
                  class="text-red-500 text-xs font-medium"
                  v-html="form_errors.first_name[0]"
                ></span>
              </div>
            </div>
            <div class="mb-6">
              <label class="block text-gray-200 text-sm font-semibold mb-1"
                >Nama Belakang</label
              >
              <input
                class="text-sm bg-dark-gray focus:bg-dark-gray appearance-none border-2 rounded w-full py-2 px-4 text-gray-200 leading-tight focus:outline-none focus:bg-white"
                :class="
                  form_errors.last_name
                    ? 'border-red-400 focus:border-red-400'
                    : 'border-dark-gray'
                "
                type="text"
                placeholder="Nama Belakang"
                v-model="form.last_name"
              />
              <div class="mt-1" v-if="form_errors.last_name">
                <span
                  class="text-red-500 text-xs font-medium"
                  v-html="form_errors.last_name[0]"
                ></span>
              </div>
            </div>
            <div class="mb-6">
              <label class="block text-gray-200 text-sm font-semibold mb-1"
                >E-mail</label
              >
              <input
                class="text-sm bg-dark-gray focus:bg-dark-gray appearance-none border-2 rounded w-full py-2 px-4 text-gray-200 leading-tight focus:outline-none focus:bg-white"
                :class="
                  form_errors.email
                    ? 'border-red-400 focus:border-red-400'
                    : 'border-dark-gray'
                "
                type="text"
                placeholder="alamat@email.com"
                v-model="form.email"
              />
              <div class="mt-1" v-if="form_errors.email">
                <span
                  class="text-red-500 text-xs font-medium"
                  v-html="form_errors.email[0]"
                ></span>
              </div>
            </div>
            <div class="mb-6 relative">
              <label class="block text-gray-200 text-sm font-semibold mb-1"
                >Kata Sandi</label
              >
              <div class="relative">
                <input
                  class="text-sm bg-dark-gray focus:bg-dark-gray appearance-none border-2 rounded w-full py-2 px-4 text-gray-200 leading-tight focus:outline-none focus:bg-white"
                  :class="
                    form_errors.password
                      ? 'border-red-400 focus:border-red-400'
                      : 'border-dark-gray'
                  "
                  :type="showPassword.password ? 'text' : 'password'"
                  autocomplete="false"
                  :placeholder="showPassword.password ? 'password' : '********'"
                  v-model="form.password"
                />
                <div class="absolute --show-hide-password cursor-pointer" @click="showPassword.password = !showPassword.password">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-eye text-gray-400"
                    data-v-4d2414bf=""
                    v-if="!showPassword.password"
                  >
                    <path
                      d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"
                    ></path>
                    <circle cx="12" cy="12" r="3"></circle>
                  </svg>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-eye-off text-gray-400"
                    data-v-4d2414bf=""
                    v-else
                  >
                    <path
                      d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"
                    ></path>
                    <line x1="1" y1="1" x2="23" y2="23"></line>
                  </svg>
                </div>
              </div>
              <div class="mt-1" v-if="form_errors.password">
                <span
                  class="text-red-500 text-xs font-medium"
                  v-html="form_errors.password[0]"
                ></span>
              </div>
            </div>
            <div class="mb-10 relative">
              <label class="block text-gray-200 text-sm font-semibold mb-1"
                >Konfirmasi Kata Sandi</label
              >
              <div class="relative">
                <input
                  class="text-sm bg-dark-gray focus:bg-dark-gray appearance-none border-2 rounded w-full py-2 px-4 text-gray-200 leading-tight focus:outline-none focus:bg-white border-dark-gray"
                  :type="showPassword.pasword_confirmation ? 'text' : 'password'"
                  autocomplete="false"
                  :placeholder="showPassword.pasword_confirmation ? 'password' : '********'"
                  v-model="form.password_confirmation"
                />
                <div class="absolute --show-hide-password cursor-pointer" @click="showPassword.pasword_confirmation = !showPassword.pasword_confirmation">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-eye text-gray-400"
                    data-v-4d2414bf=""
                    v-if="!showPassword.pasword_confirmation"
                  >
                    <path
                      d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"
                    ></path>
                    <circle cx="12" cy="12" r="3"></circle>
                  </svg>
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-eye-off text-gray-400"
                    data-v-4d2414bf=""
                    v-else
                  >
                    <path
                      d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"
                    ></path>
                    <line x1="1" y1="1" x2="23" y2="23"></line>
                  </svg>
                </div>
              </div>
            </div>
            <div class="w-ful">
              <button
                class="shadow-xl outline-none bg-primary w-full rounded-full text-dark font-bold py-2 px-4"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  xmlns:xlink="http://www.w3.org/1999/xlink"
                  style="
                    margin: auto;
                    background: none;
                    display: block;
                    shape-rendering: auto;
                  "
                  width="24px"
                  height="24px"
                  viewBox="0 0 100 100"
                  preserveAspectRatio="xMidYMid"
                  v-if="loading"
                >
                  <circle
                    cx="50"
                    cy="50"
                    r="32"
                    stroke-width="8"
                    stroke="#000000"
                    stroke-dasharray="50.26548245743669 50.26548245743669"
                    fill="none"
                    stroke-linecap="round"
                  >
                    <animateTransform
                      attributeName="transform"
                      type="rotate"
                      repeatCount="indefinite"
                      dur="1s"
                      keyTimes="0;1"
                      values="0 50 50;360 50 50"
                    ></animateTransform>
                  </circle>
                  <!-- [ldio] generated by https://loading.io/ -->
                </svg>
                <span v-else>
                  Daftar
                </span>
              </button>
            </div>
            <div class="mt-6">
              <div class="flex items-center align-middle">
                <span class="mr-1 text-gray-400 text-xs font-semibold flex">
                  Sudah Punya Akun?
                </span>
                <router-link
                  :to="{ name: 'login' }"
                  class="text-white text-sm font-semibold"
                  v-text="'Masuk'"
                />
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="hidden lg:block xl:block w-full relative">
        <div class="--register-image-section"></div>
      </div>
    </div>
  </div>
</template>

<script>
import api from "../api";
import { FlashMessage } from "./dashboard/partials";

export default {
  components: {
    FlashMessage,
  },

  methods: {
    async register() {
      if (!this.loading) {
        this.loading = true;
        this.form_errors = {};
        const response = await api.post("/register", this.form).catch((e) => {
          if (!e.response) {
            this.loading = false;
            this.notification = this.notificationState(true, 'danger', 'Ada Kesalahan Sistem!', 'Mohon maaf atas ketidak nyamanannya.');
          } else if (e.response.status === 422) {
            this.loading = false;
            this.form_errors = e.response.data.errors;
          }
        });

        if (response) {
          this.loading = false;
          
          this.notification = this.notificationState(true, 'success', 'Pendaftaran Berhasil!', 'Cek inbox di email anda untuk verifikasi akun kamu.');

          this.form = {
            first_name: "",
            last_name: "",
            email: "",
            password: "",
            pasword_confirmation: "",
          };
        }
      }
    },

    notificationState(show = false, type='', title = '', message = '') {
      if (this.lastNotificationTimeOutHandler) {
        clearTimeout(this.lastNotificationTimeOutHandler);
      }

      this.lastNotificationTimeOutHandler = setTimeout(() => {
        this.notification = this.notificationState();
      }, 3000);
      
      return {
        show,
        type,
        title,
        message
      }
    },

    resizeRegisterImageSection() {
      const registerImageSection = document.querySelector(
        ".--register-image-section"
      );

      if (registerImageSection) {
        registerImageSection.style.height = window.innerHeight + "px";
        registerImageSection.style.width = registerImageSection.parentElement.clientWidth + "px";
      }
    },
  },

  data() {
    return {
      app_name: process.env.MIX_APP_NAME,
      loading: false,
      form_errors: {},
      lastNotificationTimeOutHandler: null,
      notification: this.notificationState(),
      form: {
        first_name: "",
        last_name: "",
        email: "",
        password: "",
        pasword_confirmation: "",
      },
      showPassword: {
        password: false,
        pasword_confirmation: false,
      },
    };
  },

  mounted() {
    feather.replace();

    this.resizeRegisterImageSection();
    window.addEventListener("resize", (e) => this.resizeRegisterImageSection());
  },
};
</script>
<style lang="scss" scoped>
.--register-interact-section {
  .container {
    padding: 2.5rem;
  }
  .--show-hide-password {
    top: 21.5%;
    right: 0;
    margin-right: 10px;
  }
}
.--register-image-section {
  background: url("/storage/sites/bg-login.jpg");
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  background-color: rgb(0, 0, 0, 3);
  position: fixed;
  &::after {
    content:'\A';
    position:absolute;
    width:100%;
    height:100%;
    top:0; 
    left:0;
    background:rgba(0,0,0,0.3);
  }
}

input::placeholder {
  @apply text-gray-400;
}
</style>
