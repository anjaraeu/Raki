<template>
    <div class="ui modal" id="modal-register">
        <div class="header">{{ this.$lang.get('auth.register') }}</div>
        <div class="content">
            <div class="ui message">
                {{ this.$lang.get('auth.policy._', {link: this.$lang.get('auth.policy.link')}) }}
            </div>

            <div class="ui error message" v-if="Object.keys(lastResponse.errors).length > 0">
                <div class="header">{{ this.$lang.get('welcome.error._') }}</div>
                <ul>
                    <li v-for="name in Object.keys(lastResponse.errors)" v-bind:key="lastResponse.errors[name][0]">{{ lastResponse.errors[name][0] }}</li>
                </ul>
            </div>

            <form method="POST" action="/register" class="ui form" @submit.prevent="submitForm">
                <div class="field">
                    <label for="name">{{ this.$lang.get('auth.username') }}</label>
                    <input id="name" type="text" name="name" value="" required autofocus autocomplete="username" v-model="username">
                </div>

                <div class="field">
                    <label for="email">{{ this.$lang.get('auth.email') }}</label>
                    <input id="email" type="email" name="email" value="" required autofocus autocomplete="email" v-model="email">
                </div>

                <div class="field">
                    <label for="password">{{ this.$lang.get('auth.password') }}</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password" v-model="password">
                </div>

                <div class="field">
                    <label for="password-confirm">{{ this.$lang.get('auth.confirm-password') }}</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" v-model="password_confirmation">
                </div>

                <button type="submit" class="ui primary button" v-bind:class="{loading, disabled: done}">
                    {{ this.$lang.get('auth.register') }}
                </button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                username: '',
                email: '',
                password: '',
                password_confirmation: '',
                lastResponse: {errors: {}, message: null},
                loading: false,
                done: false
            }
        },

        methods: {
            submitForm() {
                if (this.loading) return;
                this.loading = true;
                axios.post('/register', {
                    email: this.email,
                    name: this.username,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                }).then(res => {
                    Object.assign(this.$data, this.$options.data());
                    this.$parent.closeModal('register');
                    this.$emit('auth', {type: 'login', register: true});
                }).catch(err => {
                    this.lastResponse = err.response.data;
                    this.loading = false;
                });
            }
        }
    }
</script>
