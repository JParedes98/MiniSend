import VueRouter from 'vue-router';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import VueSweetalert2 from 'vue-sweetalert2';

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {
    console.log(e);
}

window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common = {
    "X-Requested-With": "XMLHttpRequest",
    "Authorization": 'Bearer ' + $("meta[name=logged-in-user-api-token]").attr('content')
};
window.Vue = require('vue');

Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VueSweetalert2);

const routes = [
    { path: '/', redirect: '/emails' },

    { path: '/emails', name: 'emails', component: require('./app/pages/Emails.vue').default },
        { path: '/email/create', name: 'emails_create', component: require('./app/pages/Emails/CreateEmail.vue').default },
        { path: '/email/preview/:email_id', name: 'emails_preview', component: require('./app/pages/Emails/FullPageEmailPreview.vue').default },

    { path: '/templates', name: 'templates', component: require('./app/pages/Templates.vue').default },
        { path: '/templates/create', name: 'template_create', component: require('./app/pages/templates/CreateTemplate.vue').default },
        { path: '/templates/update/:template_id', name: 'template_update', component: require('./app/pages/templates/UpdateTemplate.vue').default },

    { path: '/contacts', name: 'contacts', component: require('./app/pages/Contacts.vue').default },

    { path: '/search', name: 'search', component: require('./app/pages/Search.vue').default },
];

const router = new VueRouter({
    routes
})

// PARTIALS
Vue.component('sidebar', require('./app/components/Sidebar.vue').default);
Vue.component('toolbar', require('./app/components/Toolbar.vue').default);

const app = new Vue({
    router
}).$mount('#app')