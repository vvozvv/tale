<template>
    <div class="">
        <div v-if="errors.length" class="errors">
            <b class="errors__title">Пожалуйста исправьте указанные ошибки:</b>
            <ul>
                <li v-for="error in errors" class="errors__item">{{ error }}</li>
            </ul>
        </div>
        <div class="article-edit">
            <div class="article-edit__content" :class="{'article-edit__content--sending': this.loader }" >
                <div class="article-edit__box">
                    <p class="article-edit__alert">Введите название статьи</p>
                    <input type="text" v-model="title" class="article-edit__title" placeholder="Введите название статьи" :maxlength="maxTitle">
                    <span class="article-edit__message" :class="{ 'active': isEnd }">Осталость символов: {{ maxSymbolTitle }}</span>
                </div>

                <div class="article-edit__box">
                    <p class="article-edit__alert">Выберите категорию</p>
                    <div class="article-edit__tags">
                        <div class="article-edit-tag" v-for="(tag, index) in TAGS" :key="index">
                            <input type="radio" :value='tag.name' name="radio" :id='tag.id' class="article-edit-tag__input">
                            <label :for="tag.id" class="article-edit-tag__label" @click='checkedTag(tag.id)'>{{ tag.name }}</label>
                        </div>
                    </div>
                </div>
                <div class="article-edit__box">
                    <div ref="mainContainer" class="article-edit__fileld">
                        <div class="article-edit__filed-box">
                            <p v-show='!this.content' class="article-edit__text">Добавьте изображение к своей записи</p>
                            <p v-show='!this.content' class="article-edit__text gray">JPEG, PNG, GIF (Ориентация 2:1 и не более 1 Мб)</p>
                        </div>
                        <input id="article_image" type="file" class="article-edit__file" name="article_image" @change="image">
                        <img :src='this.content' alt="" width="100%">
                    </div>
                </div>

                <div class="article-edit__box">
                    <editor-menu-bar :editor="editor" v-slot="{ commands, isActive }">
                        <div class="menubar">

                            <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.bold() }"
                                @click="commands.bold"
                            >

                                <PhTextBolder />
                            </button>

                            <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.italic() }"
                                @click="commands.italic"
                            >
                                <PhTextItalic  />
                            </button>

                            <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.strike() }"
                                @click="commands.strike"
                            >
                                <PhTextStrikethrough />
                            </button>

                            <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.underline() }"
                                @click="commands.underline"
                            >
                                <PhTextUnderline />
                            </button>


                            <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.paragraph() }"
                                @click="commands.paragraph"
                            >
                                <!--                        <icon name="paragraph" />-->
                            </button>

                            <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.heading({ level: 1 }) }"
                                @click="commands.heading({ level: 1 })"
                            >
                                H1
                            </button>

                            <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.heading({ level: 2 }) }"
                                @click="commands.heading({ level: 2 })"
                            >
                                H2
                            </button>

                            <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.heading({ level: 3 }) }"
                                @click="commands.heading({ level: 3 })"
                            >
                                H3
                            </button>

                            <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.bullet_list() }"
                                @click="commands.bullet_list"
                            >
                                <PhList />
                            </button>

                            <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.ordered_list() }"
                                @click="commands.ordered_list"
                            >
                                <PhListNumbers />
                            </button>

                            <button
                                class="menubar__button"
                                :class="{ 'is-active': isActive.blockquote() }"
                                @click="commands.blockquote"
                            >
                                <PhChatCircle />
                            </button>

                            <button
                                class="menubar__button"
                                @click="commands.horizontal_rule"
                            >
                                <PhArrowsOutLineVertical />
                            </button>

                            <button
                                class="menubar__button"
                                @click="commands.undo"
                            >
                                <PhArrowUUpLeft />
                            </button>

                            <button
                                class="menubar__button"
                                @click="commands.redo"
                            >
                                <PhArrowUUpRight />
                            </button>

                        </div>
                    </editor-menu-bar>

                    <editor-content class="editor__content" :editor="editor" />
                </div>

            </div>
            <div class="article-edit__sidebar">
                <div class="article-edit__btns">
                    <button class="btn btn--transparent" @click="checkForm(0)">В черновик</button>
                    <button class="btn" @click="checkForm(1)">Опубликовать</button>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
import {mapActions, mapGetters} from 'vuex'
import { PhTextBolder, PhTextItalic, PhTextStrikethrough, PhTextUnderline, PhArrowUUpRight, PhArrowUUpLeft, PhArrowsOutLineVertical, PhChatCircle, PhListNumbers, PhList } from "phosphor-vue";
import { Editor, EditorContent, EditorMenuBar } from 'tiptap'
import {
    Blockquote,
    HardBreak,
    Heading,
    HorizontalRule,
    OrderedList,
    BulletList,
    ListItem,
    TodoItem,
    TodoList,
    Bold,
    Italic,
    Link,
    Strike,
    Underline,
    History,
} from 'tiptap-extensions'
import Vue from "vue";

export default {
    props: ['data'],
    components: {
        EditorContent,
        EditorMenuBar,
        PhTextBolder,
        PhTextItalic,
        PhTextStrikethrough,
        PhTextUnderline,
        PhArrowUUpRight,
        PhArrowUUpLeft,
        PhArrowsOutLineVertical,
        PhChatCircle,
        PhListNumbers,
        PhList
    },
    data() {
        return {
            title: '',
            maxTitle: 40,
            file: null,
            errors: [],
            tag: '',
            content: null,
            loader: false,
            editor: new Editor({
                extensions: [
                    new Blockquote(),
                    new BulletList(),
                    new HardBreak(),
                    new Heading({ levels: [1, 2, 3] }),
                    new HorizontalRule(),
                    new ListItem(),
                    new OrderedList(),
                    new TodoItem(),
                    new TodoList(),
                    new Link(),
                    new Bold(),
                    new Italic(),
                    new Strike(),
                    new Underline(),
                    new History(),
                ],
                content: ``,
            }),
        }
    },

    methods: {
        ...mapActions([
            'GET_TAGS'
        ]),
        image(e) {
            e.preventDefault()
            // this.imageForm = e.target.files[0]
            this.selectImage(e.target.files[0])

        },
        selectImage(file) {
            this.file = file
            let render = new FileReader()
            render.onload = this.onImageLoad
            render.readAsDataURL(file)
        },
        resetForm() {
            this.title = ''
            this.editor.setContent()
            this.content = ''
        },
        onImageLoad(e) {
            this.content = e.target.result
            let fileName = this.file instanceof File ? this.file.name : ''
            this.$emit('input', fileName)
            this.$emit('image-changed', this.content)
        },
        onDrop(e) {
            e.stopPropagation();
            e.preventDefault();

            if (!e.dataTransfer.files || !this.eventOnElement(e, this.$refs.mainContainer)) {
                return;
            }
            if (!e.dataTransfer.files || !e.dataTransfer.files[0]) {
                return;
            }
            if (!/^image\//.test(e.dataTransfer.files[0].type)) {
                return;
            }
            this.selectImage(e.dataTransfer.files[0])
        },
        eventOnElement (event, object) {
            let rect = object.getBoundingClientRect()
            return event.pageX >= rect.left
                && event.pageY >= rect.top
                && event.pageX
        },
        replaceContent () {
            let text = this.editor.getHTML()
            return text.replace(/<\/?[^>]+(>|$)/g, "")
        },
        checkForm (status) {
            this.errors = []

            if (!this.title) {
                this.errors.push('Укажите заголовок статьи.')
            }
            if (this.replaceContent() == '') {
                this.errors.push('Заполните текст статьи')
            }
            let countErr = this.errors.length
             if (countErr === 0) {
                 this.getArticle(status)
             }
        },
        checkedTag(id) {
            this.tag = id
        },
        /** Принимает параметр status. 0 - Не опублтковано. 1 - черновик */
        getArticle(status) {
            this.loader = true
            let formData = new FormData();
            formData.append('image', this.src)
            formData.append('title', this.title)
            formData.append('article_text', this.editor.getHTML())
            formData.append('status', status)
            formData.append('tag', this.tag)
            formData.append('user_id', Vue.prototype.$userId)


            axios.post('http://127.0.0.1:8000/api/articles',
                formData,
                {
                    headers: {'Content-type': 'multipart/form-data'}
                })
                .then(res => {
                    this.loader = false
                    this.$toast.success('Вы опубликовали статью!', {
                        timeout: 5000
                    });
                    this.title = null
                    this.editor.setContent(null)
                    console.log(res)
                    this.resetForm()
                })
                .catch(err => {
                    this.loader = false
                    this.$toast.warning('Произошла ошибка! Повторите попытку', {
                        timeout: 5000
                    });
                })
        }
    },
    computed: {
        ...mapGetters([
            'TAGS',
        ]),
        tags() {
            return this.TAGS
        },
        src () {
            if (this.content) {
                return this.content;
            }
            return this.isEmpty ? '' : this.srcPrefix + this.value;
        },
        maxSymbolTitle () {
            return this.maxTitle - this.title.length
        },
        isEnd () {
            return (this.maxSymbolTitle == 0)
        }
    },
    mounted() {
        this.GET_TAGS(),
        this.$refs.mainContainer.addEventListener('drop', this.onDrop, true);
    },
    beforeDestroy() {
        this.editor.destroy()
    },
}
</script>

<style scoped>
input, textarea {
    outline: none !important;
}
input:focus, textarea:focus {
    border:1px solid #eeeef0 !important;
}
.menubar {
    margin: 20px 0 !important;
}
.article-edit__message {
    font-size: 12px;
    color: #b8b8b8;
}
.article-edit__message.active {
    color: red;
}

.article-edit__fileld {
    padding: 30px;
    position: relative;
    border: 2px dashed #eeeef0;
    margin: 10px 0;
    cursor: pointer;
    overflow: hidden;
}
.article-edit__file {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
}
.article-edit__content--sending {
    pointer-events: none;
    animation: loader 1s;
}
@keyframes loader {
    0% {
        opacity: .8;
    }
    50% {
        opacity: .2;
    }
    100% {
        opacity: .8;
    }
}
.ProseMirror-focused {
    border:1px solid #eeeef0 !important;
    padding: 3px;
}
.article-edit__title {
    width: 100%;
    border: none;
    font-size: 20px;
    line-height: 190%;
    height: fit-content;
    min-height: 60px;
    font-weight: 500;
}
blockquote,h1,h2,h3,ol,p,pre,ul{margin:1rem 0}blockquote:first-child,h1:first-child,h2:first-child,h3:first-child,ol:first-child,p:first-child,pre:first-child,ul:first-child{margin-top:0}blockquote:last-child,h1:last-child,h2:last-child,h3:last-child,ol:last-child,p:last-child,pre:last-child,ul:last-child{margin-bottom:0}h1,h2,h3{line-height:1.3}.button{font-weight:700;display:-webkit-inline-box;display:inline-flex;background:transparent;border:0;color:#000;padding:.2rem .5rem;margin-right:.2rem;border-radius:3px;cursor:pointer;background-color:rgba(0,0,0,.1)}.button:hover{background-color:rgba(0,0,0,.15)}.message{background-color:rgba(0,0,0,.05);color:rgba(0,0,0,.7);padding:1rem;border-radius:6px;margin-bottom:1.5rem;font-style:italic}.editor{position:relative;max-width:30rem;margin:0 auto 5rem}.editor__content{overflow-wrap:break-word;word-wrap:break-word;word-break:break-word}.editor__content *{caret-color:currentColor}.editor__content pre{padding:.7rem 1rem;border-radius:5px;background:#000;color:#fff;font-size:.8rem;overflow-x:auto}.editor__content pre code{display:block}.editor__content p code{padding:.2rem .4rem;border-radius:5px;font-size:.8rem;font-weight:700;background:rgba(0,0,0,.1);color:rgba(0,0,0,.8)}.editor__content ol,.editor__content ul{padding-left:1rem}.editor__content li>ol,.editor__content li>p,.editor__content li>ul{margin:0}.editor__content a{color:inherit}.editor__content blockquote{border-left:3px solid rgba(0,0,0,.1);color:rgba(0,0,0,.8);padding-left:.8rem;font-style:italic}.editor__content blockquote p{margin:0}.editor__content img{max-width:100%;border-radius:3px}.editor__content table{border-collapse:collapse;table-layout:fixed;width:100%;margin:0;overflow:hidden}.editor__content table td,.editor__content table th{min-width:1em;border:2px solid #ddd;padding:3px 5px;vertical-align:top;-webkit-box-sizing:border-box;box-sizing:border-box;position:relative}.editor__content table td>*,.editor__content table th>*{margin-bottom:0}.editor__content table th{font-weight:700;text-align:left}.editor__content table .selectedCell:after{z-index:2;position:absolute;content:"";left:0;right:0;top:0;bottom:0;background:rgba(200,200,255,.4);pointer-events:none}.editor__content table .column-resize-handle{position:absolute;right:-2px;top:0;bottom:0;width:4px;z-index:20;background-color:#adf;pointer-events:none}.editor__content .tableWrapper{margin:1em 0;overflow-x:auto}.editor__content .resize-cursor{cursor:ew-resize;cursor:col-resize}.menubar{margin-bottom:1rem;-webkit-transition:visibility .2s .4s,opacity .2s .4s;transition:visibility .2s .4s,opacity .2s .4s}.menubar.is-hidden{visibility:hidden;opacity:0}.menubar.is-focused{visibility:visible;opacity:1;-webkit-transition:visibility .2s,opacity .2s;transition:visibility .2s,opacity .2s}.menubar__button{font-weight:700;display:-webkit-inline-box;display:inline-flex;background:transparent;border:0;color:#000;padding:.2rem .5rem;margin-right:.2rem;border-radius:3px;cursor:pointer}.menubar__button:hover{background-color:rgba(0,0,0,.05)}.menubar__button.is-active{background-color:rgba(0,0,0,.1)}.menubar span.menubar__button{font-size:13.3333px}.menububble{position:absolute;display:-webkit-box;display:flex;z-index:20;background:#000;border-radius:5px;padding:.3rem;margin-bottom:.5rem;-webkit-transform:translateX(-50%);transform:translateX(-50%);visibility:hidden;opacity:0;-webkit-transition:opacity .2s,visibility .2s;transition:opacity .2s,visibility .2s}.menububble.is-active{opacity:1;visibility:visible}.menububble__button{display:-webkit-inline-box;display:inline-flex;background:transparent;border:0;color:#fff;padding:.2rem .5rem;margin-right:.2rem;border-radius:3px;cursor:pointer}.menububble__button:last-child{margin-right:0}.menububble__button:hover{background-color:hsla(0,0%,100%,.1)}.menububble__button.is-active{background-color:hsla(0,0%,100%,.2)}.menububble__form{display:-webkit-box;display:flex;-webkit-box-align:center;align-items:center}.menububble__input{font:inherit;border:none;background:transparent;color:#fff}.banner{font-size:.9rem;background-color:#fff;color:#000;border-bottom:1px solid #ddd;text-align:center;padding:.5rem 1rem}.banner__action{display:inline-block;border:3px solid #ddd;font-weight:700;-webkit-transition:all .1s ease-in-out;transition:all .1s ease-in-out;text-decoration:none;padding:.4rem .7rem;margin:.5rem .5rem .25rem;border-radius:5px;white-space:nowrap}.banner__action:hover{border-color:#000}@media (max-width:600px){.banner__message{display:block}}.icon[data-v-2b9db09d]{position:relative;display:inline-block;vertical-align:middle;width:.8rem;height:.8rem;margin:0 .3rem;top:-.05rem;fill:currentColor}.icon__svg[data-v-2b9db09d]{display:inline-block;vertical-align:top;width:100%;height:100%}.icon[data-v-2b9db09d]:first-child{margin-left:0}.icon[data-v-2b9db09d]:last-child{margin-right:0}.icon use>svg circle[data-v-2b9db09d],.icon use>svg g[data-v-2b9db09d],.icon use>svg path[data-v-2b9db09d],.icon use>svg rect[data-v-2b9db09d],body>svg circle[data-v-2b9db09d],body>svg g[data-v-2b9db09d],body>svg path[data-v-2b9db09d],body>svg rect[data-v-2b9db09d],symbol circle[data-v-2b9db09d],symbol g[data-v-2b9db09d],symbol path[data-v-2b9db09d],symbol rect[data-v-2b9db09d]{fill:currentColor;stroke:none}.icon use>svg [d="M0 0h24v24H0z"][data-v-2b9db09d],body>svg [d="M0 0h24v24H0z"][data-v-2b9db09d],symbol [d="M0 0h24v24H0z"][data-v-2b9db09d]{display:none}.navigation[data-v-802d4490]{display:-webkit-box;display:flex;-webkit-box-pack:justify;justify-content:space-between;-webkit-box-align:center;align-items:center;padding:.75rem;background-color:#000;color:#fff;flex-wrap:wrap}.navigation__logo[data-v-802d4490]{display:inline-block;vertical-align:middle;font-size:1.1rem;font-weight:700;margin:0 .5rem 0 0}.navigation__icon[data-v-802d4490]{width:1.5rem;height:1.5rem}.navigation__count[data-v-802d4490]{display:inline-block;vertical-align:middle;margin-top:.3rem}.navigation__link[data-v-802d4490]{display:inline-block;color:hsla(0,0%,100%,.5);text-decoration:none;font-weight:700;font-size:.9rem;padding:.1rem .5rem;border-radius:3px}.navigation__link[data-v-802d4490]:hover{color:#fff;background-color:hsla(0,0%,100%,.1)}.navigation__github-link[data-v-802d4490]{margin-left:.5rem}.hero[data-v-5a80d244]{background-color:#000;color:#fff;text-align:center;padding:3rem 1rem}.hero__inner[data-v-5a80d244]{margin:0 auto;max-width:30rem}.hero__logo[data-v-5a80d244]{width:4rem;height:4rem}.hero__logo path[data-v-5a80d244]{fill:#fff}.subnavigation[data-v-460c8f74]{padding:.5rem;background-color:rgba(0,0,0,.9);color:#fff;text-align:center}@media(min-width:600px){.subnavigation[data-v-460c8f74]{position:-webkit-sticky;position:sticky;top:0;z-index:1000}}.subnavigation__link[data-v-460c8f74]{display:inline-block;color:hsla(0,0%,100%,.5);text-decoration:none;font-weight:700;font-size:.9rem;padding:.1rem .5rem;border-radius:3px}.subnavigation__link[data-v-460c8f74]:hover{color:#fff;background-color:hsla(0,0%,100%,.1)}.subnavigation__link.is-exact-active[data-v-460c8f74]{color:#fff;background-color:hsla(0,0%,100%,.2)}.page__content{padding:4rem 1rem}.page__footer{text-align:center;margin-bottom:2rem}.page__source-link{display:inline-block;text-decoration:none;text-transform:uppercase;font-weight:700;font-size:.8rem;background-color:rgba(0,0,0,.1);color:#000;border-radius:5px;padding:.2rem .5rem}
</style>
