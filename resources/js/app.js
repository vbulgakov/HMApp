import {createApp} from 'vue';

require('./bootstrap');

import App from './App.vue'
import axios from 'axios'
import router from './router'
import LanguageRadio from "./components/LanguageRadio";
import InterestsCheckbox from "./components/InterestsCheckbox";
import AddLanguage from "./components/AddLanguage";

const app = createApp(App)
app.config.globalProperties.$axios = axios
app.use(router)
app.component('LanguageRadio')
app.component('InterestsCheckbox')
app.component('AddLanguage')
app.mount('#app')
