<template>
    <div class="ui modal" :id="'modal-'+id">
        <div class="header">
            {{ this.$lang.get('group.encrypted.modal.title') }}
        </div>
        <div class="content">
            <div class="description">
                <div class="ui error message" v-if="lastResponse === false">
                    <p>{{ this.$lang.get('group.encrypted.modal.err') }}</p>
                </div>
                <p>{{ this.$lang.get('group.encrypted.modal.content', {file}) }}</p>
                <div class="ui fluid input">
                    <input type="text" :placeholder="this.$lang.get('group.encrypted.modal.password')" v-model="password" @keyup.enter="submitForm">
                </div>
            </div>
        </div>
        <div class="actions">
            <div class="field">
                <a class="ui green button" @click="submitForm">{{ this.$lang.get('group.encrypted.modal.submit') }}</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    props: ['file', 'id', 'url'],

    data() {
        return {
            password: null,
            lastResponse: null
        }
    },

    mounted() {
        $('#file'+this.id).modal();
    },

    methods: {
        submitForm() {
            axios.get(this.url + '/check', {
                params: {
                    password: this.password
                }
            }).then(res => {
                if (res.data === true) {
                    var url = new URL(this.url);
                    url.searchParams.append('password', this.password);
                    document.location.href = url.href;
                    $('#file'+this.id).modal('hide');
                    this.password = null;
                    this.lastResponse = true;
                } else {
                    this.password = null;
                    this.lastResponse = false;
                }
            });
        }
    }

}
</script>
