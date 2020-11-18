<template>
  <div>
    <div class="flex">
      <div class="w-full lg:w-1/2 xl:w-1/2 --login-interact-section min-h-screen bg-dark">
        <div class="py-6 px-6 md:py-8 md:px-8 lg:py-10 lg:px-10">
          <div class="mb-12">
            <img src="/storage/sites/logo.png" class="h-10 w-auto">
          </div>
          <div class="mb-6 text-white mb-2">
            <span class="block text-lg font-semibold"> Masuk </span>
            <span class="text-sm">
              Bagi anda yang sudah terdaftar, silakan masuk
            </span>
          </div>
          <form @submit.prevent="login">
            <div class="mb-6">
              <label class="block text-gray-200 text-sm font-semibold mb-1"
                >E-mail</label
              >
              <input
                class="text-sm bg-dark-gray appearance-none border-2 rounded w-full py-2 px-4 text-gray-200 leading-tight focus:outline-none focus:bg-dark-gray"
                :class="
                  (form_errors.email || retryAfter > 0)
                    ? 'border-red-400 focus:border-red-400'
                    : 'border-dark-gray'
                "
                type="text"
                placeholder="alamat@email.com"
                v-model="form.email"
              />
              <div class="mt-1" v-if="form_errors.email || retryAfter">
                <span
                  class="text-red-500 text-xs font-medium"
                  v-text="form_errors.email ? form_errors.email[0] : `Terlalu banyak upaya masuk. Silahkan coba lagi dalam ${retryAfter} detik.`"
                ></span>
              </div>
            </div>
            <div class="mb-3 relative">
              <label class="block text-gray-200 text-sm font-semibold mb-1"
                >Kata Sandi</label
              >
              <div class="relative">
                <input
                  class="text-sm bg-dark-gray appearance-none border-2 rounded w-full py-2 px-4 text-gray-200 leading-tight focus:outline-none focus:bg-dark-gray"
                  :class="
                    form_errors.password
                      ? 'border-red-400 focus:border-red-400'
                      : 'border-dark-gray'
                  "
                  :type="showPassword ? 'text' : 'password'"
                  autocomplete="false"
                  :placeholder="showPassword ? 'password' : '********'"
                  v-model="form.password"
                />
                <div class="absolute --show-hide-password cursor-pointer">
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
                    v-if="!showPassword"
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
            <div class="mb-10 w-full">
              <router-link
                :to="{ name: 'forgot_password' }"
                class="text-white text-sm font-semibold"
                v-text="'Lupa Kata Sandi?'"
              />
            </div>
            <div class="w-full">
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
                  Masuk
                </span>
              </button>
            </div>
          </form>
          <div class="mt-6">
            <div class="flex items-center align-middle">
              <span class="mr-1 text-gray-400 text-xs font-semibold flex">
                Belum Punya Akun?
              </span>
              <router-link
                :to="{ name: 'register' }"
                class="text-white text-sm font-semibold"
                v-text="'Daftar'"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="hidden lg:block xl:block w-full relative">
        <div class="--login-image-section"></div>
      </div>
    </div>
  </div>
</template>

<script>
import api from "../api";
import store from "../store";

export default {
  data() {
    return {
      app_name: process.env.MIX_APP_NAME,
      loading: false,
      retryAfter: 0,
      lastIntervalRetryAfter: null,
      form: {
        email: "",
        password: "",
        remember_me: false,
      },
      form_errors: {},
      showPassword: false,
    };
  },

  mounted() {
    feather.replace();

    this.resizeLoginImageSection();
    window.addEventListener("resize", (e) => this.resizeLoginImageSection());

    document
      .querySelector(".--show-hide-password")
      .addEventListener("click", (e) => {
        this.showPassword = !this.showPassword;
      });
  },

  methods: {
    async login() {
      if (!this.loading) {
        this.loading = true;
        this.form_errors = {};
        const response = await api.post("/login", this.form).catch((e) => {
          this.loading = false;
          switch (e.response.status) {
            case 422:
              this.form_errors = e.response.data.errors;
              break;

            case 429:
              this.retryAfter = e.response.headers['retry-after'];
              if (this.lastIntervalRetryAfter !== null) {
                clearInterval(this.lastIntervalRetryAfter);
              }
              
              this.lastIntervalRetryAfter = setInterval(() => {
                this.retryAfter--;
                if (this.retryAfter <= 0) {
                  clearInterval(this.lastIntervalRetryAfter);
                }
              }, 1000);
              break;
          }
        });

        if (response) {
          this.loading = false;
          store.commit("auth/setToken", response.data.data.token);
          this.$router.push({
            name: "dashboard.index",
          });
        }
      }
    },
    resizeLoginImageSection() {
      const loginImageSection = document.querySelector(
        ".--login-image-section"
      );
      
      if (loginImageSection) {
        loginImageSection.style.height = window.innerHeight + "px";
        loginImageSection.style.width = loginImageSection.parentElement.clientWidth + "px";
      }
    },
  },
};
</script>
<style lang="scss" scoped>
.--login-interact-section {
  .container {
    padding: 2.5rem;
  }
  .--show-hide-password {
    top: 21.5%;
    right: 0;
    margin-right: 10px;
  }
}
.--login-image-section {
  background: url("/storage/sites/bg-login.jpg");
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  position: fixed;
  background-color: #000;
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
