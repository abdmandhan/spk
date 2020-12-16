<template>
  <v-app>
    <v-navigation-drawer app v-model="drawer">
      <v-list-item class="px-2">
        <v-list-item-avatar>
          <v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
        </v-list-item-avatar>

        <v-list-item-title>
          {{ auth.name }}
          <div>
            {{ auth.role }}
          </div>
        </v-list-item-title>
      </v-list-item>

      <v-divider></v-divider>

      <v-list dense>
        <div v-for="item in items" :key="item.title">
          <v-subheader v-if="item.header">{{ item.header }}</v-subheader>

          <v-list-item link :to="{ name: item.name }" v-else>
            <v-list-item-icon>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-icon>

            <v-list-item-content>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </div>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar color="deep-purple accent-4" dense dark app>
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
      <v-container fluid>
        <router-view></router-view>
      </v-container>
    </v-main>

    <v-footer app> &copy; Abdurrahman Ramadhan 2020 </v-footer>
  </v-app>
</template>

<script>
export default {
  mounted() {
    axios.get(`${this.$baseUrl}/api/app`).then((response) => {
      console.log("RESPONSE", response);
      this.auth.name = response.data.data.auth.name;
      this.auth.role = response.data.data.auth.roles[0].name;
      this.items = response.data.data.menu;
      this.appName = response.data.data.app_name;
    });
  },
  data() {
    return {
      admins: [
        ["Management", "mdi-account-multiple-outline"],
        ["Settings", "mdi-cog-outline"],
      ],
      auth: {
        name: "",
        role: "",
      },
      appName: "",
      drawer: null,
      items: [],
      mini: false,
    };
  },
  methods: {
    logout() {
      axios.post(`${this.$baseUrl}/logout`).then((result) => {
        window.location.href = this.$baseUrl;
      });
    },
  },
};
</script>