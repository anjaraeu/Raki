<template>
    <div>
        <a href="#" @click.prevent="markAsRead" class="ui blue button micromargin">Marquer comme lu</a><br>
        <a href="#" @click.prevent="deleteGroup" class="ui red button">Supprimer</a>
    </div>
</template>

<script>
    export default {
        props: ['id'],

        methods: {
            markAsRead(_e) {
                axios.put('/r/'+this.id, {
                    processed: true
                }).then(res => {
                    console.log(res);
                });
            },
            deleteGroup(_e) {
                axios.put('/r/'+this.id, {
                    processed: true,
                    delete: true
                }).then(res => {
                    console.log(res);
                }).catch(err => {
                    console.log(err);
                });
            }
        }
    }
</script>
