require('./bootstrap');
import {createApp} from 'vue';
import router from '@/js/routes.js';
import App from '@/js/views/App';
const app = createApp(App);

app.use(router);
app.mount('#app');