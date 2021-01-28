<template>
    <div class="" v-show="checkArticles">
        <div class="section-title">Ваши статьи</div>
        <div class="table">
            <div class="table__row table__row--head">
                <div class="table__item" @click="sortByDate" >
                    Дата
                    <svg width="21" height="21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.247 13.125l5.25 5.25 5.25-5.25M15.747 7.875l-5.25-5.25-5.25 5.25" stroke="#3060F8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div class="table__item" @click="sortByName" >
                    Название
                    <svg width="21" height="21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.247 13.125l5.25 5.25 5.25-5.25M15.747 7.875l-5.25-5.25-5.25 5.25" stroke="#3060F8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div class="table__item" @click="sortByLikes" >
                    Лайков
                    <svg width="21" height="21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.247 13.125l5.25 5.25 5.25-5.25M15.747 7.875l-5.25-5.25-5.25 5.25" stroke="#3060F8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div class="table__item" @click="sortByComments" >
                    Комментариев
                    <svg width="21" height="21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.247 13.125l5.25 5.25 5.25-5.25M15.747 7.875l-5.25-5.25-5.25 5.25" stroke="#3060F8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div class="table__item" @click="sortByView" >
                    Просмотров
                    <svg width="21" height="21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.247 13.125l5.25 5.25 5.25-5.25M15.747 7.875l-5.25-5.25-5.25 5.25" stroke="#3060F8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div class="table__item" @click="sortByView" >

                </div>
            </div>
            <table-row :user_articles="paginatedArticles"></table-row>
            <div class="table__content">
                <div class="table__item">
                    <div class="table__box"></div>
                </div>
            </div>
            <div class="table-pagination">
                <div class="table-pagination__page"
                     v-for="(page, index) in pages"
                     :key="index"
                     :class="{'active': page === page_number}"
                     @click="pageClick(page)"
                >
                    {{ page }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'
import TableRow from "./TableRow";
    export default {
        name: 'TableData',
        components: {TableRow},
        data() {
            return {
                users: [],
                user_articles_per_page: 2,
                page_number: 1,
            }
        },
        computed: {
            ...mapGetters([
                'USERS_ARTICLES'
            ]),
            user_art() {
                return this.USERS_ARTICLES
            },
            pages() {
                return Math.ceil(this.USERS_ARTICLES.length / 2)
            },
            paginatedArticles() {
                let from = (this.page_number - 1) * this.user_articles_per_page;
                let to = from + this.user_articles_per_page;
                return this.user_art.slice(from, to);
            },
            checkArticles() {
                return (this.user_art.length != 0)
            }
        },
        methods: {
            ...mapActions([
                'GET_USER_ARTICLES'
            ]),
            pageClick(page) {
                this.page_number = page
            },
            sortByName() {
                this.user_art.sort((a, b) => a.title.localeCompare(b.title))
            },
            sortByLikes() {
                this.user_art.sort((a,b) => b.likes.length - a.likes.length)
            },
            sortByView() {
                this.user_art.sort((a,b) => b.view_count - a.view_count)
            },
            sortByComments() {
                this.user_art.sort((a,b) => b.comments.length - a.comments.length)
            },
            sortByDate() {
                this.user_art.sort((a,b) => a.created_at.localeCompare(b.created_at))
            }
        },
        mounted() {
            this.GET_USER_ARTICLES()
        }
    }
</script>

<style>
    .table-pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 0;
    }
    .table-pagination__page {
        width: 30px;
        height: 30px;
        background: #f9fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        cursor: pointer;
    }
    .table-pagination__page.active {
        border: transparent;
        background: #144CFB;
        color: #ffffff;
    }
    .table {
        background: #ffffff;
        border-radius: 15px;
    }
    .table__row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
    }
    .table__row--head {
        border-bottom: 1px solid #F9FAFC;
    }
    .table__item {
        display: flex;
        align-items: center;
        width: 20%;
        justify-items: center;
        filter: grayscale(1);
        cursor: pointer;
    }
    .table__item.active {
        filter: grayscale(0);
    }
    .table__item svg {
        margin-left: 5px;
    }
    .table-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
    }
    .table-item__box {
        width: 20%;
        display: flex;
        justify-items: center;
    }

</style>
