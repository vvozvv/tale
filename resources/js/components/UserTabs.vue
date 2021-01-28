<template>
    <div class="">
        <div class="profile-content">
            <div class="container">
                <div class="loader" v-if='this.loader'>
                    <img src="https://homagents.com/static/gif/55484.gif" alt="">
                </div>
                <h2 class="profile-content__title">Статьи {{ username }}</h2>
                <div class="feed__articles">
                    <div class="feed-card" v-for="(article, index) in user_articles" :key="index">
                        <a :href="'article/' + article.slug" class="feed-card__link" :title='article.title'>{{ article.title }}</a>
                        <!--                {{ article.likes }}-->
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
                            <img v-bind:src="host + '/storage/' + article.media_id + '/' + article.file_name" alt="" class="" width="100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
    name: "UserTabs",
    props: ['username', 'id'],
    data() {
        return {
            loader: true,
            activeItem: 1,
            comments: [],
            subscribes: [],
            host: window.location.origin
        }
    },
    computed: {
        ...mapGetters([
            'USERS_ARTICLES',
        ]),
        user_articles() {
            return this.USERS_ARTICLES
        },
    },
    methods: {
        ...mapActions([
            'GET_USER_ARTICLES',
        ]),
    },
    mounted() {
        this.GET_USER_ARTICLES(this.$props.id)
            .then(() => {
                this.loader = false
            })
    }

}
</script>

