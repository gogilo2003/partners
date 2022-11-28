require('./bootstrap.js')

import { createApp } from 'vue'

const app = createApp()

app.component('Partners', require('./components/Partners.vue').default)

app.mount('#partners_app')