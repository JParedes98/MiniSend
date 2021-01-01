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
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.Vue = require('vue');

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VueSweetalert2);

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const website = new Vue({
    el: '#website',
});




//--------------------------------------------------- SCRIPTS ---------------------------------------------------
var prevScrollpos = window.pageYOffset;

window.onscroll = function () {

    var currentScrollPos = window.pageYOffset;

    if (prevScrollpos > currentScrollPos) {
        document.getElementById("navbar").style.top = "0";
        document.getElementById("navbar").classList.add("navbar-scrolled");
    } else {
        document.getElementById("navbar").style.top = "-75px";
        document.getElementById("navbar").classList.add("navbar-scrolled");
    }

    prevScrollpos = currentScrollPos;
}