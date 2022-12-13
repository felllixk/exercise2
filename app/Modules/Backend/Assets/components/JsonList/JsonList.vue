<template>
  <div
    class="bg-zinc-800 h-full w-full flex flex-col justify-center items-center"
  >
    <span>Json Editor</span>
    <div class="bg-zinc-900 w-5/6 h-5/6 overflow-auto">
      <ul class="relative">
        <li>
          <JsonItem
            v-for="(json, index) in jsonArray"
            :jsonItem="json"
            :key="index"
            v-on:fetchJson="$emit('fetchJson')"
          />
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import JsonItem from "./JsonItem.vue";
export default {
  data() {
    return {};
  },
  components: {
    JsonItem,
  },
  props: {
    jsonArray: Array,
  },
};
</script>