<template>
  <div>
    <div class="flex">
      <div class="w-1/2 lg:w-full"><PageTitle name="Kader" /></div>
      <div
        class="w-1/2 lg:w-1/4 text-right"
        v-if="$store.state.auth.user.role.name === 'Administrator'"
      >
        <router-link
          :to="{ name: 'dashboard.cadres.create' }"
          class="shadow-xl text-xs lg:text-sm outline-none bg-primary rounded-md text-dark font-semibold py-2 px-4"
        >
          Tambah
        </router-link>
      </div>
    </div>
    <Table
      ref="table"
      :headers="[['No', 'Nama', 'Dapil', '']]"
      :source="'/roles/Kader'"
      :handlers="{
        handleResponseData: handleResponseDataTable,
        columns: columnsDataTable,
      }"
      :events="{
        render: renderEventTable,
      }"
    />
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
        Anda akan di arahkan ke halaman masuk, ketika anda ingin mengakses
        halaman dashboard kembali, anda harus masuk kembali.
      </template>
      <template v-slot:modal-footer>
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
          <a
            role="button"
            @click="deleteCadre"
            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
          >
            Hapus
          </a>
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
import api from "../../api";
import { PageTitle, Table } from "./partials";
import { Modal } from "../partials";

export default {
  components: {
    PageTitle,
    Table,
    Modal,
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
          render(name, data, row, col) {
            return `
              <div class="flex items-center test">
                <div class="block text-yellow-500 px-4 border-r border-gray-800 cursor-pointer" data-action="update" data-row="${row}">
                  <span>Rubah</span>
                </div>
                <div class="px-4 block text-red-500 cursor-pointer" data-action="delete" data-row="${row}">
                  <span>Hapus</span>
                </div>
              </div>
              `;
          },
        },
      ];
    },
    renderEventTable(table) {
      table
        .querySelector("tbody")
        .querySelectorAll("[data-action]")
        .forEach((el) => {
          el.addEventListener("click", (e) => {
            if (el.getAttribute("data-action") === "update") {
              this.$router.push({
                name: "dashboard.cadres.update",
                params: {
                  id: this.$refs.table.data.data[el.getAttribute("data-row")]
                    .id,
                },
              });
            } else {
              this.modal_delete_id = this.$refs.table.data.data[
                el.getAttribute("data-row")
              ].id;
              this.$refs.modal.show();
            }
          });
        });
    },

    async deleteCadre() {
      this.$refs.modal.hide();
      const response = (await api.delete(`/users/${this.modal_delete_id}`, {
        headers: {
          Authorization: `Bearer ${this.$store.state.auth.token}`
        }
      }).catch(e => {
        this.$toastr.e(e);
      }));

      if (response) {
        this.$refs.table.reload();
        this.$toastr.w('Kader berhasil di hapus.');
      }
    },
  },

  data: () => ({
    modal_delete_id: null,
  }),

  mounted() {
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