<template>
  <v-container>
    <v-row>
      <v-col cols="4" v-for="(candidate, k) in candidates" :key="k">
        <v-card>
          <v-img
            src="https://cdn.pixabay.com/photo/2015/03/04/22/35/head-659652_1280.png"
          />
          <v-card-title>{{ candidate.name }}</v-card-title>
          <v-card-text style="font-size: 18px" v-if="candidate.weight">
            Hasil SPK Anda: {{ candidate.weight }}
          </v-card-text>
          <v-card-actions>
            <v-btn color="primary" @click="startQuestion(candidate)"
              >Start Survey</v-btn
            >
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import ApiService from "../../services/api.service";
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
  methods: {
    startQuestion(candidate) {
      this.$router.push({ name: "spk.show", params: { id: candidate.id } });
    },
  },
};
</script>