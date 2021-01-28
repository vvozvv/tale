<template>
    <div class="slider-digital">

        <swiper ref="mySwiper" :options="swiperOptions" :auto-update="true">
            <swiper-slide v-for="(slide, index) in slides" :key="index" class="slider-digital__item">
                <div class="" :style="{ 'background-image': `url(${host}/images/card-blue.png)` }" class="slider-digital__card">
                    <div class="slider-digital__box">
                        <div class="slider-digital__row">
                            <p class="slider-digital__cat">{{ slide.tag_name }}</p>
                            <p class="slider-digital__date">{{moment(slide.created_at).startOf('hour').fromNow() }}</p>
                        </div>
                        <p class="slider-digital__title">{{ slide.title }}</p>
                        <p class="slider-digital__author">{{ slide.name }}</p>
                    </div>
                </div>
            </swiper-slide>
<!--            <div class="swiper-button-prev slider-digital__prev" slot="button-prev"></div>-->
<!--            <div class="swiper-button-next slider-digital__nav" slot="button-next"></div>-->
        </swiper>

    </div>
</template>

<script>
import { Swiper, SwiperSlide, directive } from 'vue-awesome-swiper'
import moment from 'moment'

import {mapGetters, mapActions} from 'vuex'
export default {
    name: "ActualArticles",
    components: {
        Swiper,
        SwiperSlide,
    },
    directives: {
        swiper: directive
    },
    data() {
        return {
            swiperOptions: {
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev'
                },
                autoplay: {
                    delay: 1000,
                },
            },
            moment: moment,
            host: window.location.origin,

        }
    },
    methods: {
        ...mapActions([
            'GET_TOP_ARTICLES'
        ]),
        refreshSlider() {
            this.swiper.updateSlidesClasses()
        }
    },
    computed: {
        ...mapGetters([
            'TOP_ARTICLES'
        ]),
        slides() {
            return this.TOP_ARTICLES
        },
        swiper() {
            return this.$refs.mySwiper.$swiper
        }
    },
    mounted() {
        this.GET_TOP_ARTICLES()
    }
}
</script>

<style scoped>

</style>
