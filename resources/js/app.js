/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from "vue";
import store from '../js/store/store'
const axios = require('axios').default;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import 'vue-toastification/dist/index.css'

import Feed from './components/Feed'
import Tags from './components/Tags'
import TableData from './components/table/TableData'
import EditArticle from './components/table/EditArticle'
import UserTabs from './components/UserTabs'
import TagsArticles from './components/TagsArticles'
import Search from './components/Search'
import ActualArticles from './components/Slider/ActualArticles'
import Subscribe from './components/Form/Subscribe'
import SubscribeList from "./components/SubscribeList"

import Toast from 'vue-toastification'
import moment from 'moment'
import 'moment/min/locales'
import VueAwesomeSwiper from 'vue-awesome-swiper'
import 'swiper/swiper-bundle.css'
import 'swiper/swiper.min.css'

import Vuex from 'vuex'


Vue.use(Vuex)
Vue.use(VueAwesomeSwiper)
Vue.use(Toast, {
    transition: "Vue-Toastification__bounce",
    maxToasts: 20,
    newestOnTop: true
})
moment.locale('ru')

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

let user = document.querySelector("meta[name='user_id']")
if (user) {
    Vue.prototype.$userId = document.querySelector("meta[name='user_id']").getAttribute('content')
}

Vue.config.devtools = true
let token = document.head.querySelector('meta[name="csrf-token"]')
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.getAttribute('content')

const app = new Vue({
    el: '#app',
    components: {
        Feed,
        Tags,
        TableData,
        EditArticle,
        UserTabs,
        TagsArticles,
        Search,
        ActualArticles,
        Subscribe,
        SubscribeList
    },
    store
});
