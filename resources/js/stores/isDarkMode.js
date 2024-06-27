import { defineStore } from "pinia";
import { ref } from "vue";

export const useDarkModeStore = defineStore('isDarkMode', {
  state: () => ({
    isDarkMode: ref(false),
  }),
})