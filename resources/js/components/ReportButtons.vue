<template>
    <a href="#" @click.prevent="markAsRead" class="ui blue fluid button" :class="{loading, disabled: done}">
        <i class="checkmark icon"></i> Marquer tout comme lu
    </a>
</template>

<script>
    export default {
        props: ['slug'],

        data() {
            return {
                loading: false,
                done: false
            }
        },

        methods: {
            markAsRead(_e) {
                this.loading = true;
                axios.put('/g/'+this.slug+'/reports', {
                    processed: true
                }).then(res => {
                    this.loading = false;
                    window.location.replace(`${this.$env.url}/admin`);
                });
            }
        }
    }
</script>
