<template>
    <div class="">

        <div class="feed__row">
            <div class="feed-select">
                <div class="feed-select__toggle" @click="toggleTags" :class="{ 'active': show_tags }">
                    <div class="feed-select__count" v-if="tag.length != 0">{{ tag.length }}</div>
                    <div class="feed-select__group">
                        <span>Категории</span>
                        <svg width="14" height="14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.5 5.25L7 8.75l3.5-3.5" stroke="#000" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                </div>
                <div class="feed-select__boxes">
                    <div class="feed-select__box">
                        <div class="feed-select__item">
                            <input type="radio" name="radio" @click='this.sortByName' id="byname" class="article-edit-tag__input">
                            <label for="byname" class="article-edit-tag__label icon icon--gray">
                                <svg width="17" height="12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.65 11l1.025-2.884H6.79L7.815 11h1.293L5.369.818H4.097L.358 11h1.293zm1.413-3.977l1.63-4.594h.08l1.63 4.594h-3.34zm9.439 4.156c1.332 0 2.028-.716 2.267-1.213h.06V11h1.173V5.969c0-2.426-1.85-2.705-2.824-2.705-1.153 0-2.466.398-3.062 1.79l1.113.398c.259-.557.87-1.154 1.989-1.154 1.079 0 1.61.572 1.61 1.551v.04c0 .567-.576.517-1.968.696-1.417.184-2.963.497-2.963 2.247 0 1.492 1.153 2.347 2.605 2.347zm.179-1.054c-.935 0-1.61-.418-1.61-1.233 0-.895.815-1.173 1.73-1.293.496-.06 1.829-.198 2.028-.437v1.074c0 .954-.756 1.889-2.148 1.889z" fill="#2D303A"/></svg>
                            </label>
                        </div>
                        <div class="feed-select__item">
                            <input type="radio" name="radio" @click='this.sortByComments' id="bycomment" class="article-edit-tag__input">
                            <label for="bycomment" class="article-edit-tag__label icon icon--gray">
                                <svg width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 7.139a6.052 6.052 0 01-.65 2.744 6.14 6.14 0 01-5.489 3.395 6.052 6.052 0 01-2.744-.65L1 14l1.372-4.117a6.052 6.052 0 01-.65-2.744A6.139 6.139 0 015.117 1.65 6.052 6.052 0 017.86 1h.361A6.125 6.125 0 0114 6.778v.36z" stroke="#2D303A" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </label>
                        </div>
                        <div class="feed-select__item">
                            <input type="radio" name="radio" @click='this.sortByLikes' id="bylike" class="article-edit-tag__input">
                            <label for="bylike" class="article-edit-tag__label icon icon--gray">
                                <svg width="17" height="17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.364 14.875H3.42c-.344 0-.674-.134-.917-.373a1.265 1.265 0 01-.379-.902V9.137c0-.338.136-.662.38-.901.242-.24.572-.374.916-.374h1.943m4.534-1.275v-2.55c0-.507-.204-.993-.569-1.352a1.96 1.96 0 00-1.374-.56L5.364 7.862v7.013h7.307c.312.003.616-.104.854-.303.238-.2.394-.477.441-.78l.894-5.738a1.255 1.255 0 00-.303-1.028 1.295 1.295 0 00-.992-.439H9.898z" stroke="#2D303A" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </label>
                        </div>
                        <div class="feed-select__item">
                            <input type="radio" name="radio" @click='this.sortByView' id="byview" class="article-edit-tag__input">
                            <label for="byview" class="article-edit-tag__label icon icon--gray">
                                <svg width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M.75 9s3-6 8.25-6 8.25 6 8.25 6-3 6-8.25 6S.75 9 .75 9z" stroke="#2D303A" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 11.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z" stroke="#2D303A" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </label>
                        </div>
                        <div class="feed-select__item">
                            <input type="radio" name="radio" @click='this.sortByDate' id="bydate" class="article-edit-tag__input">
                            <label for="bydate" class="article-edit-tag__label icon icon--gray">
                                <svg width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.667 2.667H3.333C2.597 2.667 2 3.263 2 4v9.333c0 .737.597 1.333 1.333 1.333h9.334c.736 0 1.333-.596 1.333-1.333V4c0-.737-.597-1.333-1.333-1.333zM10.667 1.333V4M5.333 1.333V4M2 6.667h12" stroke="#2D303A" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </label>
                        </div>
                    </div>
                    <div class="feed-select__box">
                        <div class="feed-select__item">
                            <input type="radio" name="view" @click='this.toggleMultiplyCard' id="one" class="article-edit-tag__input" :checked="view_card_multiply">
                            <label for="one" class="article-edit-tag__label icon icon--gray">
                                <svg width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.875 1.25h-8.75c-.69 0-1.25.56-1.25 1.25v8.75c0 .69.56 1.25 1.25 1.25h8.75c.69 0 1.25-.56 1.25-1.25V2.5c0-.69-.56-1.25-1.25-1.25z" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </label>
                        </div>

                        <div class="feed-select__item">
                            <input type="radio" name="view" @click='this.toggleMultiplyCard' id="multi" class="article-edit-tag__input" :checked="!view_card_multiply">
                            <label for="multi" class="article-edit-tag__label icon icon--gray">
                                <svg width="15" height="17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.065 1.097H4.388c-.606 0-1.097.49-1.097 1.096v7.678c0 .606.491 1.097 1.097 1.097h7.677c.606 0 1.097-.491 1.097-1.097V2.193c0-.605-.491-1.096-1.097-1.096z" stroke="#242629" stroke-linecap="round" stroke-linejoin="round"/><g clip-path="url(#clip0)" stroke="#F8FAFC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.42 3.936H2.742A2.097 2.097 0 00.646 6.032v7.678c0 1.158.938 2.096 2.096 2.096h7.678a2.097 2.097 0 002.097-2.096V6.032a2.097 2.097 0 00-2.097-2.096zM4.936 4.936v9.87"/></g><path d="M10.42 4.936H2.742c-.605 0-1.096.49-1.096 1.096v7.678c0 .605.49 1.096 1.096 1.096h7.678c.605 0 1.097-.49 1.097-1.096V6.032c0-.605-.492-1.096-1.097-1.096z" stroke="#242629" stroke-linecap="round" stroke-linejoin="round"/><defs><clipPath id="clip0"><path fill="#fff" transform="translate(0 3.839)" d="M0 0h13.161v13.161H0z"/></clipPath></defs></svg>
                            </label>
                        </div>
                    </div>
                </div>



            </div>
            <transition name="fade" mode="out-in">
                <div class="feed-select__list" v-if="show_tags">
                    <div class="feed-select__item" v-for="(tag, index) in tags" :key="index">
                        <input type="checkbox" :value='tag.name' name="checkbox" :id='tag.id' class="article-edit-tag__input">
                        <label :for="tag.id" class="article-edit-tag__label" @click='checkedTag(tag.id)'>{{ tag.name }}
                            <span class="feed-select__count">{{ tag.articles_count}}</span>
                        </label>
                    </div>
                </div>
            </transition>
        </div>
<!--        {{articles}}-->
<!--        {{articles}}-->
        <div class="feed__articles" :class="{ 'hide': loader, 'feed__articles--single': view_card_multiply }">
            <div class="feed-card" v-for="(article, index) in articles" :key="index">
                <div class="feed-card__row feed-card__row--mb">
                    <a :href="'tag/' + article.tag" class="feed-card__tag" v-if="article.tag">
                        {{ article.tag_name }}
                    </a>
                    <small class="feed-card__delimiter">|</small>
                    <a :href="'users/' + article.user_id" class="feed-card__author">{{ article.name }} {{ article.surname }}</a>
                </div>
                <a :href="'article/' + article.slug" class="feed-card__link" :title='article.title'> {{ article.title }}</a>
                <div class="feed-card__row">
                    <div class="feed-card__content">
                        <svg width="14" height="14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.702 6.475c.002.865-.2 1.718-.59 2.49a5.568 5.568 0 01-4.978 3.078 5.489 5.489 0 01-2.49-.59L.912 12.698l1.245-3.734a5.49 5.49 0 01-.59-2.489 5.568 5.568 0 013.079-4.978 5.49 5.49 0 012.489-.59h.328a5.555 5.555 0 015.24 5.24v.328z" stroke="#2D303A" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <span>{{ article.comments.length }}</span>
                    </div>
                    <div class="feed-card__content">
                        <svg width="19" height="19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.37 15.264H5.348c-.358 0-.7-.14-.953-.388A1.316 1.316 0 014 13.938V9.295c0-.351.142-.689.395-.937.253-.25.595-.389.953-.389H7.37m4.717-1.326V3.99c0-.528-.213-1.034-.592-1.407A2.039 2.039 0 0010.065 2L7.37 7.969v7.295h7.601c.325.004.64-.108.889-.315.247-.207.41-.496.46-.812l.93-5.969a1.306 1.306 0 00-.316-1.07 1.346 1.346 0 00-1.033-.455h-3.814z" stroke="#2D303A" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <span>{{ article.likes.length  }}</span>
                    </div>
                    <div class="feed-card__content">
                        <svg width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M.625 7.5s2.5-5 6.875-5 6.875 5 6.875 5-2.5 5-6.875 5-6.875-5-6.875-5z" stroke="#2D303A" stroke-linecap="round" stroke-linejoin="round"/><path d="M7.5 9.375a1.875 1.875 0 100-3.75 1.875 1.875 0 000 3.75z" stroke="#2D303A" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <span>{{  article.view_count }}</span>
                    </div>
                </div>

                <div class="feed-card__image">
                    <img v-bind:src="'storage/' + article.image_id + '/' + article.image" alt="" class="" width="100%">
                </div>
            </div>






        </div>
        <div class="feed-skeleton" v-if="loader">
            <div class="feed-skeleton__item"></div>
            <div class="feed-skeleton__item"></div>
            <div class="feed-skeleton__item"></div>
        </div>
        <button @click="loadMore()" class="btn feed__btn" :class="{ 'loading': loader }">
            <svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.039.74A9.63 9.63 0 003.32 3.448V.74a.74.74 0 10-1.481 0v4.444a.74.74 0 00.507.703L6.79 7.37a.742.742 0 10.468-1.408L3.977 4.87A8.115 8.115 0 111.95 9.012a.74.74 0 10-1.46-.247A9.64 9.64 0 009.987 20c5.318.014 9.641-4.285 9.655-9.604A9.63 9.63 0 0010.04.741z" fill="#fff"/></svg>
            <span>Загрузить еще</span>
        </button>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import moment from 'moment'

export default {
    data() {
        return {
            moment: moment,
            loader: false,
            tag: [],
            show_tags: false,
            view_card_multiply: false,
        }
    },
    watch: {
        tag() {
            this.getResult(0, true)
        },
    },
    methods: {
        ...mapActions([
            'GET_TAGS',
            'GET_ARTICLES_FROM_FILTER'
        ]),
        checkedSort(slug) {
            this.sort_attr = slug
        },
        checkedTag(id) {
            let index
            let exists = this.tag.some(function(el) {
                if (el === id) {
                    index = el.index
                    return true
                } else {
                    return false
                }
            })

            if (!exists) {
                this.tag.push(id)
            } else  {
                this.tag.splice(index, 1)
            }
        },
        toggleTags() {
            this.show_tags = !this.show_tags
        },
        toggleMultiplyCard() {
            this.view_card_multiply = !this.view_card_multiply
        },
        sortByName() {
            console.log('Сортировка')
            this.articles.sort((a, b) => a.title.localeCompare(b.title))
        },
        sortByLikes() {
            this.articles.sort((a,b) => b.likes.length - a.likes.length)
        },
        sortByView() {
            this.articles.sort((a,b) => b.view_count - a.view_count)
        },
        sortByComments() {
            this.articles.sort((a,b) => b.comments.length - a.comments.length)
        },
        sortByDate() {
            this.articles.sort((a,b) => a.created_at.localeCompare(b.created_at))
        },
        getResult(offset = 0, changed = false) {
            let payload = {
                'tag': this.tag,
                'offset': offset,
                'changed': changed
            }
            this.loader = true
            this.$store.dispatch('GET_ARTICLES_FROM_FILTER', payload)
                .then(() => {
                    this.loader = false
                })
                .catch((err) => {
                    this.loader = true
                    console.log(err)
                })
        },
        loadMore() {
            this.getResult(this.articles.length)
        }
    },
    computed: {
        ...mapGetters([
            'TAGS',
            'ARTICLES_FILTER'
        ]),
        tags() {
            return this.TAGS
        },
        articles() {
            return this.ARTICLES_FILTER
        },

    },
    beforeCreate() {
        this.loader = true
    },
    created() {
        this.getResult()
        this.loader = false
    },
    mounted() {
        this.GET_TAGS()
        this.GET_ARTICLES_FROM_FILTER()
        const obj = {
            "tag": this.tag
        }
    }
}
</script>

