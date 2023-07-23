import './bootstrap';

import {createApp} from 'vue'
import router from './routes'

import App from '../views/App.vue'
createApp(App).use(router).mount("#app")

