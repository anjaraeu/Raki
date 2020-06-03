<template>
    <div>
        <div class="ui centered grid">
            <div class="center aligned column">
                <div class="ui three top attached steps">
                    <div class="step" v-bind:class="{active: step === 1, completed: step > 1}">
                        <i class="file icon"></i>
                        <div class="content">
                            <div class="title">{{ this.$lang.get('welcome.steps.1._') }}</div>
                            <div class="description">{{ this.$lang.get('welcome.steps.1.desc') }}</div>
                        </div>
                        <a href="#" class="ui instep green button" v-bind:class="{disabled: files.length === 0}" v-if="step === 1" @click.prevent="nextStep">{{ this.$lang.get('welcome.steps.1.btn') }}</a>
                    </div>
                    <div class="step" v-bind:class="{active: step === 2, completed: step > 2}">
                        <i class="pencil icon"></i>
                        <div class="content">
                            <div class="title">{{ this.$lang.get('welcome.steps.2._') }}</div>
                            <div class="description">{{ this.$lang.get('welcome.steps.2.desc') }}</div>
                        </div>
                        <a href="#" class="ui instep green button" v-bind:class="{loading: progress, disabled: progress}" v-if="step === 2" @click.prevent="nextStep">{{ this.$lang.get('welcome.steps.2.btn') }}</a>
                    </div>
                    <div class="step" v-bind:class="{active: step === 3, completed: step > 3}">
                        <i class="checkmark icon"></i>
                        <div class="content">
                            <div class="title">{{ this.$lang.get('welcome.steps.3._') }}</div>
                            <div class="description">{{ this.$lang.get('welcome.steps.3.desc') }}</div>
                        </div>
                        <a href="#" class="ui instep orange button" v-if="step === 3" @click.prevent="resetForm">{{ this.$lang.get('welcome.steps.3.btn') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <uppy-form v-show="step === 1" v-on:file-uploaded="storeFile" :reset="reset"></uppy-form>
        <submit-form v-show="step === 2" :submit="progress"></submit-form>
        <share-form v-if="step === 3" :share="links.share" :manage="links.manage" :auth="auth"></share-form>
    </div>
</template>

<script>
    function extractTusUUID(url) {
        const regex = /\/([a-z0-9-]+)$/;
        return regex.test(url) ? regex.exec(url)[1]:null;
    }
    export default {
        props: ['auth'],
        data() {
            return {
                step: 1,
                files: [],
                reset: false,
                progress: false,
                links: {share: null, manage: null}
            }
        },
        methods: {
            storeFile(e) {
                const file = {name: e.file.name, tus_uuid: extractTusUUID(e.response.uploadURL)};
                this.files.push(file);
                axios.post('/sync', file);
                return true;
            },
            nextStep(_e) {
                switch (this.step) {
                    case 1:
                        if (this.files.length === 0) {
                            break;
                        }
                        this.step = 2;
                        break;
                    case 2:
                        console.log('heya');
                        this.progress = true;
                        break;
                    case 3:
                        this.step = 4;
                        break;
                }
                return true;
            },
            resetForm(_e) {
                Object.assign(this.$data, this.$options.data());
                this.reset = true;
                return true;
            },
            done(linkInfo) {
                console.log('heya!', linkInfo);
                window.onbeforeunload = null;
                this.links.share = linkInfo.short_link ? linkInfo.short_link:linkInfo.link;
                this.links.manage = linkInfo.manage;
                this.step = 3;
            },
            reverseState() {
                this.reset = !this.reset;
            }
        },
        watch: {
            files(newVal, _oldVal) {
                if (newVal.length >= 5) {
                    this.step = 2;
                }
            },
            reset(newVal, _oldVal) {
                if (newVal === true) {
                    _.debounce(this.reverseState, 500);
                }
            }
        }
    }
</script>
