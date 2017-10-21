<template>
    <div class="show-tiles">
        <show v-for="show in shows" :key="show.show_id" v-bind:show="show"></show>
    </div>
</template>

<script>
    import {mapState, mapGetters} from 'vuex';
    import Show from './Show-Tile.vue';

    export default {
        components: {
            'show': Show,
        },
        props: [
            'shows',
        ],
    };
</script>
<style lang="scss">
    .show-tiles {
        display: flex;
        flex-flow: row wrap;
        justify-content: center;
    }
</style>
