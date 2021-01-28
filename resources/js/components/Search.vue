<template>
    <div class="">
        <div class="search__row">
            <input type="text" value="" placeholder="Введите ваш запрос" class="search__input" v-model='query'>
            <button class="btn search__btn">
                <svg width="27" height="27" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.375 21.375a9 9 0 100-18 9 9 0 000 18zM23.625 23.625l-4.894-4.894" stroke="#242629" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        </div>
        <p class="search__text">Найдено по вашему запросу {{ SEARCH_RESULT.length }}</p>
<!--        {{ SEARCH_RESULT }}-->
        <div class="loader" v-if="loader">
            <img src="https://homagents.com/static/gif/55484.gif" alt="">
        </div>
        <div class="search__list" v-if="result">
            <div class="search__item" v-for="(article, index) in SEARCH_RESULT" :key="index">
                <div class="search__image" v-bind:style="{ 'background-image' : 'url('+ host + '/storage/' + article.media_id + '/' + article.file_name +')'}">
<!--                    <img v-bind:src=`host + '/storage/' + article.media_id + '/' + article.file_name" alt="" class="" width="100%">-->
                </div>
                <div class="search__info">
                    <a :href="'article/' + article.slug" class="search__title">{{ article.title }}</a>
                    <div class="search__about">
                        <a href="" class="search__text outer small">{{ article.name }}</a>
                        <p class="search__text outer small">{{ moment(article.created_at).format('ll')}}</p>
                        <p class="search__icon">
                            <svg width="13" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 6.194a5.122 5.122 0 01-.55 2.323 5.194 5.194 0 01-6.967 2.322L1 12l1.161-3.483a5.121 5.121 0 01-.55-2.323A5.194 5.194 0 014.483 1.55 5.121 5.121 0 016.806 1h.305A5.182 5.182 0 0112 5.889v.305z" stroke="#B8B7B7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span class="">{{ article.comments.length }}</span>
                        </p>
                        <p class="search__icon">
                            <svg width="13" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.794 12H2.118c-.297 0-.581-.116-.79-.322A1.09 1.09 0 011 10.9V7.05c0-.292.118-.572.327-.778.21-.206.494-.322.79-.322h1.677m3.912-1.1v-2.2c0-.438-.176-.857-.49-1.167A1.69 1.69 0 006.03 1L3.794 5.95V12h6.304c.27.003.531-.09.737-.262.205-.172.34-.41.381-.673l.771-4.95a1.081 1.081 0 00-.261-.887 1.116 1.116 0 00-.856-.378H7.706z" stroke="#B8B7B7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span class="">{{ article.likes.length }}</span>
                        </p>
                    </div>
<!--                    <p class="search__desc">{{ article.article_text }}</p>-->
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex'
import moment from 'moment'
export default {
    data() {
        return {
            moment: moment,
            query: null,
            loader: false,
            result: false,
            host: window.location.origin
        }
    },
    watch: {
        query() {
            this.searchProducts()
            // console.log(this.query)
        }
    },
    methods: {
        searchProducts() {
            this.loader = true
            this.result = false
            this.$store.dispatch('GET_SEARCH_RESULT', this.query).then(() => {
                this.loader = false
                this.result = true
            })
            .catch((err) => {
                this.loader = true
                this.result = false
            })

        }
    },
    computed: {
        ...mapGetters([
            'SEARCH_RESULT'
        ])
    }
}
</script>

