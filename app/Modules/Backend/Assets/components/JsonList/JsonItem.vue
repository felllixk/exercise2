<script>
import axios from "axios";
import JsonElement from "./JsonElement.vue";
import "vanilla-jsoneditor/themes/jse-theme-dark.css";
import JsonEditorVue from "json-editor-vue";
export default {
  data() {
    return {
      hover: false,
      showContextMenu: false,
      expanded: false,
      jsonData: this.jsonItem.json,
      firstJsonKey: "JSON",
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },
  methods: {
    save() {
      const data = {
        json: JSON.stringify(this.jsonData),
      };
      axios
        .put("/admin/json/" + this.jsonItem.id, data, {
          headers: {
            "X-CSRF-TOKEN": this.csrf,
          },
        })
        .then((response) => {
          this.response = response.data;
          this.$emit("fetchJson");
          return response;
        })
        .catch((error) => {
          this.response = error.response.data.message;
        });
    },
    mouseOver() {
      this.hover = !this.hover;
    },
    openContextMenu() {
      this.showContextMenu = true;
    },
    closeContextMenu() {
      this.showContextMenu = false;
      this.hover = false;
    },
    expand() {
      this.closeContextMenu();
      this.jsonData = JSON.parse(this.jsonItem.json);
      this.expanded = true;
    },
    collapse() {
      this.openContextMenu();
      this.expanded = false;
    },
    elementInfo(value) {
      return typeof value + " : " + value;
    },
    deleteItem() {
      axios.delete("/admin/json/" + this.jsonItem.id).then(() => {
        this.closeContextMenu();
        this.collapse();
        this.$emit("fetchJson");
      });
    },
  },
  props: {
    jsonItem: Object,
  },
  components: {
    JsonElement,
    JsonEditorVue,
  },
};
</script>

<template>
  <div>
    <div
      class="text-center cursor-pointer hover:bg-gray-600 inline"
      @click="openContextMenu"
      @mouseover="hover = true"
      @mouseleave="hover = false"
    >
      <span class="text-gray-400 select-none">Json</span>
      <span class="ml-2 mr-1" v-if="hover && !showContextMenu">...</span>
    </div>
    <div
      class="block right-5 bg-gray-700"
      v-click-outside="closeContextMenu"
      v-if="showContextMenu"
    >
      <div class="inline-block">
        <button v-if="!expanded" @click="expand" class="hover:bg-slate-400 p-2">
          Expand
        </button>
        <button
          v-if="expanded"
          @click="collapse"
          class="hover:bg-slate-400 p-2"
        >
          Collapse
        </button>
        <button @click="save" class="hover:bg-slate-400 p-2 text-center">
          Save
        </button>
        <button @click="deleteItem" class="hover:bg-slate-400 p-2 text-center">
          Delete
        </button>
      </div>
    </div>
    <ul class="ml-5 mb-2" v-if="expanded">
      <li class="ml-5">
        ID : <span>{{ jsonItem.id }}</span>
        <span class="bg-gray-600 static text-gray-400 text-sm ml-2">{{
          typeof jsonItem.id
        }}</span>
      </li>
      <JsonEditorVue
        class="jse-theme-dark h-5/6"
        v-model="jsonData"
        v-bind="{}"
      ></JsonEditorVue>
    </ul>
  </div>
</template>

<style>
.pos {
  position: revert;
}
</style>