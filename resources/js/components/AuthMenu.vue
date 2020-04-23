<template>
    <div class="ui right dropdown item">
        <i class="user icon" v-bind:class="{secret: !auth}"></i> {{ auth ? user.name:this.$lang.get('auth.anonymous') }} <i class="dropdown icon"></i>

        <div class="menu">
            <a @click.prevent="open('register')" class="item" v-if="!auth">{{ this.$lang.get('auth.register') }}</a>
            <a @click.prevent="open('login')" class="item" v-if="!auth">{{ this.$lang.get('auth.login') }}</a>
            <a @click.prevent="logout()" class="item" v-if="auth">{{ this.$lang.get('auth.logout') }}</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['auth', 'user'],

        methods: {
            open(type) {
                this.$parent.openModal(type);
            },
            logout() {
                axios.post('/logout')
                    .then(res => {
                        this.$emit('auth', {type: 'logout'});
                    });
            }
        }
    }
</script>
