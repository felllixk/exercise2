import { createApp } from "vue";
import HomePage from "./components/HomePage.vue"
import createDirectives from './directives';

const app = createApp(HomePage)
createDirectives(app)
app.mount('#backend')