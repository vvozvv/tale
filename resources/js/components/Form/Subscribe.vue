<template>
    <div class="form">
        <div :class="['form__group', isEmailValid()]" class="form__row">
            <span class="form__label" id="basic-addon1"><span class="fa fa-envelope"></span></span>
            <input type="email" class="form__input" placeholder="Ваша почта" v-model="email" />
            <button class="btn" @click="sendForm"><svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex'
import axios from "axios"
export default {
    name: "Subscribe",
    data() {
        return {
            email: '',
            reg: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/
        }
    },
    methods: {
        ...mapActions([
            'SAVE_SUBSCRIBE_EMAIL'
        ]),
        isEmailValid: function() {
            return (this.email == "") ? "" : (this.reg.test(this.email)) ? 'form__group--success' : 'form__group--error'
        },
        sendForm() {
            let data = new FormData()

            return axios.post('http://127.0.0.1:8000/api/mailer', {'mail': this.email})
                .then(res => {
                    this.$toast.success('Спасибо за подписку!', {
                        timeout: 5000
                    })
                })
                .catch(err => {
                    this.$toast.warning('Ошибка! Попробуйте снова', {
                        timeout: 5000
                    })
                })
        }
    },
}
</script>

<style scoped>

</style>
