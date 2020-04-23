<template>
    <div class="ui modal" id="modal-login">
        <div class="header">{{ this.$lang.get('auth.login') }}</div>
        <div class="content">
            <div class="ui error message" v-if="Object.keys(lastResponse.errors).length > 0">
                <div class="header">{{ this.$lang.get('welcome.error._') }}</div>
                <ul>
                    <li v-for="name in Object.keys(lastResponse.errors)" v-bind:key="lastResponse.errors[name][0]">{{ lastResponse.errors[name][0] }}</li>
                </ul>
            </div>
            <form method="POST" action="/login" @submit.prevent="submitForm" class="ui form">
                <div class="field">
                    <label for="email">Adresse e-mail</label>
                    <input id="email" type="email" name="email" value="" required="required" autofocus="autofocus" autocomplete="email" v-model="email">
                </div>
                <div class="field">
                    <label for="password">Mot de passe</label>
                    <input id="password" type="password" name="password" required="required" autocomplete="current-password" v-model="password">
                </div>
                <div class="field">
                    <div class="ui checkbox">
                        <input tabindex="0" type="checkbox" name="remember" id="remember" class="hidden">
                        <label for="remember">
                            Se souvenir de moi
                        </label>
                    </div>
                </div>
                <button type="submit" class="ui primary button" v-bind:class="{loading, disabled: done}">
                    Se connecter
                </button>
                <a href="/password/reset" class="ui button">
                    Mot de passe oublié ?
                </a>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: '',
                password: '',
                lastResponse: {errors: {}, message: null},
                loading: false,
                done: false
            }
        },

        methods: {
            submitForm() {
                if (this.loading) return;
                this.loading = true;
                axios.post('/login', {
                    email: this.email,
                    password: this.password,
                    remember: $("#remember").prop('checked')
                }).then(res => {
                    Object.assign(this.$data, this.$options.data());
                    this.$parent.closeModal('login');
                    this.$emit('auth', {type: 'login', register: false});
                }).catch(err => {
                    this.lastResponse = err.response.data;
                    this.loading = false;
                });
            }
        }
    }
</script>
