<template>
    <form method="POST" class="ui form" @submit.prevent="submitForm">
        <div class="field">
            <label for="reason">{{ this.$lang.get('group.report.reason._') }}</label>
            <select class="ui selection dropdown" id="reportdown" v-model="type">
                <option value="">{{ this.$lang.get('group.report.reason.placeholder') }}</option>
                <option value="spam">{{ this.$lang.get('group.report.reason.spam') }}</option>
                <option value="identity">{{ this.$lang.get('group.report.reason.identity') }}</option>
                <option value="shock">{{ this.$lang.get('group.report.reason.shock') }}</option>
                <option value="copyright">{{ this.$lang.get('group.report.reason.copyright') }}</option>
                <option value="confidential">{{ this.$lang.get('group.report.reason.confidential') }}</option>
            </select>
        </div>
        <div class="field" v-if="type === 'identity'">
            <label for="who">{{ this.$lang.get('group.report.identity.who._') }}</label>
            <input type="text" name="who" id="who" :placeholder="this.$lang.get('group.report.identity.who.placeholder')" v-model="who">
        </div>
        <div class="field" v-if="type === 'copyright'">
            <label for="who">{{ this.$lang.get('group.report.cp.who._') }}</label>
            <input type="text" name="who" id="who" :placeholder="this.$lang.get('group.report.cp.who.placeholder')" v-model="who">
        </div>
        <div class="field" v-if="type === 'copyright'">
            <label for="what">{{ this.$lang.get('group.report.cp.what._') }}</label>
            <input type="text" name="what" id="what" :placeholder="this.$lang.get('group.report.cp.what.placeholder')" v-model="what">
        </div>
        <div class="field" v-if="type === 'copyright'">
            <div class="ui checkbox">
                <input type="checkbox" name="dmca" id="dmca" v-model="dmca">
                <label for="dmca">{{ this.$lang.get('group.report.cp.dmca') }}</label>
            </div>
        </div>
        <div class="field" v-if="type === 'copyright'">
            <label for="sign">{{ this.$lang.get('group.report.cp.sign._') }}</label>
            <input type="text" name="sign" id="sign" :placeholder="this.$lang.get('group.report.cp.sign.placeholder')" v-model="sign">
        </div>
        <div class="field" v-if="type !== null">
            <input type="submit" class="ui blue button" :value="this.$lang.get('group.report.submit')">
        </div>
    </form>
</template>

<script>
export default {
    props: ['csrf', 'id', 'encrypted'],

    data() {
        return {
            type: null,
            who: '',
            what: '',
            dmca: false,
            sign: ''
        }
    },

    methods: {
        submitForm() {
            if (this.type === 'copyright' && !this.dmca) return false;
            axios.post('/g/report/'+this.id, {
                type: this.type,
                who: this.who,
                what: this.what,
                sign: this.sign
            }).then(res => {
                document.location.href = '/';
            });
        }
    }

}
</script>
