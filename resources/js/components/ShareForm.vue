<template>
    <div class="ui attached segment">
        <div class="ui success message" v-if="auth">
            {{ this.$lang.get('welcome.auth') }}
        </div>
        <div class="ui action labeled fluid input">
            <div class="ui label">
                {{ this.$lang.get('welcome.links.share') }}
            </div>
            <input type="text" id="sharelink" :value="share">
            <a href="javascript:void(0);" class="ui teal right labeled icon button" data-clipboard-target="#sharelink">
                <i class="copy icon"></i>
                {{ this.$lang.get('welcome.copy') }}
            </a>
        </div>
        <br>
        <div class="ui action labeled fluid input">
            <div class="ui label">
                {{ this.$lang.get('welcome.links.delete') }}
            </div>
            <input type="text" id="managelink" :value="manage">
            <a href="javascript:void(0);" class="ui teal right labeled icon button" data-clipboard-target="#managelink">
                <i class="copy icon"></i>
                {{ this.$lang.get('welcome.copy') }}
            </a>
        </div>
        <br>
        <div class="ui icon buttons">
            <a href="#" @click.prevent="shareFunc('twitter')" class="ui primary button"><i class="twitter icon"></i></a>
            <a href="#" @click.prevent="shareFunc('email')" class="ui yellow button"><i class="mail icon"></i></a>
            <a href="#" @click.prevent="shareFunc('facebook')" class="ui blue button"><i class="facebook icon"></i></a>
            <a href="#" @click.prevent="shareFunc('mastodon')" class="ui teal button"><i class="mastodon icon"></i></a>
            <a href="#" @click.prevent="shareFunc('diaspora')" class="ui black button"><i class="diaspora icon"></i></a>
        </div>
    </div>
</template>

<script>
    import Clipboard from "clipboard";

    export default {
        props: ['share', 'manage', 'auth'],

        mounted() {
            new Clipboard('.ui.teal.right.labeled.icon.button');
        },

        methods: {
            shareFunc(service) {
                const url = encodeURIComponent(this.share);
                switch (service) {
                    case 'email':
                        window.location.href = `mailto:?subject=${encodeURIComponent(this.$lang.get('share.email.subject'))}&body=${encodeURIComponent(this.$lang.get('share.email.content'))}%0A${url}`;
                        break;
                    case 'twitter':
                        window.open(`https://twitter.com/share?url=${url}&text=${encodeURIComponent(this.$lang.get('share.social'))}`,'rakishare','location=no,links=no,scrollbars=no,toolbar=no,width=620,height=550');
                        break;
                    case 'facebook':
                        window.open(`https://www.facebook.com/sharer/sharer.php?href=${url}`,'rakishare','location=no,links=no,scrollbars=no,toolbar=no,width=620,height=550');
                        break;
                    case 'diaspora':
                        window.open(`http://sharetodiaspora.github.io/?url=${url}&title=${encodeURIComponent(this.$lang.get('share.social'))}`,'rakishare','location=no,links=no,scrollbars=no,toolbar=no,width=620,height=550');
                        break;
                    case 'mastodon':
                        window.open(`http://sharetomastodon.github.io/?url=${url}&title=${encodeURIComponent(this.$lang.get('share.social'))}`,'rakishare','location=no,links=no,scrollbars=no,toolbar=no,width=620,height=550');
                        break;
                    default:
                        break;
                }
            }
        }
    }
</script>
