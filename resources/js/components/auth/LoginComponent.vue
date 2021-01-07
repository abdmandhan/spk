<template>
  <div>
    <v-app>
      <v-main>
        <v-container fill-height="fill-height">
          <v-layout align-center="align-center" justify-center="justify-center">
            <v-flex class="login-form text-xs-center" style="max-width: 500px">
              <div class="display-1 mb-3 text-center">UAS APLIKOM KONVERSI</div>
              <v-card light="light">
                <v-card-text>
                  <!-- <h2>UAS</h2> -->
                  <v-text-field v-model="yard" label="yard" type="number" />
                  <v-text-field v-model="kaki" label="kaki" type="number" />
                  <v-text-field v-model="inch" label="inch" type="number" />
                  {{ calcyard + calckaki + calcinch }}
                  <!-- <v-form>
                    <v-text-field
                      v-model="user.email"
                      light="light"
                      prepend-icon="mdi-email"
                      label="Email"
                      type="email"
                    ></v-text-field>
                    <v-text-field
                      v-model="user.password"
                      light="light"
                      prepend-icon="mdi-lock"
                      label="Password"
                      type="password"
                    ></v-text-field>
                    <v-btn
                      @click.prevent="postLogin()"
                      color="primary"
                      block="block"
                      type="submit"
                      :loading="loading"
                      >Sign in</v-btn
                    >
                  </v-form> -->
                </v-card-text>
              </v-card>
            </v-flex>
          </v-layout>
        </v-container>
      </v-main>
      <v-footer app="app">
        <v-flex class="text-xs-center">© 2020. Laravel Vue</v-flex>
      </v-footer>
    </v-app>
  </div>
</template>
<script>
import { mapState, mapGetters } from "vuex";
import { LOGIN } from "./../../services/store/auth.module";

export default {
  mounted() {
    if (this.isAuthenticated) {
      this.$router.push({ name: "dashboard" });
    }
  },
  data() {
    return {
      user: {
        email: "abdmandhan@gmail.com",
        password: "12341234",
      },
      loading: false,
      yard: 0,
      kaki: 0,
      inch: 0,
    };
  },
  methods: {
    postLogin() {
      this.loading = true;

      setTimeout(() => {
        this.$store
          .dispatch(LOGIN, this.user)
          .then(() => this.$router.push({ name: "dashboard" }));

        this.loading = false;
      }, 1000);
    },
  },
  computed: {
    ...mapGetters(["isAuthenticated"]),
    calcyard() {
      return this.yard * 0.9144;
    },
    calckaki() {
      return this.kaki * 0.3048;
    },
    calcinch() {
      return this.inch * 0.0254;
    },
  },
};
</script>