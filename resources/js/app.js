import Vue from 'vue';
import VueRouter from 'vue-router';
import { MdButton, MdContent, MdTabs, MdApp, MdToolbar, MdCard, MdDialog, MdField, MdIcon } from 'vue-material/dist/components'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'

Vue.use(VueRouter);

// Material Components
Vue.use(MdApp);
Vue.use(MdToolbar);
Vue.use(MdButton);
Vue.use(MdCard);
Vue.use(MdDialog);
Vue.use(MdField);
Vue.use(MdIcon);

import App from './views/app.vue';
import Library from './views/Library';
import Genre from './views/Genre';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'library',
            component: Library
        },
        {
            path: '/genre/:genre_id/:genre_name',
            name: 'genre',
            component: Genre
        }
    ]
});

const app = new Vue({
    el: '#app',
    components: { App },
    router
});