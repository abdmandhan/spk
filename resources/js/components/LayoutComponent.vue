<template>
  <v-app>
    <v-navigation-drawer app v-model="drawer">
      <v-list-item class="px-2">
        <v-list-item-avatar>
          <v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
        </v-list-item-avatar>

        <v-list-item-title v-if="currentUser">
          {{ currentUser.name }}
        </v-list-item-title>
      </v-list-item>

      <v-divider></v-divider>
      <span class="ml-5">Menu</span>
      <v-list dense>
        <v-list-item
          v-for="item in items"
          :key="item.title"
          link
          :to="{ name: item.name }"
        >
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar color="#ef6431" dense dark app>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

      <v-toolbar-title>{{ appName }}</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-menu left bottom>
        <template v-slot:activator="{ on, attrs }">
          <v-btn icon v-bind="attrs" v-on="on">
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>

        <v-list>
          <v-list-item @click="logout">
            <v-list-item-title>Logout</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>

    <v-main>
      <router-view></router-view>
    </v-main>

    <v-footer app><v-spacer /> &copy; 2020 Laravel Vue </v-footer>
  </v-app>
</template>

<script>
import { mapGetters } from "vuex";
import ApiService from "../services/api.service";
import { LOGOUT } from "./../services/store/auth.module";

export default {
  mounted() {
    if (!this.isAuthenticated) {
      this.$router.push({ name: "login" });
    }
  },
  data() {
    return {
      appName: "Sistem Penunjang Keputusan",
      drawer: null,
      items: [
        {
          name: "dashboard",
          icon: "mdi-chart-bar",
          title: "Dashboard",
        },
        {
          name: "spk",
          icon: "mdi-account-box-outline",
          title: "SPK",
        },
      ],
    };
  },
  methods: {
    logout() {
      this.$store
        .dispatch(LOGOUT, this.user)
        .then(() => this.$router.push({ name: "login" }));
    },
  },
  computed: {
    ...mapGetters(["isAuthenticated", "currentUser"]),
  },
};
</script>

