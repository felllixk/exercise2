<template>
  <div class="inline">
    <div
      class="text-center cursor-pointer hover:bg-gray-600 inline"
      @click="openContextMenu"
      @mouseover="hover = true"
      @mouseleave="hover = false"
    >
      <div class="inline">
        <span v-if="!keyEdit">{{ this.keyElement }} : </span>
        <input
          class="text-black"
          type="text"
          v-else
          :value="this.keyElement"
          
          onkeydown="this.style.width = ((this.value.length + 1) * 8) + 'px';"
        />
      </div>
      <span v-if="!expanded" class="text-yellow-500 select-none inline"
        >{{ getElementValue }}
      </span>
    </div>
    <div
      class="inline absolute mt-6 bg-gray-700"
      v-click-outside="closeContextMenu"
      v-if="showContextMenu"
    >
      <button @click="editKeyElement" class="block">Rename Key</button>
      <button v-if="!expanded && expandable" @click="expand" class="block">
        Expand
      </button>
      <button v-if="expanded && expandable" @click="collapse" class="block">
        Collapse
      </button>
      <button @click="deleteItem" class="block">Delete</button>

      <button @click="test">Test</button>
    </div>
    <div v-if="expanded" class="inline" :class="{ 'bg-gray-600': hover }">
      <span class="ml-2">{</span>
      <span class="bg-gray-600 inline static text-gray-400 text-sm ml-2">{{
        getElementType
      }}</span>
      <ul class="ml-2" :class="{ 'bg-gray-600': hover }">
        <li v-for="(value, index) in el" :key="value.id">
          <JsonElement
            v-on:changeKeyElement="eventKeyEdit"
            v-model:element="el[index]"
            :keyElement="index"
          />
        </li>
        <!-- <li v-for="(value, index) in element" :key="index">
          <JsonElement v-model:element="value" />
        </li> -->
      </ul>
      <span>}</span>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      hover: false,
      showContextMenu: false,
      expanded: false,
      keyEdit: false,
    };
  },
  emits: ["update:element", "update:keyElement", "changeKeyElement"],
  props: ["element", "keyElement"],
  computed: {
    kE: {
      get() {
        return this.keyElement;
      },
      set(value) {
        let json = {};
        json[value] = this.element;
        return this.$emit("changeKeyElement", json);
      },
    },
    el: {
      get() {
        return this.element;
      },
      set(value) {
        return this.$emit("update:element", value);
      },
    },
    getElementType() {
      return typeof this.element;
    },
    getElementValue() {
      if (this.expandable) {
        return this.getOpenBracket + "..." + this.getCloseBracket;
      } else {
        return this.element;
      }
    },
    getOpenBracket() {
      if (typeof this.el == "object") {
        return "{";
      } else if (typeof this.el == "array") {
        return "[";
      }
    },
    getCloseBracket() {
      if (typeof this.element == "object") {
        return "}";
      } else if (typeof this.element == "array") {
        return "]";
      }
    },
    expandable() {
      if (typeof this.element == "object" || typeof this.element == "array") {
        return true;
      }
      return false;
    },
  },

  methods: {
    eventKeyEdit(event) {
      this.el = event;
    },
    editKeyElement() {
      this.keyEdit = true;
    },
    expand() {
      if (!this.expandable) {
        return;
      }
      this.closeContextMenu();
      this.expanded = true;
    },
    collapse() {
      this.openContextMenu();
      this.expanded = false;
    },
    openContextMenu() {
      this.showContextMenu = true;
    },
    closeContextMenu() {
      this.showContextMenu = false;
      this.hover = false;
    },
    deleteElement() {},
    test() {
      this.kE = "asa";
    },
  },
  mounted() {
  },
};
</script>