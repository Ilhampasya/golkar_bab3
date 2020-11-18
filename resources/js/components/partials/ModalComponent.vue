<template>
  <div class="fixed z-50 inset-0 overflow-y-auto" v-if="showModal">
    <div
      class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
    >
      <div class="fixed inset-0 transition-opacity" @click="hide">
        <div class="absolute inset-0 bg-black opacity-75 filter-blur-3"></div>
      </div>
      <span
        class="hidden sm:inline-block sm:align-middle sm:h-screen"
        v-if="center"
      ></span
      >&#8203;
      <div
        class="inline-block align-bottom bg-semi-dark rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-headline"
      >
        <div class="bg-semi-dark px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div
              class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10 bg-dark-gray"
            >
              <!-- Heroicon name: exclamation -->
              <slot name="modal-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info h-6 w-6 text-blue-500"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
              </slot>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3 class="text-lg leading-6 font-semibold text-gray-200">
                <slot name="modal-title" />
              </h3>
              <div class="mt-2 text-sm leading-5 text-gray-100">
                <slot name="modal-contents">

                </slot>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <slot name="modal-footer" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["center"],
  data() {
    return {
      showModal: false,
    };
  },
  methods: {
    show() {
      this.showModal = true;
    },
    hide() {
      this.showModal = false;
    },
  },
};
</script>