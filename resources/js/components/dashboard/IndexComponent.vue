<template>
  <div>
    <PageTitle name="Rumah" />
    <div class="flex">
      <div
        class="w-1/3 bg-dark-gray rounded-lg overflow-hidden shadow-lg text-gray-200"
      >
        <div class="px-6 py-4">
          <div
            class="font-bold mb-2 text-xs lg:text-sm xl:text-sm flex items-center uppercase"
          >
            <i
              data-feather="user-check"
              class="hidden md:block lg:block xl:block mr-3"
            ></i>
            Kader
          </div>
          <div class="mt-4 text-sm lg:text-xl font-bold">
            <div v-if="!cadres.fetched">
              <content-placeholders :rounded="true">
                <content-placeholders-text :lines="1" />
              </content-placeholders>
            </div>
            <div v-else>
              <span v-text="cadres.data.users.total"></span>
            </div>
          </div>
        </div>
      </div>
      <div
        class="w-1/3 bg-dark-gray ml-4 rounded-lg overflow-hidden shadow-lg text-gray-200"
      >
        <div class="px-6 py-4">
          <div
            class="font-bold mb-2 text-xs lg:text-sm xl:text-sm flex items-center uppercase"
          >
            <i
              data-feather="users"
              class="hidden md:block lg:block xl:block mr-3"
            ></i>
            Pengguna
          </div>
          <div class="mt-4 text-sm lg:text-xl font-bold">
            <div v-if="!users.fetched">
              <content-placeholders :rounded="true">
                <content-placeholders-text :lines="1" />
              </content-placeholders>
            </div>
            <div v-else>
              <span v-text="users.data.users.total"></span>
            </div>
          </div>
        </div>
      </div>
      <div
        class="w-1/3 bg-dark-gray ml-4 rounded-lg overflow-hidden shadow-lg text-gray-200"
      >
        <div class="px-6 py-4">
          <div
            class="font-bold mb-2 text-xs lg:text-sm xl:text-sm flex items-center uppercase"
          >
            <i
              data-feather="key"
              class="hidden md:block lg:block xl:block mr-3"
            ></i>
            Hak Akses
          </div>
          <div class="mt-4 text-sm lg:text-xl font-bold">
            <div v-if="!roles.fetched">
              <content-placeholders :rounded="true">
                <content-placeholders-text :lines="1" />
              </content-placeholders>
            </div>
            <div v-else>
              <span v-text="roles.data.total"> </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-12">
      <h3 class="font-bold text-sm lg:text-base text-gray-200 uppercase mb-4">
        <router-link
          :to="{ name: 'dashboard.cadres' }"
          v-text="'Kader'"
        />
      </h3>
      <Table
        :headers="[['No', 'Nama', 'Dapil', '']]"
        :source="'/roles/Kader'"
        :pagination="false"
        :handlers="{
          handleResponseData: handleResponseDataCadresOrUsersTable,
          columns: columnsDataCadresTable,
        }"
      />
    </div>
    <div class="mt-12">
      <h3 class="font-bold text-sm lg:text-base text-gray-200 uppercase mb-4">
        <router-link
          :to="{ name: 'dashboard.users' }"
          v-text="'Pengguna'"
        />
      </h3>
      <Table
        :headers="[['No', 'Nama', 'Dapil', '']]"
        :source="'/roles/Pengguna'"
        :pagination="false"
        :handlers="{
          handleResponseData: handleResponseDataCadresOrUsersTable,
          columns: columnsDataCadresTable,
        }"
      />
    </div>
  </div>
</template>
<script>
import api from "../../api";
import { PageTitle, Table } from "./partials";

export default {
  components: {
    PageTitle,
    Table,
  },

  methods: {
    handleResponseDataCadresOrUsersTable(data) {
      return data.data.users;
    },
    columnsDataCadresTable() {
      return [
        {
          name: "__index__",
        },
        {
          name: "name",
          render(value, data, row) {
            return `
              <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10">
                  <img src="${data.photo}" alt="" class="h-10 w-10 rounded-full">
                </div> 
                <div class="ml-4">
                  <div class="text-sm leading-5 font-semibold">
                      ${value}
                  </div> 
                </div>
              </div>
            `;
          },
        },

        {
          render() {
            return "Kabupaten Bandung";
          },
        },

        {
          render() {
            return `
              <div class="flex items-center">
                <div class="block text-yellow-500 px-4 border-r border-gray-800">
                  <a href="#">Rubah</a>
                </div>
                <div class="px-4 block text-red-500">
                  <a href="#">Hapus</a>
                </div>
              </div>
              `;
          },
        },
      ];
    },

    async fetchRoles() {
      const response = await api.get("/roles").catch((e) => console.error(e));

      if (response) {
        this.roles.data = response.data.data;

        setTimeout(() => {
          this.roles.fetched = true;
        }, 100);
      }
    },

    async fetchCadres() {
      const response = await api
        .get("/roles/Kader?users@perPage=1")
        .catch((e) => console.error(e));

      if (response) {
        this.cadres.data = response.data.data;

        setTimeout(() => {
          this.cadres.fetched = true;
        }, 100);
      }
    },

    async fetchUsers() {
      const response = await api
        .get("/roles/Pengguna?users@perPage=1")
        .catch((e) => console.error(e));

      if (response) {
        this.users.data = response.data.data;

        setTimeout(() => {
          this.users.fetched = true;
        }, 100);
      }
    },
  },

  data: () => ({
    roles: {
      data: null,
      fetched: false,
    },
    cadres: {
      data: null,
      fetched: false,
    },
    users: {
      data: null,
      fetched: false,
    },
  }),

  created() {
    this.fetchCadres();
    this.fetchUsers();
    this.fetchRoles();
  },

  mounted() {
    setTimeout(() => (this.$parent.loading = false), 500);
    feather.replace();
    this.$parent.$refs.sidebar.resize();
    this.$parent.$refs.navbar.resize();
  },

  beforeDestroy() {
    if (this.$parent.$refs.navbar) {
      this.$parent.$refs.navbar.toggle = false;
      this.$parent.loading = true;
    }
  },
};
</script>