<template>
  <div>
    <div class="flex">
      <div class="w-1/2 lg:w-full"><PageTitle name="Pengguna" /></div>
      <div class="w-1/2 lg:w-1/4 text-right">
        <button
          class="shadow-xl text-xs lg:text-sm outline-none bg-primary rounded-md text-dark font-semibold py-2 px-4"
        >
          Tambah
        </button>
      </div>
    </div>
    <Table
      :headers="[['No', 'Nama', 'E-mail', '']]"
      :source="'/roles/Pengguna'"
      :handlers="{
        handleResponseData: handleResponseDataTable,
        columns: columnsDataTable,
      }"
    />
  </div>
</template>
<script>
import { PageTitle, Table } from "./partials";

export default {
  components: {
    PageTitle,
    Table,
  },

  methods: {
    handleResponseDataTable(data) {
      return data.data.users;
    },

    columnsDataTable() {
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
  },

  mounted() {
    setTimeout(() => (this.$parent.loading = false), 500);
    feather.replace();
    this.$parent.$refs.navbar.resize();
    this.$parent.$refs.sidebar.resize();
  },

  beforeDestroy() {
    if (this.$parent.$refs.navbar) {
      this.$parent.$refs.navbar.toggle = false;
      this.$parent.loading = true;
    }
  },
};
</script>