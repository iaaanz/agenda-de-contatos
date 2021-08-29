/* eslint-disable no-unused-vars */
import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faSearch, faEdit, faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import VueMask from 'v-mask'
import App from './App.vue'
import vuetify from './vuetify'

require('./bootstrap');

library.add(faSearch, faEdit, faTrash);
Vue.use(VueMask);
Vue.component('FontAwesomeIcon', FontAwesomeIcon)
Vue.config.productionTip = false

// eslint-disable-next-line no-new
new Vue({
  el: '#app',
  components: { App },
  template: '<App/>',
  vuetify: vuetify
})
