<template>
  <v-app>
    <snackbar-component />
    <router-view></router-view>
  </v-app>
</template>

<script>
export default {
  name: "CRM",
  data() {
    return {};
  },
  methods: {
    showSnackbar() {
      this.$snackbar.showMessage({ content: "Hello, snackbar", color: "red" });
    },
  },
};
</script>
