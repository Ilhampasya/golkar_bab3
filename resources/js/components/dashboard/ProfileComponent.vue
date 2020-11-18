<template>
  <div>
    <PageTitle name="Profil" />
    <div class="flex">
      <div
        class="w-1/4 bg-dark-gray rounded-lg overflow-hidden shadow-lg text-gray-200"
      >
        <div class="px-6 py-4">
          <div
            class="font-bold mb-2 text-xs lg:text-sm xl:text-sm flex items-center uppercase"
          >
            <i
              data-feather="dollar-sign"
              class="hidden md:block lg:block xl:block mr-3"
            ></i>
            Saldo
          </div>
          <div class="mt-4 text-sm lg:text-xl font-bold">
            <content-placeholders :rounded="true">
              <content-placeholders-text :lines="1" />
            </content-placeholders>
          </div>
        </div>
      </div>
      <div
        class="w-1/4 bg-dark-gray ml-4 rounded-lg overflow-hidden shadow-lg text-gray-200"
      >
        <div class="px-6 py-4">
          <div
            class="font-bold mb-2 text-xs lg:text-sm xl:text-sm flex items-center uppercase"
          >
            <i
              data-feather="edit"
              class="hidden md:block lg:block xl:block mr-3"
            ></i>
            Tulisan
          </div>
          <div class="mt-4 text-sm lg:text-xl font-bold">
            <content-placeholders :rounded="true">
              <content-placeholders-text :lines="1" />
            </content-placeholders>
          </div>
        </div>
      </div>
      <div
        class="w-1/4 bg-dark-gray ml-4 rounded-lg overflow-hidden shadow-lg text-gray-200"
      >
        <div class="px-6 py-4">
          <div
            class="font-bold mb-2 text-xs lg:text-sm xl:text-sm flex items-center uppercase"
          >
            <i
              data-feather="activity"
              class="hidden md:block lg:block xl:block mr-3"
            ></i>
            Transaksi
          </div>
          <div class="mt-4 text-sm lg:text-xl font-bold">
            <content-placeholders :rounded="true">
              <content-placeholders-text :lines="1" />
            </content-placeholders>
          </div>
        </div>
      </div>
      <div
        class="w-1/4 bg-dark-gray ml-4 rounded-lg overflow-hidden shadow-lg text-gray-200"
      >
        <div class="px-6 py-4">
          <div
            class="font-bold mb-2 text-xs lg:text-sm xl:text-sm flex items-center uppercase"
          >
            <i
              data-feather="dollar-sign"
              class="hidden md:block lg:block xl:block mr-3"
            ></i>
            Saldo
          </div>
          <div class="mt-4 text-sm lg:text-xl font-bold">
            <content-placeholders :rounded="true">
              <content-placeholders-text :lines="1" />
            </content-placeholders>
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

  mounted() {
    setTimeout(() => (this.$parent.loading = false), 500);
    feather.replace();
    this.$parent.$refs.sidebar.resize();
    this.$parent.$refs.navbar.resize();
  },

  beforeDestroy() {
    if (this.$parent.$refs.navbar) {
      this.$parent.loading = true;
      this.$parent.$refs.navbar.toggle = false;    
    }
  },
};
</script>