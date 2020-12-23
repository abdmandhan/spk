<template>
  <v-container>
    <v-row>
      <v-col>
        <v-card>
          <v-card-title class="text-center">
            <v-spacer></v-spacer>
            Candidate: {{ candidate.name }}
            <v-spacer></v-spacer>
          </v-card-title>

          <v-card-text>
            <span v-for="(question, k) in questions" :key="k">
              <span style="font-size: 24px">
                {{ k + 1 }}. {{ question.question }}
              </span>
              <v-container fluid>
                <v-radio-group v-model="answers[question.id]" row>
                  <v-radio
                    :value="weight.value"
                    v-for="(weight, b) in weights"
                    :key="b"
                  >
                    <template v-slot:label>
                      <div class="mt-2">
                        {{ weight.desc }}
                      </div>
                    </template>
                  </v-radio>
                </v-radio-group>
              </v-container>
            </span>
          </v-card-text>
          <v-card-actions>
            <v-btn color="green" block @click="save()">
              <span class="text-white">Simpan</span>
            </v-btn>
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
      candidate: {},
      questions: [],
      weights: [],
      answers: {},
    };
  },
  mounted() {
    ApiService.get(`api/spk/${this.$route.params.id}`)
      .then((result) => {
        this.candidate = result.data.data.candidate;
        this.questions = result.data.data.questions;
        this.weights = result.data.data.weights;
        console.log("result", result);
      })
      .catch((err) => {});
  },
  methods: {
    save() {
      ApiService.post(`api/spk`, {
        candidate: this.candidate,
        answers: this.answers,
      })
        .then((result) => {
          if (result.data.status) {
            this.$router.push({ name: "spk" });
          }
        })
        .catch((err) => {});
    },
  },
};
</script>