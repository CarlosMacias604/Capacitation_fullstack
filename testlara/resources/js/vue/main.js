import { createApp } from "vue";
import App from "./App.vue";

//tailwind
import '../../css/vue.css'

//Oruga
import Oruga from '@oruga-ui/oruga-next';
import '@oruga-ui/theme-oruga/dist/oruga.css'

//material design
import '@material-design-icons/font';

//axios and router
import axios from "axios";
import router from "./router.js";

const app = createApp(App).use(Oruga).use(router);

app.config.globalProperties.$axios = axios;
window.axios = axios;

app.mount("#app");