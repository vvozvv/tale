<template>
    <div class="">
        <div class="article-edit__list">
            <div class="article-edit__box article-edit__box--list">
                <p class="article-edit__alert">Всего категорий {{ subscibe.length }}. Вы подписаны на {{ subscribe_count.length }}</p>
                <div class="articles-tag" v-for="tag in subscibe" :key="tags.id">
                    <img v-bind:src="host + '/storage/' + tag.image_id + '/' + tag.image" :alt='tag.name' class="articles-tag__image">
                    <div class="articles-tag__box">
                        <p class="articles-tag__title">{{tag.name}}</p>

                        <button class="articles-tag__btn btn btn--subscribe"  @click="subscribeTag(tag.id)" v-if='!tag.subscribe'>Подписаться</button>
                        <button class="articles-tag__btn btn btn--unsubscribe" @click="unsubscribeTag(tag.id)" v-else>Отписаться</button>
                    </div>


                </div>
            </div>
<!--            <div class="article-edit__box">-->
<!--                <p class="article-edit__alert">Остальные категории</p>-->
<!--                <div class="" v-for="tag in unsubscibe_tags" :key="tags.id">-->
<!--                    {{tag.name}}-->
<!--                </div>-->
<!--            </div>-->

        </div>

    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'
import Vue from "vue";
export default {
    name: "SubscribeList",
    data() {
        return {
            subscibe: [],
            unsubscibe_tags: [],
            host: window.location.origin,
            user_id: Vue.prototype.$userId
        }
    },
    methods: {
        ...mapActions([
            'GET_TAGS',
            'GET_SUBSCRIBE_USER_TAGS'
        ]),
        changeBtn(id) {
            let item = this.subscibe.find(item => item.id === id)
            console.log('Сейчас' + item.subscribe)
            console.log('А теперь' + !item.subscribe)
            return item.subscribe = !item.subscribe
        },
        subscribe_list() {
            let vm = this
            let subscribe = this.tags.filter(item => {
                // return vm.subscribe_id.indexOf(item.id) !== -1
                if(vm.subscribe_id.indexOf(item.id) !== -1) {
                    item['subscribe'] = true
                    return this
                } else {
                    item['subscribe'] = false
                    return this
                }
            })
            this.subscibe = subscribe
        },
        subscribeTag(id) {
            axios.post(`/api/tags/${id}/subscribe`, {
                    props: { user_id: this.user_id },
                    data: {
                        enctype: 'multipart/form-data',
                        user_id: this.user_id,
                        id: id,
                        _method: 'PUT',
                    }
                })
                .then(response => {
                    this.changeBtn(id)
                    this.$forceUpdate()
                    this.$toast.success(response.data, { timeout: 2000 })
                })
                .catch(error => console.error(error));
        },
        unsubscribeTag(id) {
            axios.delete(`/api/tags/${id}/unsubscribe`, {
                    data: {
                        enctype: 'multipart/form-data',
                        user_id: this.user_id,
                        id: id,
                        _method: 'DELETE',
                    }
                })
                .then(response => {
                    this.changeBtn(id)
                    this.$forceUpdate()
                    this.$toast.success(response.data, { timeout: 2000 })
                })
                .catch(error => console.error(error));
        }
    },
    computed: {
        ...mapGetters([
            'TAGS',
            'SUBSCRIBE_USER_TAG'
        ]),
        tags() {
            return this.TAGS
        },
        subscribe_id() {
            return this.SUBSCRIBE_USER_TAG
        },
        subscribe_count() {
            return this.subscibe.filter(rl => rl.subscribe === true)
        }

    },
    mounted() {
        this.GET_TAGS()
        this.GET_SUBSCRIBE_USER_TAGS()
            .then(() => {
                this.subscribe_list()
            })
    }
}
</script>

