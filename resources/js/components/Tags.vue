<template>
    <div class="">
        <div class="tag__list">
            <div class="tag__item" v-for="(tag, index) in tags" :key="index">
                <a :href="'tags/' + tag.id" class="tag__title">{{ tag.name }} <span>{{ tag.articles_count }}</span></a>

                <a href="" class="tag__subscribe" @click.prevent="subscibe(tag.id)">
                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zM12 8v8M8 12h8" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                <img v-bind:src="'storage/' + tag.image_id + '/' + tag.image" alt="" class="tag__image">
            </div>
        </div>
    </div>
</template>

<script>
import rgbaster from 'rgbaster'
import {mapActions, mapGetters} from 'vuex'
export default {
    data() {
        return {
            loader: false,
            user_id: this.$userId,
            host: window.location.origin,
        };
    },
    methods: {
        ...mapActions([
            'GET_TAGS'
        ]),
        subscibe(id) {
            if (this.user_id) {
                axios.post(`/api/tags/${id}/subscribe`, {
                    props: {
                        user_id: this.user_id,
                    },
                    data: {
                        enctype: 'multipart/form-data',
                        user_id: this.user_id,
                        id: id,
                        _method: 'PUT',
                    }
                })
                    .then(response => {
                        console.log(response);
                        this.$toast.success(response.data, {
                            timeout: 2000
                        });
                    })
                    .catch(error => console.error(error));
            } else {
                this.$toast.error('Сначала авторизируйтесь, чтобы подписаться на категорию', {
                    timeout: 2000
                });
            }

        },
    },
    computed: {
        ...mapGetters([
            'TAGS'
        ]),
        tags() {
            return this.TAGS
        }
    },
    mounted() {
        this.GET_TAGS()
    }
}
</script>

<style scoped>

</style>
