<template>
  <div class="flex flex-col">
    <div class="overflow-x-auto">
      <div class="align-middle inline-block min-w-full">
        <div
          class="shadow-lg overflow-hidden border-b border-gray-700 rounded-lg relative"
        >
          <table
            class="min-w-full divide-y divide-gray-700 relative"
            ref="table"
          >
            <thead class="bg-dark-gray">
              <tr v-for="(header, i) in headers" :key="i">
                <th
                  class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-bold text-gray-200 uppercase tracking-wider"
                  v-for="(value, i) in header"
                  :key="i"
                  v-text="value"
                ></th>
              </tr>
            </thead>
            <tbody
              class="divide-y divide-gray-700"
              v-if="data && data.data.length"
            >
              <tr :key="i" v-for="(dt, i) in data.data">
                <td
                  v-for="(column, col) in columns"
                  :key="col"
                  class="px-8 py-4 whitespace-no-wrap text-xs font-semibold text-gray-200"
                  v-html="
                    column.name === '__index__'
                      ? i + 1
                      : render(dt, column, i, col)
                  "
                ></td>
              </tr>

              <!-- More rows... -->
            </tbody>
            <tbody class="divide-y divide-gray-700" v-else>
              <tr class="hidden">
                <td
                  v-for="(value, i) in headers[0]"
                  :key="i"
                  class="px-6 py-4 whitespace-no-wrap text-center"
                >
                  <span
                    class="px-2 inline-flex text-xs leading-5 font-semibold text-gray-200"
                    v-text="''"
                  >
                  </span>
                </td>
              </tr>
            </tbody>
            <tfoot class="bg-semi-dark" v-if="!data || !data.data.length">
              <tr>
                <td
                  class="px-6 py-4 whitespace-no-wrap text-center"
                  :colspan="headers[0].length"
                >
                  <span
                    class="px-2 inline-flex text-center text-xs leading-5 font-semibold text-gray-200"
                    v-text="'Tidak Ada Data'"
                  >
                  </span>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <div
      class="mt-3 float-right ml-auto"
      v-if="
        (typeof pagination === 'undefined' || pagination) &&
        data &&
        data.data.length
      "
    >
      <div class="py-2">
        <nav class="block">
          <ul class="flex pl-0 rounded list-none flex-wrap">
            <li v-for="(page, i) in data.last_page" :key="i">
              <span
                v-if="page === data.current_page"
                v-text="page"
                class="first:ml-0 text-xs font-semibold flex w-8 h-8 mx-1 p-0 rounded-full items-center justify-center leading-tight relative border border-solid border-primary text-dark bg-primary"
              >
              </span>
              <span
                v-else
                @click.prevent="draw(data.links[page].url)"
                class="first:ml-0 text-xs font-semibold flex w-8 h-8 mx-1 p-0 rounded-full items-center justify-center leading-tight relative border border-solid border-semi-dark bg-dark-gray text-gray-200 cursor-pointer"
                v-text="page"
              >
              </span>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</template>
<script>
import api from "../../../api";

export default {
  props: ["headers", "source", "handlers", "pagination", "events"],

  methods: {
    reload() {
      this.draw(this.data.links[this.data.current_page].url);
    },

    getHandler(name) {
      if (
        this.handlers &&
        typeof this.handlers === "object" &&
        name in this.handlers
      ) {
        return this.handlers[name];
      }

      return this.defaultHandlerMethods[name];
    },

    async draw(source) {
      this.data = null;

      if (!source) {
        return;
      }

      const response = await api.get(source).catch((e) => console.error(e));

      if (response) {
        this.data = this.getHandler("handleResponseData")(response.data);
      }

      this.columns = this.getHandler("columns")();

      this.resizeTableCells();
      window.addEventListener("resize", (e) => {
        this.resizeTableCells();
        if (this.$refs.table) {
          this.$refs.table.tHead.style.width =
            this.$refs.table.offsetWidth + "px";
          if (window.innerWidth < 1024) {
            this.$refs.table.tHead.classList.remove("fixed");
            this.$refs.table.tHead.classList.remove("z-50");
            this.$refs.table.tHead.classList.remove("shadow-lg");
          }
        }
      });
      document
        .querySelector("#--dashboard-route")
        .addEventListener("resize", (e) => {
          this.resizeTableCells();

          if (this.$refs.table) {
            this.$refs.table.tHead.style.width =
              this.$refs.table.offsetWidth + "px";
            if (window.innerWidth < 1024) {
              this.$refs.table.tHead.classList.remove("fixed");
              this.$refs.table.tHead.classList.remove("z-50");
              this.$refs.table.tHead.classList.remove("shadow-lg");
            }
          }
        });
      window.addEventListener("scroll", (e) => {
        this.resizeTableCells();
        if (this.$refs.table && window.innerWidth >= 1024) {
          if (
            this.$parent.$parent.$refs.navbar.$el.offsetHeight >=
              this.$refs.table.getBoundingClientRect().y &&
            Math.abs(
              this.$refs.table.getBoundingClientRect().y +
                -this.$parent.$parent.$refs.navbar.$el.getBoundingClientRect()
                  .height +
                -this.$refs.table.tHead.getBoundingClientRect().height +
                Math.floor(
                  -this.$refs.table
                    .querySelector("tbody")
                    .rows[
                      this.$refs.table.querySelector("tbody").rows.length - 1
                    ].getBoundingClientRect().height / 2
                )
            ) < this.$refs.table.getBoundingClientRect().height
          ) {
            this.$refs.table.tHead.classList.add("fixed");
            this.$refs.table.tHead.classList.add("z-50");
            this.$refs.table.tHead.classList.add("shadow-lg");
            this.$refs.table.tHead.style.top =
              this.$parent.$parent.$refs.navbar.$el.offsetHeight + "px";
            this.$refs.table.tHead.style.width =
              this.$refs.table.offsetWidth + "px";
          } else {
            this.$refs.table.tHead.classList.remove("fixed");
            this.$refs.table.tHead.classList.remove("z-50");
            this.$refs.table.tHead.classList.remove("shadow-lg");
          }
        }
      });

      if (this.events && typeof this.events === "object") {
        const { render } = this.events;

        if (render) {
          setTimeout(() => {
            render(this.$refs.table);
          });
        }
      }
    },

    resizeTableCells() {
      if (this.$refs.table) {
        Array.prototype.slice
          .call(this.$refs.table.tHead.children)
          .forEach((el, x) => {
            const rowsLen = [];
            Array.prototype.slice.call(el.cells).forEach((el, y) => {
              rowsLen[y] = [];
              Array.prototype.slice
                .call(this.$refs.table.querySelector("tbody").rows)
                .forEach((el, z) => {
                  if (el.cells[y]) {
                    rowsLen[y].push(el.cells[y].clientWidth);
                  }
                });

              el.style.height = el.getBoundingClientRect().height + "px";
              el.style.width = Math.max(...rowsLen[y]) + "px";
            });
          });
      }
    },

    render(data, column, row, col) {
      const { events } = column;
      if (events) {
        const { render } = events;
        if (render) {
          Array.prototype.slice
            .call(this.$refs.table.querySelector("tbody").rows)
            .forEach(async (el) => {
              const cells = await el.cells;
              render(cells[col], data, row, col);
            });
        }
      }
      if (column.render) {
        return column.render(data[column.name] || null, data, row, col);
      }
      return data[column.name] || "";
    },
  },

  data: () => ({
    data: null,
    columns: [],
    defaultHandlerMethods: {
      columns: () => {
        return {};
      },
    },
  }),

  created() {
    this.draw(this.source);
  },
};
</script>
<style lang="scss" scoped>
table {
  tbody {
    tr {
      @apply bg-semi-dark;
      td {
        @apply text-gray-200;
      }
    }
  }
}
</style>