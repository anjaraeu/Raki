<template>
    <div>
        <div class="ui error message" v-if="Object.keys(lastResponse.errors).length > 0">
            <div class="header">{{ lang.get('welcome.error._') }}</div>
            <ul>
                <li v-for="name in Object.keys(lastResponse.errors)">{{ lastResponse.errors[name][0] }}</li>
            </ul>
        </div>
        <form action="/publish" method="POST" class="ui form" @submit.prevent="submitForm">
            <div class="field">
                <label for="name">{{ lang.get('welcome.groupname._') }}</label>
                <input type="text" :placeholder="lang.get('welcome.groupname.placeholder')" name="name" v-model="name" autocomplete="off">
            </div>
            <div class="field">
                <label for="expiry">{{ lang.get('welcome.expiry._') }}</label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="expiry" required id="expiry">
                    <i class="dropdown icon"></i>
                    <div class="default text">{{ lang.get('welcome.expiry.placeholder') }}</div>
                    <div class="menu">
                        <div class="item" data-value="86400">{{ lang.get('welcome.expiry.day') }}</div>
                        <div class="item" data-value="604800">{{ lang.get('welcome.expiry.week') }}</div>
                        <div class="item" data-value="2635200">{{ lang.get('welcome.expiry.month') }}</div>
                        <div class="item" data-value="31557600">{{ lang.get('welcome.expiry.year') }}</div>
                    </div>
                </div>
                <small>{{ lang.get('welcome.expiry.info') }}</small>
            </div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" tabindex="0" class="hidden" name="single" id="onedl">
                    <label><strong>{{ lang.get('welcome.single._') }}</strong></label>
                    <small>{{ lang.get('welcome.single.info') }}</small>
                </div>
            </div>
            <div class="field">
                <label for="link">{{ lang.get('welcome.link._') }}</label>
                <input type="text" :placeholder="lang.get('welcome.link.placeholder')" name="link" v-model="link" autocomplete="off">
                <small>{{ lang.get('welcome.link.info', {'link': appurl+'/l/'+link}) }}</small>
            </div>
            <div class="field">
                <label for="password">{{ lang.get('welcome.password._') }}</label>
                <input type="password" :placeholder="lang.get('welcome.password.placeholder')" name="password" v-model="password" autocomplete="off">
                <small>{{ lang.get('welcome.password.info') }}</small>
            </div>
            <div class="field">
                <input type="submit" class="ui blue button" :value="lang.get('welcome.submit')" v-bind="{ disabled: loading }">
                <small v-if="loading">{{ lang.get('welcome.loading') }}</small>
            </div>
        </form>
    </div>
</template>

<script>
export default {

    props: ['lang', 'appurl'],

    data() {
        return {
            name: '',
            link: '',
            password: '',
            lastResponse: {errors: {}, message: null},
            loading: false
        }
    },

    mounted() {
        document.addEventListener('uploadinglock', e => {
            this.loading = true;
        });
        document.addEventListener('uploadingunlock', e => {
            this.loading = false;
        });
    },

    methods: {
        submitForm() {
            if (this.loading) return;
            axios.post('/publish', {
                name: this.name,
                link: this.link,
                password: this.password,
                expiry: $('#expiry').val(),
                single: $("#onedl").prop('checked')
            }).then(res => {
                document.location.replace(res.data.link);
            }).catch(err => {
                this.lastResponse = err.response.data;
            });
        }
    }

}
</script>
