<template>
  <div class="relative z-10">
    <nav
      id="navbar"
      class="flex bg-semi-dark border-b border-dark-gray items-center justify-between pt-3 lg:pt-3 pb-3 lg:pb-3 pl-2 lg:pl-4 pr-2 lg:pr-4 fixed"
    >
      <div class="block flex-grow flex items-center lg:w-auto">
        <div class="w-18 lg:w-20" id="toggle">
          <button
            class="flex items-center px-3 py-2 rounded text-primary border-blue-500 outline-none"
          >
            <svg
              class="fill-current h-5 w-5"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
            </svg>
          </button>
        </div>
        <div class="lg:w-1/2 w-11/12 relative">
          <input
            class="center appearance-none rounded-full w-full py-2 px-10 text-gray-200 leading-tight focus:outline-none bg-dark-gray text-sm"
            type="text"
            id="search"
            placeholder="Pencarian"
          />
          <div class="absolute ml-2" style="top: 4px">
            <i data-feather="search" class="text-gray-300"></i>
          </div>
        </div>
        <div class="w-24 lg:w-1/2">
          <div class="float-right">
            <div class="cursor-pointer" @click="$router.push({name: 'dashboard.profile'})">
              <img
                :src="$store.state.auth.user.photo"
                class="rounded-full text-white shadow-solid h-8"
              />
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>
</template>
<script>
export default {
  data: () => ({
    toggle: false,
  }),

  mounted() {
    this.$el.style.height = this.$el.querySelector('nav').clientHeight + 'px';
    feather.replace();
    this.resize();
    window.addEventListener("resize", (e) => this.resize());

    document
      .querySelector("#toggle")
      .querySelector("button")
      .addEventListener("click", (e) => {
        this.toggle = !this.toggle;
      });
  },
  methods: {
    resize() {
      const navbar = document.querySelector("#navbar");
      if (navbar && navbar.classList.contains("fixed")) {
        navbar.style.width = navbar.parentNode.getBoundingClientRect().width + "px";
      }
    },
  },
  watch: {
    toggle: {
      handler: function (val) {
        if (val) {
          this.$parent.$refs.sidebar.resize();
          if (window.innerWidth < 1024) {
            document.querySelector('#--dashboard-route').classList.add('filter-blur-3');
            this.$parent.$refs.sidebar.$el.parentElement.classList.remove(
              "hidden"
            );
          } else {
            this.$parent.$refs.sidebar.$el.parentElement.classList.remove(
              "lg:block"
            );
          }
        } else {
          if (window.innerWidth < 1024) {
            document.querySelector('#--dashboard-route').classList.remove('filter-blur-3');
            this.$parent.$refs.sidebar.$el.parentElement.classList.add(
              "hidden"
            );
          } else {
            this.$parent.$refs.sidebar.$el.parentElement.classList.add(
              "lg:block"
            );
          }
        }
        this.resize();
        document.querySelector('#--dashboard-route').dispatchEvent(new Event('resize'));
      },
    },
  },
};
</script>
<style lang="scss" scoped>
.w-18 {
  width: 4.3rem;
}
#search::placeholder {
  @apply text-gray-300;
  @apply text-sm;
  @apply font-semibold;
}
</style>