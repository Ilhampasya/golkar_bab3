<template>
  <div>
    <div class="flex mb-5">
      <div class="w-1/2 lg:w-full"><PageTitle name="Tambah Kader" /></div>
      <div class="w-1/2 lg:w-1/4 text-right">
        <button
          :to="{ name: 'dashboard.cadres.create' }"
          class="shadow-xl text-xs lg:text-sm outline-none bg-primary rounded-md text-dark font-semibold py-2 px-4"
        >
          Simpan
        </button>
      </div>
    </div>
    <div class="flex flex-wrap lg:flex-no-wrap">
      <div
        id="--web-navigation-section"
        class="w-full md:w-1/4 pr-0 md:pr-5 mb-5 md:mb-0"
      >
        <div class="w-full rounded-lg px-5 py-1">
          <div class="--web-navigation-tab --active">
            <span> Informasi Dasar </span>
          </div>
          <div class="--web-navigation-tab">
            <span> Pendidikan </span>
          </div>
          <div class="--web-navigation-tab">
            <span> Karir </span>
          </div>
          <div class="--web-navigation-tab">
            <span> Biografi </span>
          </div>
        </div>
      </div>
      <div class="w-full">
        <div class="flex flex-wrap">
          <div class="w-full md:w-1/2 px-0 md:px-2">
            <div class="mb-6">
              <label class="block text-gray-200 text-sm font-semibold mb-1"
                >Nama</label
              >
              <input
                class="text-sm bg-dark-gray appearance-none border-2 rounded w-full py-2 px-4 text-gray-200 leading-tight focus:outline-none focus:bg-dark-gray"
                :class="
                  form_errors.name
                    ? 'border-red-400 focus:border-red-400'
                    : 'border-dark-gray'
                "
                type="text"
                placeholder="Nama"
                v-model="form.name"
              />
              <div class="mt-1" v-if="form_errors.name">
                <span
                  class="text-red-500 text-xs font-medium"
                  v-text="form_errors.name[0]"
                ></span>
              </div>
            </div>
          </div>
          <div class="w-full md:w-1/2 px-0 md:px-2">
            <div class="mb-6">
              <label class="block text-gray-200 text-sm font-semibold mb-1"
                >Nama</label
              >
              <input
                class="text-sm bg-dark-gray appearance-none border-2 rounded w-full py-2 px-4 text-gray-200 leading-tight focus:outline-none focus:bg-dark-gray"
                :class="
                  form_errors.name
                    ? 'border-red-400 focus:border-red-400'
                    : 'border-dark-gray'
                "
                type="text"
                placeholder="Nama"
                v-model="form.name"
              />
              <div class="mt-1" v-if="form_errors.name">
                <span
                  class="text-red-500 text-xs font-medium"
                  v-text="form_errors.name[0]"
                ></span>
              </div>
            </div>
          </div>
          <div class="w-full md:w-1/2 px-0 md:px-2">
            <div class="mb-6">
              <label class="block text-gray-200 text-sm font-semibold mb-1"
                >E-mail</label
              >
              <input
                class="text-sm bg-dark-gray appearance-none border-2 rounded w-full py-2 px-4 text-gray-200 leading-tight focus:outline-none focus:bg-dark-gray"
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
                  v-text="form_errors.email[0]"
                ></span>
              </div>
            </div>
          </div>
          <div class="w-full md:w-1/2 px-0 md:px-2">
            <div class="mb-6">
              <label class="block text-gray-200 text-sm font-semibold mb-1"
                >Alamat</label
              >
              <input
                class="text-sm bg-dark-gray appearance-none border-2 rounded w-full py-2 px-4 text-gray-200 leading-tight focus:outline-none focus:bg-dark-gray"
                :class="
                  form_errors.name
                    ? 'border-red-400 focus:border-red-400'
                    : 'border-dark-gray'
                "
                type="text"
                placeholder="Alamat"
                v-model="form.meta.address"
              />
              <div class="mt-1" v-if="form_errors.name">
                <span
                  class="text-red-500 text-xs font-medium"
                  v-text="form_errors.name[0]"
                ></span>
              </div>
            </div>
          </div>
          <div class="w-full md:w-1/2 px-0 md:px-2">
            <div class="mb-6">
              <label class="block text-gray-200 text-sm font-semibold mb-1"
                >Alamat</label
              >
              <input
                class="text-sm bg-dark-gray appearance-none border-2 rounded w-full py-2 px-4 text-gray-200 leading-tight focus:outline-none focus:bg-dark-gray"
                :class="
                  form_errors.name
                    ? 'border-red-400 focus:border-red-400'
                    : 'border-dark-gray'
                "
                type="text"
                placeholder="Alamat"
                v-model="form.meta.address"
              />
              <div class="mt-1" v-if="form_errors.name">
                <span
                  class="text-red-500 text-xs font-medium"
                  v-text="form_errors.name[0]"
                ></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { PageTitle } from "./partials";

export default {
  components: {
    PageTitle,
  },

  methods: {
    resizeNavSection() {
      document
        .querySelector("#--dashboard-route")
        .addEventListener("resize", (e) => {
          const webNavigationSection = document.querySelector(
            "#--web-navigation-section"
          );
          if (window.innerWidth > 1024 && webNavigationSection) {
            if (e.target.clientWidth > 1280) {
              webNavigationSection.classList.remove("md:w-1/4");
              webNavigationSection.classList.add("md:w-1/5");
            } else {
              webNavigationSection.classList.remove("md:w-1/5");
              webNavigationSection.classList.add("md:w-1/4");
            }
          }
        });
    },
  },

  data: () => ({
    form: {
      name: "",
      email: "",
      meta: {
        address: "",
      },
    },
    form_errors: {},
  }),

  mounted() {
    this.resizeNavSection();
    window.addEventListener("resize", (e) => this.resizeNavSection());

    document.querySelectorAll(".--web-navigation-tab").forEach((el) => {
      el.addEventListener("click", (e) => {
        document.querySelectorAll(".--web-navigation-tab").forEach((el) => {
          el.classList.remove("--active");
        });
        el.classList.add("--active");
      });
    });
    
    feather.replace();
    this.$parent.$refs.navbar.resize();
    this.$parent.$refs.sidebar.resize();
  },

  beforeDestroy() {
    if (this.$parent.$refs.navbar) {
      this.$parent.$refs.navbar.toggle = false;
    }
  },
};
</script>
<style lang="scss" scoped>
.--web-navigation-tab {
  @apply text-sm;
  @apply text-gray-400;
  @apply cursor-pointer;
  @apply px-1;
  @apply rounded-lg;
  @apply font-semibold;
  &.--active {
    @apply font-bold;
    @apply text-gray-200;
    &::after {
      @apply bg-primary;
      content: "";
      display: block;
      height: 3px;
      margin: 5px 0 0;
      width: 60px;
    }
  }
  &:first-child {
    @apply pb-2;
  }
  &:not(:first-child) {
    @apply mt-2;
    @apply py-2;
  }
}
</style>