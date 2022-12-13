<template>
  <div class="bg-gray-900 flex flex-col justify-center items-center 2xl:h-full">
    <h2 class="text-white font-bold mb-10">Json Store</h2>
    <form class="flex flex-col items-center w-full md:w-4/6 h-5/6" v-on:submit="store">
      <div class="w-5/6 md:w-2/6">
        <label
          for="method"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Choose Method</label
        >
        <select
          id="method"
          v-model="method"
          class="
            bg-gray-50
            border border-gray-300
            text-gray-900 text-sm
            rounded-lg
            focus:ring-blue-500 focus:border-blue-500
            block
            w-full
            p-2.5
            dark:bg-gray-700
            dark:border-gray-600
            dark:placeholder-gray-400
            dark:text-white
            dark:focus:ring-blue-500
            dark:focus:border-blue-500
          "
        >
          <option>GET</option>
          <option>POST</option>
        </select>
      </div>
      <div class="w-5/6">
        <label
          for="token"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Token</label
        >
        <textarea
          type="text"
          v-model="token"
          id="token"
          rows="4"
          class="
            block
            p-2.5
            w-full
            h-full
            text-sm text-gray-900
            bg-gray-50
            rounded-lg
            border border-gray-300
            focus:ring-blue-500 focus:border-blue-500
            dark:bg-gray-700
            dark:border-gray-600
            dark:placeholder-gray-400
            dark:text-white
            dark:focus:ring-blue-500
            dark:focus:border-blue-500
            resize-none
          "
          placeholder="Token here"
        ></textarea>
      </div>
      <div class="mt-10 w-5/6 h-80">
        <label
          for="json"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          >Json</label
        >
        <JsonEditorVue
          class="jse-theme-dark h-5/6"
          v-model="json"
          v-bind="{
            mode: 'text',
            mainMenuBar: false,
          }"
        />
      </div>
      <div class="mb-5">
        <button
          type="submit"
          class="
            mt-5
            bg-blue-700
            hover:bg-blue-900
            text-white
            font-bold
            py-2
            px-4
            border border-blue-700
            rounded
          "
        >
          Store
        </button>
      </div>
    </form>
    <div v-if="response" class="bg-yellow-700 text-white m-5 p-5 rounded">
      {{ response }}
    </div>
  </div>
</template>

<script>
import axios from "axios";
import "vanilla-jsoneditor/themes/jse-theme-dark.css";
import JsonEditorVue from "json-editor-vue";

export default {
  data: () => ({
    csrf: document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute("content"),
    json: {},
    token: "",
    response: "",
    method: "GET",
  }),
  methods: {
    store(e) {
      e.preventDefault();
      const data = {
        json: this.json,
        token: this.token,
      };
      if (this.method == "POST") {
        axios
          .post("/json/store", data, {
            headers: {
              "X-CSRF-TOKEN": this.csrf,
              Authorization: "Bearer " + this.token,
            },
          })
          .then((response) => {
            this.response = response.data;
            return response;
          })
          .catch((error) => {
            this.response = error.response.data.message;
          });
      } else {
        let getParams = new URLSearchParams(data).toString();
        axios
          .get("/json/store?" + getParams, {
            headers: {
              "X-CSRF-TOKEN": this.csrf,
              Authorization: "Bearer " + this.token,
            },
          })
          .then((response) => {
            this.response = response.data;
            return response;
          })
          .catch((error) => {
            this.response = error.response.data.message;
          });
      }
    },
  },
  components: {
    JsonEditorVue,
  },
};
</script>

<style>
</style>