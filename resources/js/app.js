/* eslint-disable no-unused-vars */
import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faSearch, faEdit, faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import VueMask from 'v-mask'
import axios from 'axios';
import VueAxios from 'vue-axios'
import Notification from 'vue-notification';
import App from './App.vue'
import vuetify from './vuetify'

require('./bootstrap');

library.add(faSearch, faEdit, faTrash);
Vue.use(VueMask);
Vue.use(VueAxios, axios);
Vue.use(Notification);
Vue.component('FontAwesomeIcon', FontAwesomeIcon);
Vue.config.productionTip = false;

// eslint-disable-next-line no-new
new Vue({
  el: '#app',
  components: { App },
  template: '<App/>',
  vuetify: vuetify
})
