<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-toolbar>
          <v-toolbar-title>Perhitungan SPK</v-toolbar-title>
        </v-toolbar>
      </v-col>
      <v-col cols="4" v-for="(candidate, k) in candidates" :key="k">
        <v-card>
          <v-img
            src="https://cdn.pixabay.com/photo/2015/03/04/22/35/head-659652_1280.png"
          />
          <v-card-title>{{ candidate.name }}</v-card-title>
          <v-card-text v-if="candidate.point">
            Point Total Candidate:
            <span style="font-size: 24px">{{ candidate.point }}</span>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import ApiService from "../services/api.service";
export default {
  data() {
    return {
      candidates: [],
    };
  },
  mounted() {
    ApiService.get("api/spk")
      .then((result) => {
        this.candidates = result.data.data.candidates;
      })
      .catch((err) => {});
  },
};
</script>