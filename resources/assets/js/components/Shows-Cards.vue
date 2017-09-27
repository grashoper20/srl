<template>
    <div class="show-cards">
        <show v-for="show in shows" :key="show.show_id" v-bind:show="show"></show>
    </div>
</template>

<script>

    import {mapState, mapGetters} from 'vuex';
    import Show from './Show.vue';

    export default {
        components: {
            'show': Show,
        },
        props: [
            'shows'
        ],
    };
</script>
<style lang="scss">
    .show-cards {
        display: flex;
        flex-flow: row wrap;
        justify-content: center;
    }
</style>