import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        articles: [],
        user: {},
        users_articles: [],
        top_articles: [],
        user_front_articles: [],
        tags: [],
        tags_articles: [],
        loading: false,
        result_search: [],
        subscribe_tags: []
    },
    mutations: {
        SET_ARTICLES_FROM_FILTER(state, payload) {
            if(payload.query.changed === true) {
                state.articles = payload.data
            } else {
                state.articles = state.articles.concat(payload.data)
            }
        },
        SET_USERS_ARTICLES_TO_VUEX: (state, users_art) => {
            state.users_articles = users_art
        },
        SET_TAGS: (state, tags) => {
            state.tags = tags
        },
        SET_USERS_FRONT_ARTICLES_TO_VUEX: (state, articles) => {
            state.user_front_articles = articles
        },
        SET_CURRENT_USER: (state, payload) => {
            state.user = payload
        },
        SET_TAG_ARTICLES: (state, payload) => {
            state.tags_articles = payload
        },
        SET_SEARCH_RESULT(state, payload) {
            state.result_search = payload
        },
        SET_TOP_ARTICLES(state, payload) {
            state.top_articles = payload
        },
        SET_USER_SUBSCRIBE_TAG(state, payload) {
            state.subscribe_tags = payload
        }
    },
    actions: {
        GET_ARTICLES_FROM_FILTER({commit}, query) {
            // console.log(query)
            return axios(`http://127.0.0.1:8000/api/filter`, {
                method: 'post',
                data: {
                    ...query
                }
            })
                .then(response => {
                    commit('SET_ARTICLES_FROM_FILTER', {'data': response.data, 'query': query})
                    console.log(response.data)
                })
                .catch(err => 'Ошибка получение постов')
        },
        GET_USER_ARTICLES({commit}, id) {
            return axios(`http://127.0.0.1:8000/api/articles/user/${id}`, {
                method: 'GET'
            })
            .then(response => {
                commit('SET_USERS_ARTICLES_TO_VUEX', response.data)
            })
            .catch(err => 'Ошибка получение постов')
        },
        GET_TAGS({commit}) {
            return axios('http://127.0.0.1:8000/api/tags', {
                method: 'GET'
            })
            .then(response => {
                commit('SET_TAGS', response.data)
                return response.data
            })
            .catch(error => {
                console.log(error)
                return error
            })
        },
        GET_USER_FRONT_ARTICLE({commit}, id) {
            return axios(`http://127.0.0.1:8000/api/articles/user/${id}`, {
                method: 'GET'
            })
            .then(response => {
                    commit('SET_USERS_ARTICLES_TO_VUEX', response.data)
            })
            .catch(err => 'Ошибка получение постов')
        },
        GET_CURRENT_USER({commit}) {
            return axios(`http://127.0.0.1:8000/api/user/${id}`, {
                method: 'GET'
            })
            .then(response => {
                commit('SET_USERS_ARTICLES_TO_VUEX', response.data)
            })
            .catch(err => 'Пользователь не найден')
        },
        GET_TAG_ARTICLES({commit}, tag_id) {
            return axios(`http://127.0.0.1:8000/api/tags/${tag_id}`, {
                method: 'GET'
            })
            .then(response => {
                commit('SET_TAG_ARTICLES', response.data)
            })
            .catch(err => 'Статьи у тега отсутствуют или их не удалось получить.')
        },
        GET_SEARCH_RESULT({commit}, query) {
            return axios.post(`http://127.0.0.1:8000/api/search`, {query})
            .then(response => {
                commit('SET_SEARCH_RESULT', response.data)
                console.log(response.data)
            })
            .catch(err => 'Статьи у тега отсутствуют или их не удалось получить.')
        },
        GET_TOP_ARTICLES({commit}) {
            return axios.get(`http://127.0.0.1:8000/api/top-articles`)
                .then(response => {
                    commit('SET_TOP_ARTICLES', response.data)
                })
                .catch(err => 'Статьи у тега отсутствуют или их не удалось получить.')
        },
        GET_SUBSCRIBE_USER_TAGS({commit}) {
            return axios.get(`http://127.0.0.1:8000/api/subscribe-tags/${Vue.prototype.$userId}`)
                .then(response => {
                    commit('SET_USER_SUBSCRIBE_TAG', response.data)
                })
        }
    },
    getters: {
        ARTICLES_FILTER(state) {
            return state.articles
        },
        USERS_ARTICLES(state) {
            return state.users_articles
        },
        TAGS(state) {
            return state.tags
        },
        USER_FRON_ARTICLES(state) {
            return state.user_front_articles
        },
        CURRENT_USER(state) {
            return state.user
        },
        TAG_ARTICLES(state) {
            return state.tags_articles
        },
        SEARCH_RESULT(state) {
            return state.result_search
        },
        TOP_ARTICLES(state) {
            return state.top_articles
        },
        SUBSCRIBE_USER_TAG(state) {
            return state.subscribe_tags
        }
    }
})

export default store
