<template>
  <v-card>
    <v-card-title>APLIKOM YARD KAKI INCH</v-card-title>
    <v-card-text>
      <h2>UAS</h2>
      <v-text-field v-model="yard" label="yard" type="number" />
      <v-text-field v-model="kaki" label="kaki" type="number" />
      <v-text-field v-model="inch" label="inch" type="number" />
      {{ calcyard + calckaki + calcinch }}
    </v-card-text>
  </v-card>
</template>
<script>
export default {
  data() {
    return {
      yard: 0,
      kaki: 0,
      inch: 0,
    };
  },
  computed: {
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
