<template>
    <div>
        <div class="ui error message" v-if="Object.keys(lastResponse.errors).length > 0">
            <div class="header">{{ this.$lang.get('welcome.error._') }}</div>
            <ul>
                <li v-for="name in Object.keys(lastResponse.errors)" v-bind:key="lastResponse.errors[name][0]">{{ lastResponse.errors[name][0] }}</li>
            </ul>
        </div>
        <!-- <br><br> -->
        <form action="/publish" method="POST" class="ui form" @submit.prevent="submitForm">
            <div class="field">
                <label for="name">{{ this.$lang.get('welcome.groupname._') }}</label>
                <input type="text" :placeholder="this.$lang.get('welcome.groupname.placeholder')" name="name" v-model="name" autocomplete="off">
            </div>
            <div class="field">
                <label for="expiry">{{ this.$lang.get('welcome.expiry._') }}</label>
                <div class="ui selection dropdown">
                    <input type="hidden" name="expiry" required id="expiry">
                    <i class="dropdown icon"></i>
                    <div class="default text">{{ this.$lang.get('welcome.expiry.placeholder') }}</div>
                    <div class="menu">
                        <div class="item" data-value="86400">{{ this.$lang.get('welcome.expiry.day') }}</div>
                        <div class="item" data-value="604800" v-if="maxexp >= 604800">{{ this.$lang.get('welcome.expiry.week') }}</div>
                        <div class="item" data-value="2635200" v-if="maxexp >= 2635200">{{ this.$lang.get('welcome.expiry.month') }}</div>
                        <div class="item" data-value="31557600" v-if="maxexp >= 31557600">{{ this.$lang.get('welcome.expiry.year') }}</div>
                    </div>
                </div>
            </div>
            <a href="#" class="ui button" v-if="!options" @click="toggleOptions">{{ this.$lang.get('welcome.options.show') }}</a>
            <a href="#" class="ui button" v-else @click="toggleOptions">{{ this.$lang.get('welcome.options.hide') }}</a>
            <em>{{ this.$lang.get('welcome.options.tooltip') }}</em>
            <br v-if="!options"><br v-if="!options">
            <div id="fields" class="ui hidden transition minimargin">
                <div class="ui info message">
                    {{ this.$lang.get('welcome.disclaimer') }}
                </div>
                <div class="field">
                    <div class="ui checkbox">
                        <input type="checkbox" tabindex="0" class="hidden" name="single" id="onedl">
                        <label><strong>{{ this.$lang.get('welcome.single._') }}</strong></label>
                        <small>{{ this.$lang.get('welcome.single.info') }}</small>
                    </div>
                </div>
                <div class="field">
                    <label for="link">{{ this.$lang.get('welcome.link._') }}</label>
                    <input type="text" :placeholder="this.$lang.get('welcome.link.placeholder')" name="link" v-model="link" autocomplete="off">
                    <small>{{ this.$lang.get('welcome.link.info', {'link': appurl+'/l/'+link}) }}</small>
                </div>
                <div class="field">
                    <label for="password">{{ this.$lang.get('welcome.password._') }}</label>
                    <input type="text" :placeholder="this.$lang.get('welcome.password.placeholder')" name="password" v-model="password" autocomplete="off">
                    <small>{{ this.$lang.get('welcome.password.info') }}</small>
                </div>
            </div>
            <div class="field">
                <input type="submit" class="ui blue button" :value="this.$lang.get('welcome.submit')" v-bind="{ disabled: loading }">
                <small v-if="loading">{{ this.$lang.get('welcome.loading') }}</small>
            </div>
        </form>
    </div>
</template>

<script>
export default {

    props: ['appurl', 'maxexp'],

    data() {
        return {
            name: '',
            link: '',
            password: '',
            lastResponse: {errors: {}, message: null},
            loading: false,
            options: false
        }
    },

    mounted() {
        document.addEventListener('uploadinglock', e => {
            this.loading = true;
        });
        document.addEventListener('uploadingunlock', e => {
            this.loading = false;
        });
        $('.ui.selection.dropdown').dropdown('set selected', process.env.MIX_DEFAULT_EXPIRATION);
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
        },
        toggleOptions() {
            $('#fields').transition('slide down');
            if (this.options) this.options = false;
            else this.options = true;
        }
    }

}
</script>
