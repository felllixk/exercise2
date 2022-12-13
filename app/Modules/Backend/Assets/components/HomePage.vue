<template>
  <div
    class="
      bg-gray-900
      flex flex-col
      justify-center
      items-center
      2xl:h-full
      text-white
    "
  >
    <div class="w-3/6 h-5/6">
      <JsonList :jsonArray="jsonData" v-on:fetchJson="getJsonData" />
    </div>
  </div>
</template>

<script>
import axios from "axios";
import JsonList from "./JsonList/JsonList.vue";

export default {
  data() {
    return {
      jsonData: [],
      vab: "alo",
    };
  },
  async mounted() {
    this.getJsonData();
  },
  methods: {
    getJsonData() {
      this.fetchJsonArray();
    },
    async fetchJsonArray() {
      this.jsonData = await axios
        .get("/admin/json/")
        .then((response) => response.data);
    },
  },
  components: {
    JsonList,
  },
};
</script>
