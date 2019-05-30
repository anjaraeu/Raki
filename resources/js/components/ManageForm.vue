<template>
    <form :action="actionurl" method="POST" @submit="submitForm" class="ui form">
        <input type="hidden" name="_token" :value="csrf">
        <div class="field" v-bind:class="{ error: err.url }">
            <label for="url">{{ lang.get('group.manage.form.url._') }}</label>
            <input type="text" :placeholder="lang.get('group.manage.form.url.placeholder')" name="url" v-model="url" autocomplete="off">
        </div>
        <div class="field" v-bind:class="{ error: err.pass }">
            <label for="password">{{ lang.get('group.manage.form.password._') }}</label>
            <input type="text" :placeholder="lang.get('group.manage.form.password.placeholder')" name="password" v-model="password" autocomplete="off">
        </div>
        <div class="field">
            <input class="ui blue button" type="submit" :value="lang.get('group.manage.form.submit')">
        </div>
    </form>
</template>

<script>
export default {

    props: ['csrf', 'lang'],

    data() {
        return {
            url: null,
            groupslug: null,
            actionurl: null,
            password: null,
            err: {
                url: false,
                pass: false
            }
        }
    },

    methods: {
        submitForm(e) {
            console.log(!this.actionurl || !this.password);
            if (!this.actionurl || !this.password) {
                e.preventDefault();
                return false;
            }
        }
    },

    watch: {
        url(newVal, _old) {
            var regex = new RegExp('^' + process.env.MIX_APP_URL + '\\/g\\/([A-Za-z0-9]+)$');
            if (regex.test(newVal)) {
                var results = regex.exec(newVal);
                this.groupslug = results[1];
                this.actionurl = process.env.MIX_APP_URL + '/g/' + this.groupslug + '/manage';
                this.err.url = false;
                return true;
            } else {
                this.groupslug = null;
                this.actionurl = null;
                this.err.url = true;
                return false;
            }
        },
        password(newVal, _old) {
            if (newVal.length == 40) this.err.pass = false;
            else this.err.pass = true;
            return;
        }
    }

}
</script>
