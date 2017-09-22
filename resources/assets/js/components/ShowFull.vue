<template>
    <div>
        <div class="show-full--backdrop" :style="{backgroundImage: 'url(' + getBackgroundImage + ')'}"></div>
        <div class="show-full">
            <h1>{{show.show_name}}</h1>
        </div>

    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data: () => ({
            id: 0,
            show: {},
        }),
        created() {
            this.id = this.$route.params.id;
            axios.get('/api/show/' + this.id)
                .then(response => {
                    this.show = response.data;
                })
                .catch(e => {
                    console.log(e);
                    this.errors.push(e)
                })
        },
        computed: {
            getBackgroundImage: function () {
                if (typeof this.show.indexer_id === 'undefined') {
                    return '';
                }
                return '/filecache/poster/' + this.show.indexer_id + '/fanart';
            },
        },
        mounted() {
            console.log('show');
        }
    }
</script>
<style lang="scss">
    html {
        background-color: transparent;
    }

    .show-full--backdrop {
        position: fixed;
        top: 0;
        z-index: -9999;
        height: 100vh;
        width: 100%;
        opacity: 0.4;
        background: no-repeat center center fixed;
        background-size: cover;
    }
</style>
